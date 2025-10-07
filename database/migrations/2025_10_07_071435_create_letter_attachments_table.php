<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('letter_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('letter_id');
            $table->string('original_name');
            $table->string('disk');
            $table->string('path');
            $table->string('mime')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();

            $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
            $table->index(['letter_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('letter_attachments');
    }
};
