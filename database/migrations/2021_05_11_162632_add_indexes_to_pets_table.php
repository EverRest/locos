<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pets', function (Blueprint $table) {
            if (Schema::hasTable('pets')) {
                Schema::table('pets', function (Blueprint $table) {
                    if (!Schema::hasColumn('pets', 'name')) {
                        $table->index('name');
                    }
                    if (!Schema::hasColumn('pets', 'description')) {
                        $table->index('description');
                    }
                });
            }
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
            if (Schema::hasTable('pets')) {
                Schema::table('pets', function (Blueprint $table) {
                    if (!Schema::hasColumn('pets', 'name')) {
                        $table->dropIndex(['name']);
                    }
                    if (!Schema::hasColumn('pets', 'description')) {
                        $table->dropIndex('description');
                    }
                });
            }
        });
    }
}
