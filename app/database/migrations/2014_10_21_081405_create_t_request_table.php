<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_request', function(Blueprint $table) {
            $table->increments('id_request');
            $table->integer('id_pengirim');
            $table->integer('id_penerima');
            $table->date('tanggal_request');
            $table->integer('id_operasi');
            $table->integer('id_provinsi')->nullable();
            $table->integer('id_kota')->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->integer('jumlah_personel_perunit');
            $table->string('satuan_kerja', 255);
            $table->enum('status_request', array('diterima', 'ditolak', 'proses'));
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
		Schema::dropIfExists('t_request');
	}

}
