<?php

class SuratPerintah extends Eloquent {

	protected $table = 't_surat_perintah';
	protected $primaryKey = 'id_surat_perintah';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relOperasi()
    {
        return $this->belongsTo('Operasi', 'id_operasi');
    }
    
}