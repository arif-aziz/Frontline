<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAbsenOperasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_absen_operasi', function(Blueprint $table) {
            $table->increments('id_absen_operasi');
            $table->integer('id_detail_operasi');
            $table->integer('id_user');
            $table->date('tanggal_absen_op');
            $table->enum('status_absen_op', array('kerja', 'bebas-kerja','izin'))->default('kerja');
            $table->string('keterangan_absen_op', 255)->nullable();
            $table->decimal('gaji', 12, 0)->default(0);
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
		Schema::dropIfExists('t_absen_operasi');
	}

}
