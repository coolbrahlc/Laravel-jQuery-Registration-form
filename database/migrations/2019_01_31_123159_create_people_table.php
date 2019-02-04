<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->date('birth')->nullable();
            $table->string('country')->nullable();
            $table->string('subject')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();

            $table->boolean('hidden')->default(0);
            $table->string('photo')->nullable();
            $table->mediumText('about')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
