<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('rental_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_transaction_id')
                  ->constrained('rental_transactions')
                  ->cascadeOnDelete();
            $table->foreignId('addon_id')->constrained('addons')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
        
        
    }

    public function down(): void {
        Schema::dropIfExists('rental_addons');
    }
};
