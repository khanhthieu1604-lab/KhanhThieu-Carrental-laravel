<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        
        $table->string('role')->default('customer')->after('email'); 
        $table->string('phone')->nullable()->after('role'); 
        $table->string('address')->nullable()->after('phone');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'phone', 'address']);
    });
}
};
