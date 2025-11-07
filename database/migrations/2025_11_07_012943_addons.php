<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 30);
            $table->decimal('price', 10, 2);
            $table->string('description');
            $table->enum('status', ['active', 'inactive']);
            $table->date('created_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('addons');
    }
};
