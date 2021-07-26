<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMHakAksesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_hak_akses', function(Blueprint $table) {
            $table->increments('id_hak_akses');
            $table->integer('id_tipe_user');
            $table->integer('id_aktifitas_user');
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
		Schema::dropIfExists('m_hak_akses');
	}

}
