<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_user', function(Blueprint $table) {
            $table->increments('id_user');
            $table->integer('id_tipe_user');
            $table->integer('id_provinsi')->default(35);
            $table->integer('id_kota')->default(17);
            $table->integer('id_kecamatan')->default(0);
            $table->string('foto_user')->nullable();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('nama_lengkap_user', 255);
            $table->enum('status_user', array('aktif', 'non-aktif'))->default('aktif');
            $table->string('remember_token', 100)->nullable();
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
		Schema::dropIfExists('m_user');
	}

}
