<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('properties', function (Blueprint $table) {
            $table->id('prop_id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('firstname', 20);
            $table->string('lastname', 20);
            $table->string('address');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('properties');
    }
};
