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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('national_code')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_serial')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('id_issue_place')->nullable();
            $table->date('birth_date_shamsi')->nullable();
            $table->integer('birth_day_shamsi')->nullable();
            $table->integer('birth_month_shamsi')->nullable();
            $table->integer('birth_year_shamsi')->nullable();
            $table->date('birth_date_real')->nullable();
            $table->integer('age')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
