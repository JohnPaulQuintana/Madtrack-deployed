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
        Schema::create('rejecteds', function (Blueprint $table) {
            $table->id();
            $table->string('product_type');
            $table->string('product_name')->nullable();
            $table->string('product_brand')->nullable();
            $table->bigInteger('stocks')->nullable();
            $table->double('product_pcs_price')->nullable();
            $table->double('product_pack_price')->nullable();
            $table->double('product_pcs_per_pack')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejecteds');
    }
};
