<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->string('interest_name', 150);
            $table->text('interest_description')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interests');
    }
};
