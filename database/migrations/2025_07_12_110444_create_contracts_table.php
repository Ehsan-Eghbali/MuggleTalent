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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ارتباط با جدول employees
            $table->string('contract_number')->nullable(); // شماره قرارداد
            $table->date('start_date')->nullable(); // تاریخ شروع قرارداد
            $table->date('end_date')->nullable(); // تاریخ پایان قرارداد
            $table->string('contract_type')->nullable(); // نوع قرارداد
            $table->timestamps(); // زمان ایجاد و به روز رسانی

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
