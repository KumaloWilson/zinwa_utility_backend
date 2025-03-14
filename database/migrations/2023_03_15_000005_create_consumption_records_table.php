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
        Schema::create('consumption_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meter_id')->constrained();
            $table->foreignId('token_id')->nullable()->constrained();
            $table->decimal('reading', 10, 2);
            $table->decimal('units_consumed', 10, 2);
            $table->timestamp('reading_date');
            $table->enum('reading_type', ['manual', 'automatic', 'estimated'])->default('automatic');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumption_records');
    }
};

