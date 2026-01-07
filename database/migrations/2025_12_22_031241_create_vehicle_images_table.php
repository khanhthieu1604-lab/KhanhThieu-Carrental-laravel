<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            
            $table->string('type')->nullable(); 
            
            
            $table->decimal('price', 15, 2)->default(0); 
            
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};