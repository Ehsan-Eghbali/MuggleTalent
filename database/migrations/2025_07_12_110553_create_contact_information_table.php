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
        Schema::create('contact_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ارتباط با جدول employees
            $table->string('emergency_contact')->nullable(); // شماره تماس ضروری
            $table->string('emergency_contact_info')->nullable(); // اطلاعات تماس ضروری
            $table->string('address')->nullable(); // آدرس منزل
            $table->string('postal_code')->nullable(); // کدپستی
            $table->timestamps(); // زمان ایجاد و به روز رسانی
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_information');
    }
};
