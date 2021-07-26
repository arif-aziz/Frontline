<?php

class Telegram extends Eloquent {

	protected $table = 't_telegram';
	protected $primaryKey = 'id_telegram';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relOperasi()
    {
        return $this->belongsTo('Operasi', 'id_operasi');
    }
    
}