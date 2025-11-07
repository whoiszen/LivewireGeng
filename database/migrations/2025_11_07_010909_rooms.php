<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10);
            $table->integer('capacity');
            $table->decimal('price', 10, 2);
            $table->foreignId('renter_id')
                  ->nullable()
                  ->constrained('renters') // references 'id' automatically
                  ->nullOnDelete(); // use ->nullOnDelete() instead of onDelete('set null')
            $table->timestamps();
        });
        
    }

    public function down(): void {
        Schema::dropIfExists('rooms');
    }
};
