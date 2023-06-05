<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomeriShartnomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomeri_shartnomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dujoniba_id')->nullable()->constrained('dujonibas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('bisyorjoniba_id')->nullable()->constrained('bisyorjonibas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('nomeri_shartnomas');
    }
}
