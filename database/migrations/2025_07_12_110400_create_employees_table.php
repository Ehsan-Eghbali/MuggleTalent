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
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('position_chart')->nullable();
            $table->string('team')->nullable();
            $table->string('department')->nullable();
            $table->string('direct_manager')->nullable();
            $table->string('job_level')->nullable();
            $table->enum('contract_type', ['دورکاری', 'کارآموزی', 'آزمایشی', 'تمام وقت', 'پاره وقت'])->nullable();
            $table->enum('work_status', ['حضوری', 'دورکار', 'هیبریدی'])->nullable();
            $table->enum('formality', ['رسمی', 'غیررسمی'])->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('organization_email')->nullable();
            $table->enum('gender', ['مرد', 'زن'])->nullable();
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
