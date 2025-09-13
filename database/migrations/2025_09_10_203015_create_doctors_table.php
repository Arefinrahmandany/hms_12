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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('photo')->nullable();

            $table->string('specialization')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('experience')->nullable();
            $table->string('degree')->nullable();
            $table->string('registration_number')->nullable();

            $table->string('department')->nullable();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('languages')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
