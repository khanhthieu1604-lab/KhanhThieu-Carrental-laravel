<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
 public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); 
        $table->date('start_date'); 
        $table->date('end_date');   
        $table->decimal('total_price', 15, 2); 
        $table->string('status')->default('pending'); 
        $table->text('note')->nullable(); 
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
