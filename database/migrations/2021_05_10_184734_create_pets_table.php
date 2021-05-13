<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('pet_types')
                ->onDelete('cascade');
            $table->string('name');
            $table->integer('years');
            $table->text('description');
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
        Schema::table('pets', function (Blueprint $table) {

            if (Schema::hasColumn('pets', 'type_id')) {
                $table->dropForeign(['type_id']);
            }
        });
        Schema::dropIfExists('pets');
    }
}
