<?php

class Personel extends Eloquent {

	protected $table = 'm_personel';
	protected $primaryKey = 'id_personel';

	protected $guarded = array();
	public static $rules = array();

	/* Be a source table */
    public function relAbsen()
    {
        return $this->hasMany('Absen', 'id_absen');
    }

    public function relDetailOperasi()
    {
        return $this->hasMany('DetailOperasi', 'id_detail_operasi');
    }

	/* Be a target table */
    public function relUser()
    {
        return $this->belongsTo('User', 'id_user');
    }

}
