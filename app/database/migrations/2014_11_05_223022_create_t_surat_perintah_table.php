<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTSuratPerintahTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_surat_perintah', function(Blueprint $table) {
            $table->increments('id_surat_perintah');
            $table->integer('id_operasi');
            $table->string('sprin_nomor', 255);
            $table->text('sprin_pertimbangan');
            $table->text('sprin_dasar');
            $table->text('sprin_kepada');
            $table->text('sprin_untuk');
            $table->text('sprin_tembusan')->nullable();
            $table->string('sprin_dikeluarkan_di', 100);
            $table->date('sprin_tanggal');
            $table->string('sprin_pengirim', 255);
            $table->string('sprin_jabatan', 255);
            $table->string('sprin_pangkat', 255);
            $table->string('sprin_nrp', 255);
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
		Schema::dropIfExists('t_surat_perintah');
	}

}
