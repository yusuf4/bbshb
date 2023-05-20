<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBisyorjonibasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bisyorjonibas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('etibor_digar');
            $table->date('sanai_etibor');
            $table->date('qati_etibor');
            $table->string('maqomot');
            $table->string('ezoh');
            $table->foreignId('file_shartnoma_id')->constrained('file_shartnomas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('namudi_shartnoma_id')->constrained('namudi_shartnomas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('tartibi_etibor_id')->constrained('tartibi_etibors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('muhlati_etibor_id')->constrained('muhlati_etibors')
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
        Schema::dropIfExists('bisyorjonibas');
    }
}
