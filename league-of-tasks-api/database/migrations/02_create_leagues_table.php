<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('league_name', 150);
            $table->text('league_description')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};
