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
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('contract_number')->nullable();
            $table->date('trial_start_date')->nullable();
            $table->enum('exit_type', ['استعفا', 'اخراج', 'سایر'])->nullable();
            $table->text('exit_reason')->nullable();
            $table->enum('wants_insurance', ['دارد', 'ندارد'])->nullable();
            $table->enum('supplementary_insurance', ['طرح ۱', 'طرح ۲'])->nullable();
            $table->enum('cooperation_status', ['فعال', 'پاره وقت', 'تمام وقت', 'خارج شده'])->nullable();
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();
            $table->timestamps();
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
