<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPersonelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('m_personel', function(Blueprint $table) {
            $table->increments('id_personel');
            $table->integer('id_user');
            $table->integer('id_provinsi')->default(35);
            $table->integer('id_kota')->default(17);
            $table->integer('id_kecamatan')->default(0);
            $table->string('foto_personel')->nullable();
            $table->string('nrp', 20);
            $table->string('nama_lengkap', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('alamat', 255)->nullable();
            $table->enum('instansi', array('polres', 'polsek'));
            $table->string('pangkat', 255);
            $table->string('jabatan', 255);
            $table->date('tanggal_jabatan');
            $table->string('satuan_kerja', 255)->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('riwayat_kerja')->nullable();
            $table->enum('status_personel', array('aktif', 'non-aktif', 'mutasi'))->default('aktif');
            $table->integer('is_operasi')->default(0);
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
		Schema::dropIfExists('m_personel');
	}

}
