<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDujonibasCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dujonibas_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dujonibas_id')->unsigned();
            $table->unsignedBigInteger('countries_id')->unsigned();
            $table->foreign('dujonibas_id')->references('id')->on('dujonibas')->onDelete('cascade');
            $table->foreign('countries_id')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::dropIfExists('dujonibas_countries');
    }
}
