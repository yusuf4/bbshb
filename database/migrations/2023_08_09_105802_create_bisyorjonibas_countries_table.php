<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBisyorjonibasCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bisyorjonibas_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bisyorjonibas_id')->unsigned();
            $table->unsignedBigInteger('countries_id')->unsigned();
            $table->foreign('bisyorjonibas_id')->references('id')->on('bisyorjonibas')->onDelete('cascade');
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
        Schema::dropIfExists('bisyorjonibas_countries');
    }
}
