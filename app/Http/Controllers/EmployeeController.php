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
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'کارمند با موفقیت بروزرسانی شد.');
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
