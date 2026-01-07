<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
   public function up()
{
    Schema::create('maintenances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); 
        $table->string('type'); 
        $table->decimal('cost', 12, 2); 
        $table->text('description')->nullable(); 
        $table->date('maintenance_date'); 
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
