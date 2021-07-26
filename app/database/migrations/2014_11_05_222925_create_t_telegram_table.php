<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTelegramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_telegram', function(Blueprint $table) {
            $table->increments('id_telegram');
            $table->integer('id_operasi');
            $table->string('tgram_dari', 255);
            $table->string('tgram_nama', 255);
            $table->string('tgram_nrp', 20);
            $table->string('tgram_pangkat', 255)->nullable();
            $table->text('tgram_kepada');
            $table->text('tgram_tembusan')->nullable();
            $table->string('tgram_derajat', 100);
            $table->string('tgram_klasifikasi', 100);
            $table->string('tgram_nomor', 255);
            $table->date('tgram_tanggal');
            $table->text('tgram_isia')->nullable();
            $table->text('tgram_isib')->nullable();
            $table->text('tgram_isic')->nullable();
            $table->text('tgram_isid')->nullable();
            $table->text('tgram_isie')->nullable();
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
		Schema::dropIfExists('t_telegram');
	}

}
