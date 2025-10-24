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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('level')->nullable(); // رده شغلی
            $table->decimal('base_salary', 15, 2)->default(0); // حقوق ۳۰ روزه
            $table->decimal('seniority', 15, 2)->default(0); // پایه سنوات
            $table->decimal('housing', 15, 2)->default(0); // حق مسکن
            $table->decimal('marriage', 15, 2)->default(0); // حق تاهل
            $table->decimal('children', 15, 2)->default(0); // حق اولاد
            $table->decimal('responsibility', 15, 2)->default(0); // حق مسئولیت
            $table->decimal('food', 15, 2)->default(0); // خوار و بار
            $table->decimal('informal', 15, 2)->default(0); // غیررسمی
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
