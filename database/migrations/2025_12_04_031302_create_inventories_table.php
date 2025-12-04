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
        // ONLY CREATE ONE TABLE: Use the plural form 'inventories'
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_name');
            $table->integer('stock_quantity')->default(0); // Added default for safety
            $table->string('unit'); // e.g., 'tablets', 'bottles'
            $table->timestamps();
        });
        
        // --- REMOVE THE SECOND Schema::create('inventory', ...) BLOCK ---
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ensure the down method drops the corresponding table
        Schema::dropIfExists('inventories');
    }
};