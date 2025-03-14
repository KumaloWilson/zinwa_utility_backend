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
        Schema::create('meters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('meter_number')->unique();
            $table->enum('meter_type', ['prepaid', 'postpaid'])->default('prepaid');
            $table->string('location')->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->decimal('last_reading', 10, 2)->default(0);
            $table->timestamp('last_reading_date')->nullable();
            $table->timestamp('installation_date')->nullable();
            $table->boolean('is_validated')->default(false);
            $table->timestamp('validation_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meters');
    }
};

