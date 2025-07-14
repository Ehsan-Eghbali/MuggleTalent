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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // ارتباط با جدول employees
            $table->string('degree'); // مدرک تحصیلی
            $table->string('major'); // رشته تحصیلی
            $table->string('university'); // دانشگاه
            $table->timestamps(); // زمان ایجاد و به روز رسانی

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
