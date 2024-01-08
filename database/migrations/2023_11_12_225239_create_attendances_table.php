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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // 'staff_id', 'time_in','time_out','day', 'month', 'year', 'status'
            // $table->unsignedBigInteger('staff_id');
            $table->string('employee_name');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->bigInteger('day')->nullable();
            $table->bigInteger('month')->nullable();
            $table->bigInteger('year')->nullable();
            $table->string('status')->nullable();
            $table->string('captured')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
