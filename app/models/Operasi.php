<?php

class Operasi extends Eloquent {

	protected $table = 't_operasi';
	protected $primaryKey = 'id_operasi';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relUser()
    {
        return $this->belongsTo('User', 'id_user');
    }

    /* Be a source table */
    public function relRequest()
    {
        return $this->hasMany('RequestOperasi', 'id_request');
    }

    public function relDetailOperasi()
    {
        return $this->hasMany('DetailOperasi', 'id_detail_operasi');
    }

    public function relTelegram()
    {
        return $this->hasMany('Telegram', 'id_telegram');
    }

    public function relSuratPerintah()
    {
        return $this->hasMany('SuratPerintah', 'id_surat_perintah');
    }

    public function relFotoOperasi()
    {
        return $this->hasMany('FotoOperasi', 'id_foto_operasi');
    }
    
}