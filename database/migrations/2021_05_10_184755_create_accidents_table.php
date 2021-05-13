<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pet_id')->nullable();
            $table->foreign('pet_id')->references('id')->on('pets')
                ->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('city');
            $table->text('accident')->nullable();
            $table->jsonb('coordinates')->nullable();
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
        Schema::table('accidents', function (Blueprint $table) {

            if (Schema::hasColumn('accidents', 'pet_id')) {
                $table->dropForeign(['pet_id']);
            }

            if (Schema::hasColumn('accidents', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
        Schema::dropIfExists('accidents');
    }
}
