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
        Schema::create('military', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ارتباط با جدول employees
            $table->enum('military_status', ['completed', 'not_completed'])->nullable(); // وضعیت سربازی
            $table->date('start_date')->nullable(); // تاریخ شروع سربازی
            $table->date('end_date')->nullable(); // تاریخ اتمام سربازی
            $table->timestamps(); // زمان ایجاد و به روز رسانی

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military');
    }
};
