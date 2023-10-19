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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('rating');
            $table->text('comment');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->unique(['user_id', 'company_id']);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};