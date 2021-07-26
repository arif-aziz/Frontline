<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMAreaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_area', function(Blueprint $table) {
            $table->increments('id_area');
            $table->integer('id_provinsi');
            $table->integer('id_kota')->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->string('nama');
            $table->integer('level')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('m_area');
	}

}
