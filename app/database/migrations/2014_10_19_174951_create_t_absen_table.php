<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAbsenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_absen', function(Blueprint $table) {
            $table->increments('id_absen');
            $table->integer('id_user');
            $table->integer('id_personel');
            $table->date('tanggal_absen');
            $table->enum('status_absen', array('hadir', 'sakit', 'cuti', 'sekolah', 'izin', 'alpha'))->default('hadir');
            $table->string('keterangan_absen', 255)->nullable();
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
		Schema::dropIfExists('t_absen');
	}

}
