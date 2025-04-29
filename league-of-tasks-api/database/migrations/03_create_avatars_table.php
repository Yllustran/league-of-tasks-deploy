<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();
            $table->string('avatar_name', 150);
            $table->string('avatar_url', 255);
            $table->tinyInteger('level_required')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('avatars');
    }
};
