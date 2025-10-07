<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personnel_id'); // آیدی پرسنل
            $table->string('template_key');             // کلید قالب: مثلا employment_certificate
            $table->string('number')->nullable();       // شماره نامه
            $table->date('issued_at')->nullable();      // تاریخ صدور
            $table->json('fields')->nullable();         // فیلدهای داینامیک (json)
            $table->longText('body_html')->nullable();  // متن نهایی اچ‌تی‌ام‌ال
            $table->string('status')->default('draft'); // draft|final
            $table->unsignedBigInteger('created_by');   // صادرکننده
            $table->timestamps();

            $table->index(['personnel_id', 'template_key']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('letters');
    }
};
