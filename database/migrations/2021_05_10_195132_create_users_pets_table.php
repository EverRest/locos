<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pet_id')->nullable();
            $table->foreign('pet_id')->references('id')->on('pets')
                ->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::table('users_pets', function (Blueprint $table) {

            if (Schema::hasColumn('users_pets', 'pet_id')) {
                $table->dropForeign(['pet_id']);
            }

            if (Schema::hasColumn('users_pets', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
        Schema::dropIfExists('users_pets');
    }
}
