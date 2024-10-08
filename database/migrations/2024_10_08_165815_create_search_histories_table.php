<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->integer('num_questions');
            $table->string('difficulty');
            $table->string('type')->nullable(); // Type is optional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('search_history');
    }
}
