<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEzohsBisyorjonibas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ezohs_bisyorjonibas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ezohs_id')->unsigned();
            $table->unsignedBigInteger('bisyorjonibas_id')->unsigned();
            $table->foreign('ezohs_id')->references('id')->on('ezohs')
                ->onDelete('cascade');
            $table->foreign('bisyorjonibas_id')->references('id')->on('bisyorjonibas')
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
        Schema::dropIfExists('ezohs_bisyorjonibas');
    }
}
