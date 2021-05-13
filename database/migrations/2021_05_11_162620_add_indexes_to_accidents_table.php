<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddIndexesToAccidentsTable
 */
class AddIndexesToAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('accidents')) {
            Schema::table('accidents', function (Blueprint $table) {
                if (!Schema::hasColumn('accidents', 'city')) {
                    $table->index('city');
                }
                if (!Schema::hasColumn('accidents', 'accident')) {
                    $table->index('accident');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('accidents')) {
            Schema::table('accidents', function (Blueprint $table) {
                if (!Schema::hasColumn('accidents', 'city')) {
                    $table->index('city');
                }
                if (!Schema::hasColumn('accidents', 'accident')) {
                    $table->index('accident');
                }
            });
        }
    }
}
