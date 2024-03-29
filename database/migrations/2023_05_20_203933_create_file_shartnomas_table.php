<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileShartnomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_shartnomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bisyorjoniba_id')->nullable()->constrained('bisyorjonibas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('dujoniba_id')->nullable()->constrained('dujonibas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
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
        Schema::dropIfExists('file_shartnomas');
    }
}
