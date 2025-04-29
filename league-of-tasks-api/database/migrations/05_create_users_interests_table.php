<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  
    public function up()
    {
        Schema::create('users_interests', function (Blueprint $table) {

            $table->id();

            // Foreign Key
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('interest_id')->constrained('interests')->cascadeOnDelete();
        
            // Prevents duplicate user-interest entries
            $table->unique(['user_id', 'interest_id']);

        });        
    }


    public function down()
    {
        Schema::dropIfExists('users_interests');
    }
};
