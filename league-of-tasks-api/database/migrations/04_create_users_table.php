<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {



    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 150); 
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->mediumInteger('xp')->unsigned()->default(0);
            $table->mediumInteger('gold')->unsigned()->default(0);
            $table->tinyInteger('level')->unsigned()->default(0);
            $table->boolean('physical_disabled');
            $table->boolean('vision_impairment');

            // Number of tasks completed in the current season
            $table->tinyInteger('task_season')->unsigned()->default(0);

            // FOREIGN KEYS
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('league_id')->constrained('leagues')->onDelete('cascade');
            $table->foreignId('avatar_id')->constrained('avatars')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
