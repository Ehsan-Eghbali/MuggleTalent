<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreemployeeRequest;
use App\Http\Requests\UpdateemployeeRequest;
use App\Models\employees;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = employees::all();
        return view('dashboard.employees_list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreemployeeRequest $request)
    {
        // این کد را در متد store یا update کنترلر خود قرار دهید.
// برای متد update، ابتدا کارمند را پیدا کنید:
// $employee = Employee::findOrFail($id);

DB::transaction(function () use ($request) {


    $employeeData = [
        'employee_number'    => $request->employee_number,
        'first_name'         => $request->first_name,
        'last_name'          => $request->last_name,
        'full_name'          => $request->full_name,
        'nickname'           => $request->nickname,
        'position_chart'     => $request->position_chart,
        'team'               => $request->team,
        'department'         => $request->department,
        'direct_manager'     => $request->direct_manager,
        'job_level'          => $request->job_level,
        'contract_type'      => $request->contract_type,
        'work_status'        => $request->work_status,
        'formality'          => $request->formality,
        'phone_number'       => $request->phone_number,
        'email'              => $request->email,
        'organization_email' => $request->organization_email,
        'gender'             => $request->gender,
    ];

    // ایجاد یا آپدیت کارمند اصلی
    // در متد store از create و در update از findOrFail()->update() استفاده کنید
    $employee = employees::updateOrCreate(
        ['id' => $request->id], // or whatever unique identifier you use for update
        $employeeData
    );

    // جدول personal
    $employee->personal()->updateOrCreate([], [
        'father_name'        => $request->father_name,
        'mother_name'        => $request->mother_name,
        'national_code'      => $request->national_code,
        'id_number'          => $request->id_number,
        'id_serial'          => $request->id_serial,
        'birthplace'         => $request->birthplace,
        'id_issue_place'     => $request->id_issue_place,
        'birth_date_shamsi'  => $request->birth_date_shamsi,
        'birth_date_real'    => $request->birth_date_real,
    ]);

    // جدول addresses
    $employee->address()->updateOrCreate([], [
        'home_address'           => $request->home_address,
        'postal_code'            => $request->postal_code,
        'home_phone'             => $request->home_phone,
        'emergency_phone'        => $request->emergency_phone,
        'emergency_contact_info' => $request->emergency_contact_info,
    ]);

    // جدول contracts
    $employee->contract()->updateOrCreate([], [
        'contract_number'       => $request->contract_number,
        'trial_start_date'      => $request->trial_start_date,
        'exit_type'             => $request->exit_type,
        'exit_reason'           => $request->exit_reason,
        'wants_insurance'       => $request->wants_insurance,
        'supplementary_insurance' => $request->supplementary_insurance,
        'cooperation_status'    => $request->cooperation_status,
        'entry_date'            => $request->entry_date,
        'exit_date'             => $request->exit_date,
    ]);

    // جدول nda_contracts
    $employee->ndaContract()->updateOrCreate([], [
        'nda_type'       => $request->nda_type,
        'nda_start_date' => $request->nda_start_date,
        'nda_end_date'   => $request->nda_end_date,
    ]);

    // جدول insurances
    $employee->insurance()->updateOrCreate([], [
        'insurance_position' => $request->insurance_position,
        'insurance_code'     => $request->insurance_code,
        'insurance_number'   => $request->insurance_number,
        'has_dependents'     => $request->has_dependents,
    ]);

    // جدول educations
    $employee->education()->updateOrCreate([], [
        'degree'     => $request->degree,
        'major'      => $request->major,
        'university' => $request->university,
    ]);

    // جدول military
    $employee->military()->updateOrCreate([], [
        'military_status' => $request->military_status,
        'start_date'      => $request->start_date,
        'end_date'        => $request->end_date,
    ]);

    // جدول bank_accounts
    $employee->bankAccount()->updateOrCreate([], [
        'pasargad_account_number' => $request->pasargad_account_number,
        'pasargad_sheba'          => $request->pasargad_sheba,
        'pasargad_card'           => $request->pasargad_card,
        'pasargad_branch'         => $request->pasargad_branch,
        'bank_type'               => $request->bank_type,
        'bank_branch_name'        => $request->bank_branch_name,
        'account_number'          => $request->account_number,
        'sheba_number'            => $request->sheba_number,
        'card_number'             => $request->card_number,
    ]);

    // جدول contract_information
    $employee->contactInformation()->updateOrCreate([], [
        'address'                 => $request->address,
        'postal_code'             => $request->postal_code,
        'emergency_contact'       => $request->emergency_contact,
        'emergency_contact_info'  => $request->emergency_contact_info,
    ]);

    // جدول social
    $employee->social()->updateOrCreate([], [
        'telegram_id'             => $request->telegram_id,
    ]);
});

return redirect()->route('employees.index')->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }


    /**
     * Display the specified resource.
     */
    public function show(employees $employee)
    {
        $employee->load([
            'personal',
            'contract', 
            'insurance',
            'education',
            'military',
            'bankAccount',
            'ndaContract',
            'address',
            'contactInformation',
            'social'
        ]);
        
        return view('dashboard.personnel-profile', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employees $employee)
    {
        return view('dashboard.employees.create', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployeeRequest $request, employees $employee)
    {
        DB::transaction(function () use ($request, $employee) {
            // تبدیل مقدار هیبرید به هیبریدی برای مطابقت با دیتابیس
            $workModel = $request->work_model;
            if ($workModel === 'هیبرید') {
                $workModel = 'هیبریدی';
            }
            
            // به‌روزرسانی جدول اصلی employees با mapping صحیح فیلدها
            $updateData = [
                'employee_number'    => $request->personnel_code ?? $request->employee_number ?? $employee->employee_number,
                'first_name'         => $request->first_name ?? $employee->first_name,
                'last_name'          => $request->last_name ?? $employee->last_name,
                'full_name'          => $request->full_name ?? $employee->full_name,
                'nickname'           => $request->nickname ?? $employee->nickname,
                'position_chart'     => $request->position_chart ?? $employee->position_chart,
                'team'               => $request->emp_team ?? $request->team ?? $employee->team,
                'department'         => $request->emp_department ?? $request->department ?? $employee->department,
                'direct_manager'     => $request->direct_manager ?? $employee->direct_manager,
                'job_level'          => $request->skill_level ?? $request->job_level ?? $employee->job_level,
                'phone_number'       => $request->phone ?? $request->phone_number ?? $employee->phone_number,
                'email'              => $request->personal_email ?? $request->email ?? $employee->email,
                'organization_email' => $request->organization_email ?? $employee->organization_email,
                'gender'             => $request->gender ?? $employee->gender,
            ];
            
            // فقط فیلدهای enum را به‌روزرسانی کن اگر مقدار معتبر داشته باشند
            // contract_type: مقادیر مجاز → ['دورکاری', 'کارآموزی', 'آزمایشی', 'تمام وقت', 'پاره وقت']
            if ($request->filled('cooperation_type')) {
                $validContractTypes = ['دورکاری', 'کارآموزی', 'آزمایشی', 'تمام وقت', 'پاره وقت', 'پروژه ای'];
                $cooperationType = $request->cooperation_type;
                // تبدیل "پروژه ای" به "دورکاری" برای مطابقت با دیتابیس
                if ($cooperationType === 'پروژه ای') {
                    $cooperationType = 'دورکاری';
                }
                if (in_array($cooperationType, $validContractTypes)) {
                    $updateData['contract_type'] = $cooperationType;
                }
            }
            
            // work_status: مقادیر مجاز → ['حضوری', 'دورکار', 'هیبریدی']
            if ($request->filled('work_model')) {
                $validWorkStatuses = ['حضوری', 'دورکار', 'هیبریدی'];
                if (in_array($workModel, $validWorkStatuses)) {
                    $updateData['work_status'] = $workModel;
                }
            }
            
            // formality: مقادیر مجاز → ['رسمی', 'غیررسمی']
            if ($request->filled('contract_type')) {
                $validFormalities = ['رسمی', 'غیررسمی'];
                if (in_array($request->contract_type, $validFormalities)) {
                    $updateData['formality'] = $request->contract_type;
                }
            }
            
            $employee->update($updateData);

            // به‌روزرسانی جدول personal
            if ($request->filled(['father_name', 'mother_name', 'national_code', 'birth_cert_number', 'id_serial', 'birth_place', 'id_issue_place', 'birth_date'])) {
                $employee->personal()->updateOrCreate([], [
                    'father_name'        => $request->father_name,
                    'mother_name'        => $request->mother_name,
                    'national_code'      => $request->national_code,
                    'id_number'          => $request->birth_cert_number,
                    'id_serial'          => $request->id_serial,
                    'birthplace'         => $request->birth_place,
                    'id_issue_place'     => $request->id_issue_place,
                    'birth_date_shamsi'  => $request->birth_date,
                ]);
            }

            // به‌روزرسانی جدول addresses
            if ($request->filled(['address', 'postal_code', 'home_phone', 'emergency_contact', 'emergency_contact_info'])) {
                $employee->address()->updateOrCreate([], [
                    'home_address'           => $request->address,
                    'postal_code'            => $request->postal_code,
                    'home_phone'             => $request->home_phone,
                    'emergency_phone'        => $request->emergency_contact,
                    'emergency_contact_info' => $request->emergency_contact_info,
                ]);
            }

            // به‌روزرسانی جدول contracts
            if ($request->filled(['contract_number', 'trial_start_date', 'employment_status_select', 'hire_date', 'termination_date', 'termination_reason'])) {
                $employee->contract()->updateOrCreate([], [
                    'contract_number'       => $request->contract_number,
                    'trial_start_date'      => $request->trial_start_date,
                    'cooperation_status'    => $request->employment_status_select,
                    'entry_date'            => $request->hire_date,
                    'exit_date'             => $request->termination_date,
                    'exit_reason'           => $request->termination_reason,
                ]);
            }

            // به‌روزرسانی جدول nda_contracts
            if ($request->filled('nda_type')) {
                $employee->ndaContract()->updateOrCreate([], [
                    'nda_type' => $request->nda_type,
                ]);
            }

            // به‌روزرسانی جدول insurances
            if ($request->filled(['insurance_title', 'insurance_job_code'])) {
                $employee->insurance()->updateOrCreate([], [
                    'insurance_position' => $request->insurance_title,
                    'insurance_code'     => $request->insurance_job_code,
                ]);
            }

            // به‌روزرسانی جدول educations
            if ($request->filled(['degree', 'field_of_study'])) {
                $employee->education()->updateOrCreate([], [
                    'degree' => $request->degree,
                    'major'  => $request->field_of_study,
                ]);
            }

            // به‌روزرسانی جدول military
            if ($request->filled('military_status')) {
                $employee->military()->updateOrCreate([], [
                    'military_status' => $request->military_status,
                ]);
            }

            // به‌روزرسانی جدول social
            if ($request->filled('telegram_id')) {
                $employee->social()->updateOrCreate([], [
                    'telegram_id' => $request->telegram_id,
                ]);
            }
        });

        return redirect()->route('employees.show', $employee->id)->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employees $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'کارمند حذف شد.');
    }
}
