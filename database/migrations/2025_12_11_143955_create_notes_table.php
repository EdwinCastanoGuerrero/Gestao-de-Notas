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
        Schema::create('notes', function (Blueprint $table) {
            $table->id(); // bigInteger, primary key, auto-incremento
            $table->string('title', 255); // obrigatório via validação
            $table->text('content')->nullable();// opcional
            $table->string('category', 100)->nullable();// opcional
            $table->boolean('is_favorite')->default(false);// padrão false
            $table->unsignedBigInteger('user_id');// chave estrangeira para users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');// relacionamento com users
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
