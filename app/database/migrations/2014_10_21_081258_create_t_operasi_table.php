<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTOperasiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_operasi', function(Blueprint $table) {
            $table->increments('id_operasi');
            $table->integer('id_user');
            $table->enum('jenis_op', array('opkhusus', 'oprutin'));
            $table->string('nama_op', 255);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('jam_mulai', 255);
            $table->string('jam_selesai', 255);
            $table->decimal('anggaran_pasti', 12, 0)->default(0);
            $table->decimal('index_anggaran_min', 12, 0)->default(0);
            $table->decimal('index_anggaran_max', 12, 0)->default(0);
            $table->integer('jumlah_personel')->default(0);
            $table->string('keterangan_op', 255)->nullable();
            $table->enum('status_op', array('akan-datang', 'proses', 'selesai', 'tunda', 'batal'));
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
		Schema::dropIfExists('t_operasi');
	}

}
