<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTFotoOperasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_foto_operasi', function(Blueprint $table) {
            $table->increments('id_foto_operasi');
            $table->integer('id_operasi');
            $table->string('foto_op')->nullable();
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
		Schema::dropIfExists('t_foto_operasi');
	}

}
