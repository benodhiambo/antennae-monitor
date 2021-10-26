<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceptance_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('installation_report_id');
            $table->foreign('installation_report_id')->references('id')->on('installation_reports');
            $table->string('comment');
            $table->string('status')->default('Pending');
            $table->string('acceptance_form');
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
        Schema::dropIfExists('acceptance_reports');
    }
}
