<?php

namespace Database\Seeders;

use App\Models\employees;
use App\Models\Payroll;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد یک کارمند نمونه در صورت عدم وجود
        $employee = employees::firstOrCreate(
            ['employee_number' => '94040'],
            [
                'first_name' => 'محمد مهدی',
                'last_name' => 'مهربان نیا',
                'full_name' => 'محمد مهدی مهربان نیا',
                'nickname' => 'مهدی',
                'position_chart' => 'برنامه نویس',
                'team' => 'تیم توسعه',
                'department' => 'فنی',
                'direct_manager' => 'مدیر فنی',
                'job_level' => 'سینیور ۱',
                'contract_type' => 'تمام وقت',
                'work_status' => 'هیبریدی',
                'formality' => 'رسمی',
                'phone_number' => '09123456789',
                'email' => 'mehdi@example.com',
                'organization_email' => 'mehdi@company.com',
                'gender' => 'مرد',
            ]
        );

        // ایجاد حقوق برای کارمند
        Payroll::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'level' => 'سینیور ۱',
                'base_salary' => 150000000,
                'seniority' => 5000000,
                'housing' => 10000000,
                'marriage' => 5000000,
                'children' => 0,
                'responsibility' => 20000000,
                'food' => 3000000,
                'informal' => 50000000,
            ]
        );

        $this->command->info('حقوق نمونه با موفقیت ایجاد شد!');
    }
}
