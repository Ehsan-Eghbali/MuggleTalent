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
        $employees = Employees::all();
        return view('dashboard.employees_list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreemployeeRequest $request)
    {
        dd($request->all());
        DB::transaction(function () use ($request) {
            $employee = Employees::create([
                'employee_number'    => $request->employee_number,
                'first_name'         => $request->employee_name,
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
            ]);

        // جدول personals
            $employee->personal()->create([
                'birth_date'       => $request->birth_date,
                'national_code'    => $request->national_code,
                'father_name'      => $request->father_name,
                'marital_status'   => $request->marital_status,
                'gender'           => $request->gender,
                'birth_place'      => $request->birth_place,
            ]);

            // جدول contracts
            $employee->contract()->create([
                'contract_number'  => $request->contract_number,
                'start_date'       => $request->contract_start_date,
                'end_date'         => $request->contract_end_date,
                'nda_signed'       => $request->nda_signed,
                'nda_date'         => $request->nda_date,
            ]);

            // جدول insurances
            $employee->insurance()->create([
                'insurance_number'     => $request->insurance_number,
                'insurance_position'   => $request->insurance_position,
                'insurance_start_date' => $request->insurance_start_date,
            ]);

            // جدول education
            $employee->education()->create([
                'highest_degree'   => $request->highest_degree,
                'university'       => $request->university,
                'major'            => $request->major,
                'graduation_year'  => $request->graduation_year,
            ]);

            // جدول militaries
            $employee->military()->create([
                'service_status'   => $request->service_status,
                'exemption_reason' => $request->exemption_reason,
                'military_code'    => $request->military_code,
            ]);

            // جدول contact_informations
            $employee->contactInformation()->create([
                'home_phone'         => $request->home_phone,
                'emergency_contact'  => $request->emergency_contact,
                'address'            => $request->address,
                'city'               => $request->city,
                'province'           => $request->province,
            ]);

            // جدول socials
            $employee->social()->create([
                'telegram_id'          => $request->telegram_id,
                'previous_experience' => $request->previous_experience,
                'sheba_check_control' => $request->sheba_check_control,
                'insurance_workshop'  => $request->insurance_workshop,
            ]);
        });

        return redirect()->route('employees.index')->with('success', 'کارمند با موفقیت ایجاد شد.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employees $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employees $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployeeRequest $request, Employees $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'کارمند با موفقیت بروزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employees $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'کارمند حذف شد.');
    }
}
