<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    
    if (!Schema::hasTable('brands')) {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    
    Schema::table('vehicles', function (Blueprint $table) {
        if (!Schema::hasColumn('vehicles', 'brand_id')) {
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
        }
    });
}

    
    public function down(): void
    {
        
    }
};
