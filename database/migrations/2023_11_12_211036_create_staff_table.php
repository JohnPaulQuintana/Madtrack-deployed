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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            // 'first_name', 'last_name', 'middle_name', 'birthdate', 'gender', 'contact', 'hired'
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->date('birthdate');
            $table->string('gender');
            $table->string('contact');
            $table->date('hired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
