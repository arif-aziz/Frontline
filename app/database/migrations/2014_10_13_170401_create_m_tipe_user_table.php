<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMTipeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_tipe_user', function(Blueprint $table) {
            $table->increments('id_tipe_user');
            $table->enum('instansi', array('polres', 'polsek'));
            $table->enum('jabatan', array('admin', 'kabag'));
            $table->string('satuan_kerja', 255);
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
		Schema::dropIfExists('m_tipe_user');
	}

}
