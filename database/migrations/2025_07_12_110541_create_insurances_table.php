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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ارتباط با جدول employees
            $table->enum('insurance_type', ['basic', 'complementary'])->nullable(); // نوع بیمه
            $table->string('insurance_plan')->nullable(); // طرح بیمه
            $table->boolean('has_dependents')->default(false); // نفرات تحت تکفل
            $table->timestamps(); // زمان ایجاد و به روز رسانی
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
