<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('users_tasks', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete();
        
            $table->boolean('is_completed')->default(0);
            $table->timestamps();

            // Uniqueness constraint to prevent duplicate user-task entries
            $table->unique(['user_id', 'task_id']);
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('users_tasks');
    }
};
