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
        Schema::create('payroll_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_id')->constrained('payrolls')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // کاربری که تغییر را ثبت کرده
            
            // مقادیر قبلی
            $table->string('old_level')->nullable();
            $table->decimal('old_base_salary', 15, 2)->nullable();
            $table->decimal('old_seniority', 15, 2)->nullable();
            $table->decimal('old_housing', 15, 2)->nullable();
            $table->decimal('old_marriage', 15, 2)->nullable();
            $table->decimal('old_children', 15, 2)->nullable();
            $table->decimal('old_responsibility', 15, 2)->nullable();
            $table->decimal('old_food', 15, 2)->nullable();
            $table->decimal('old_informal', 15, 2)->nullable();
            
            // مقادیر جدید
            $table->string('new_level')->nullable();
            $table->decimal('new_base_salary', 15, 2)->nullable();
            $table->decimal('new_seniority', 15, 2)->nullable();
            $table->decimal('new_housing', 15, 2)->nullable();
            $table->decimal('new_marriage', 15, 2)->nullable();
            $table->decimal('new_children', 15, 2)->nullable();
            $table->decimal('new_responsibility', 15, 2)->nullable();
            $table->decimal('new_food', 15, 2)->nullable();
            $table->decimal('new_informal', 15, 2)->nullable();
            
            // اطلاعات تغییر
            $table->string('change_reason')->nullable(); // علت تغییر
            $table->text('change_details')->nullable(); // جزئیات تغییر
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_history');
    }
};
