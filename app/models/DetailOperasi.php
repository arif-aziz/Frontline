<?php

class DetailOperasi extends Eloquent {

	protected $table = 't_detail_operasi';
	protected $primaryKey = 'id_detail_operasi';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relUser()
    {
        return $this->belongsTo('User', 'id_user');
    }

    public function relOperasi()
    {
        return $this->belongsTo('Operasi', 'id_operasi');
    }

    public function relPersonel()
    {
        return $this->belongsTo('Personel', 'id_personel');
    }

    /* Be a target table */
    public function relAbsenOperasi()
    {
        return $this->hasMany('AbsenOperasi', 'id_absen_operasi');
    }
    
}