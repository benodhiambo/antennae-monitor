<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {

            $table->string('cell_id')->primary();
            $table->string('cell_name');
            $table->string('sector_id');
            $table->string('site_id');
            $table->foreign('site_id')->references('site_id')->on('sites')->onDelete('cascade');
            $table->string('mnc');
            $table->string('status');
            $table->string('technology');
            $table->string('bcch_uarfcn_earfcn');
            $table->string('bsci_psc_pci');
            $table->float('heading');
            $table->float('pitch');
            $table->float('roll');
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
        Schema::dropIfExists('cells');
    }
}
