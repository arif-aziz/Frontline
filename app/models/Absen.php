<?php

class Absen extends Eloquent {

	protected $table = 't_absen';
	protected $primaryKey = 'id_absen';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relUser()
    {
        return $this->belongsTo('User', 'id_user');
    }

    public function relPersonel()
    {
        return $this->belongsTo('Personel', 'id_personel');
    }
    
}