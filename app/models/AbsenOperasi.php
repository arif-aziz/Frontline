<?php

class AbsenOperasi extends Eloquent {

	protected $table = 't_absen_operasi';
	protected $primaryKey = 'id_absen_operasi';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relDetailOperasi()
    {
        return $this->belongsTo('DetailOperasi', 'id_detail_operasi');
    }

    public function relUser()
    {
        return $this->belongsTo('User', 'id_user');
    }
    
}