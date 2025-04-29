<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('users_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
        
            $table->smallInteger('quantity')->unsigned()->default(1);
        
            // Prevents duplicate user-item entries
            $table->unique(['user_id', 'item_id']);
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('users_items');
    }
};
