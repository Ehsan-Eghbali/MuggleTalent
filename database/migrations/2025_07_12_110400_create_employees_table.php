<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number'); // شماره پرسنلی
            $table->string('first_name'); // نام اصلی
            $table->string('last_name'); // نام خانوادگی
            $table->string('full_name'); // نام و نام خانوادگی
            $table->string('position'); // سمت
            $table->string('team'); // تیم
            $table->string('department'); // واحد
            $table->string('manager'); // مدیر
            $table->string('job_level'); // رده شغلی
            $table->enum('contract_type', ['full_time', 'part_time']); // نوع قرارداد
            $table->enum('work_status', ['on_site', 'remote', 'hybrid']); // وضعیت حضور
            $table->enum('formality', ['formal', 'informal']); // رسمی / غیررسمی
            $table->string('phone_number'); // شماره تماس
            $table->string('email')->nullable(); // ایمیل شخصی
            $table->string('organization_email')->nullable(); // ایمیل سازمانی
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
