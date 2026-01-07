<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            
            $table->morphs('payable'); 
            

            
            $table->decimal('amount', 12, 2);
            $table->enum('status', [
                'pending',   
                'paid',      
                'failed'     
            ])->default('pending');

            
            $table->string('payment_method')->default('mock');

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
