<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        
        
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        
        
        
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
        
        $table->date('start_date');
        $table->date('end_date');
        
        
        $table->decimal('total_price', 15, 2);
        
        
        $table->string('status')->default('pending');
        
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};