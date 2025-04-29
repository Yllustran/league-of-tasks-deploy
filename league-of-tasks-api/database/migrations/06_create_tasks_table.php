<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name', 150);
            $table->boolean('mobility_req');
            $table->boolean('vision_req');
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy');
            $table->smallInteger('reward_xp')->unsigned()->default(0);
            $table->smallInteger('reward_gold')->unsigned()->default(0);
            $table->timestamps();

            // Foreign Key
            $table->foreignId('interest_id')->constrained('interests')->cascadeOnDelete();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
