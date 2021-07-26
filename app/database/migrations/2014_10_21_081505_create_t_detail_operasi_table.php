<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTDetailOperasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_detail_operasi', function(Blueprint $table) {
            $table->increments('id_detail_operasi');
            $table->integer('id_request');
            $table->integer('id_rekomender');
            $table->integer('id_operasi');
            $table->integer('id_personel');
            $table->enum('posisi', array('inti', 'cadangan'));
            $table->string('keterangan_detail_op', 255)->nullable();
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
		Schema::dropIfExists('t_detail_operasi');
	}

}