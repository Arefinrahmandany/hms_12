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
        Schema::create('chambers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');

            $table->string('name');             // Chamber/clinic name
            $table->text('address');            // Chamber address
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('working_days')->nullable(); // e.g., Mon-Fri
            $table->decimal('consultation_fee', 10, 2)->nullable();

            $table->boolean('status')->default(1);      // Active / Inactive
            $table->timestamps();
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambers');
    }
};
