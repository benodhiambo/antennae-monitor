<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCellForeignToMonitorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitor_data', function (Blueprint $table) {
            $table->string('cell_id')->change();
            $table->foreign('cell_id')->references('cell_id')->on('cells')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitor_data', function (Blueprint $table) {
            //
        });
    }
}
