<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAktifitasUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_aktifitas_user', function(Blueprint $table) {
            $table->increments('id_aktifitas_user');
            $table->string('aktifitas', 255)->unique();
            $table->string('kelompok', 255);
            $table->string('keterangan_aktifitas', 255)->nullable();
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
		Schema::dropIfExists('m_aktifitas_user');
	}

}
