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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('pasargad_account_number')->nullable();
            $table->string('pasargad_sheba')->nullable();
            $table->string('pasargad_card')->nullable();
            $table->string('pasargad_branch')->nullable();
            $table->enum('bank_type', ['ملی', 'پاسارگاد', 'سایر'])->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sheba_number')->nullable();
            $table->string('card_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
