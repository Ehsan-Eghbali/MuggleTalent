<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\Payroll;
use App\Models\PayrollHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the payrolls.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->get()->map(function ($payroll) {
            return [
                'id' => $payroll->id,
                'employee_id' => $payroll->employee_id,
                'personnel_name' => $payroll->employee->full_name ?? 'نامشخص',
                'level' => $payroll->level,
                'base_salary' => number_format($payroll->base_salary),
                'seniority' => number_format($payroll->seniority),
                'housing' => number_format($payroll->housing),
                'marriage' => number_format($payroll->marriage),
                'children' => number_format($payroll->children),
                'responsibility' => number_format($payroll->responsibility),
                'food' => number_format($payroll->food),
                'informal' => number_format($payroll->informal),
            ];
        });

        // دریافت کارمندانی که حقوق ندارند
        $employeesWithoutPayroll = employees::whereDoesntHave('payroll')->get();

        return view('dashboard.payrolls.index', compact('payrolls', 'employeesWithoutPayroll'));
    }

    /**
     * Store a newly created payroll in storage.
     */
    public function store(Request $request)
    {
        try {
            // پاک کردن فیلدهای خالی قبل از validation
            $input = $request->all();
            foreach ($input as $key => $value) {
                if ($value === '' || $value === null) {
                    $input[$key] = null;
                }
            }
            $request->merge($input);

            $validated = $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'level' => 'nullable|string',
                'base_salary' => 'nullable|numeric|min:0',
                'seniority' => 'nullable|numeric|min:0',
                'housing' => 'nullable|numeric|min:0',
                'marriage' => 'nullable|numeric|min:0',
                'children' => 'nullable|numeric|min:0',
                'responsibility' => 'nullable|numeric|min:0',
                'food' => 'nullable|numeric|min:0',
                'informal' => 'nullable|numeric|min:0',
            ]);

            // تبدیل مقادیر null به 0
            $data = [
                'employee_id' => $validated['employee_id'],
                'level' => $validated['level'] ?? null,
                'base_salary' => $validated['base_salary'] ?? 0,
                'seniority' => $validated['seniority'] ?? 0,
                'housing' => $validated['housing'] ?? 0,
                'marriage' => $validated['marriage'] ?? 0,
                'children' => $validated['children'] ?? 0,
                'responsibility' => $validated['responsibility'] ?? 0,
                'food' => $validated['food'] ?? 0,
                'informal' => $validated['informal'] ?? 0,
            ];

            $payroll = Payroll::create($data);

            return response()->json([
                'success' => true,
                'message' => 'حقوق با موفقیت ثبت شد.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطای اعتبارسنجی',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ثبت حقوق: ' . $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Update the specified payroll in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'level' => 'nullable|string',
            'base_salary' => 'nullable|numeric',
            'seniority' => 'nullable|numeric',
            'housing' => 'nullable|numeric',
            'marriage' => 'nullable|numeric',
            'children' => 'nullable|numeric',
            'responsibility' => 'nullable|numeric',
            'food' => 'nullable|numeric',
            'informal' => 'nullable|numeric',
            'change_reason' => 'required|string',
            'change_details' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $payroll = Payroll::findOrFail($id);

            // ذخیره مقادیر قبلی
            $oldData = [
                'old_level' => $payroll->level,
                'old_base_salary' => $payroll->base_salary,
                'old_seniority' => $payroll->seniority,
                'old_housing' => $payroll->housing,
                'old_marriage' => $payroll->marriage,
                'old_children' => $payroll->children,
                'old_responsibility' => $payroll->responsibility,
                'old_food' => $payroll->food,
                'old_informal' => $payroll->informal,
            ];

            // به‌روزرسانی حقوق
            $payroll->update([
                'level' => $validated['level'] ?? $payroll->level,
                'base_salary' => $validated['base_salary'] ?? $payroll->base_salary,
                'seniority' => $validated['seniority'] ?? $payroll->seniority,
                'housing' => $validated['housing'] ?? $payroll->housing,
                'marriage' => $validated['marriage'] ?? $payroll->marriage,
                'children' => $validated['children'] ?? $payroll->children,
                'responsibility' => $validated['responsibility'] ?? $payroll->responsibility,
                'food' => $validated['food'] ?? $payroll->food,
                'informal' => $validated['informal'] ?? $payroll->informal,
            ]);

            // ثبت لاگ در تاریخچه
            PayrollHistory::create([
                'payroll_id' => $payroll->id,
                'employee_id' => $payroll->employee_id,
                'user_id' => Auth::id(),
                'old_level' => $oldData['old_level'],
                'old_base_salary' => $oldData['old_base_salary'],
                'old_seniority' => $oldData['old_seniority'],
                'old_housing' => $oldData['old_housing'],
                'old_marriage' => $oldData['old_marriage'],
                'old_children' => $oldData['old_children'],
                'old_responsibility' => $oldData['old_responsibility'],
                'old_food' => $oldData['old_food'],
                'old_informal' => $oldData['old_informal'],
                'new_level' => $payroll->level,
                'new_base_salary' => $payroll->base_salary,
                'new_seniority' => $payroll->seniority,
                'new_housing' => $payroll->housing,
                'new_marriage' => $payroll->marriage,
                'new_children' => $payroll->children,
                'new_responsibility' => $payroll->responsibility,
                'new_food' => $payroll->food,
                'new_informal' => $payroll->informal,
                'change_reason' => $validated['change_reason'],
                'change_details' => $validated['change_details'] ?? null,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تغییرات با موفقیت ذخیره شد و در تاریخچه ثبت گردید.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'خطا در ذخیره تغییرات: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the payroll history.
     */
    public function history(Request $request)
    {
        $query = PayrollHistory::with(['employee', 'user']);

        // جستجو بر اساس نام یا کد پرسنلی
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('employee_number', 'like', "%{$search}%");
            });
        }

        $logs = $query->orderBy('created_at', 'desc')->get()->map(function ($log) {
            return [
                'id' => $log->id,
                'date' => $log->created_at->format('Y/m/d'),
                'personnel_name' => $log->employee->full_name ?? 'نامشخص',
                'change_type' => $log->change_reason,
                'details' => $log->change_details ?? 'بدون توضیحات',
                'user' => $log->user->name ?? 'نامشخص',
            ];
        });

        return view('dashboard.payrolls.history', compact('logs'));
    }

    /**
     * Remove the specified payroll from storage.
     */
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('payrolls.index')->with('success', 'حقوق با موفقیت حذف شد.');
    }
}
