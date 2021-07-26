<?php

class FotoOperasi extends Eloquent {

	protected $table = 't_foto_operasi';
	protected $primaryKey = 'id_foto_operasi';

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relOperasi()
    {
        return $this->belongsTo('Operasi', 'id_operasi');
    }
    
}