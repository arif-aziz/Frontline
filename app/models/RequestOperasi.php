<?php

class RequestOperasi extends Eloquent {

	protected $table = 't_request';
	protected $primaryKey = "id_request";

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relUser()
    {
        return $this->belongsTo("User", "id_user");
    }

    public function relOperasi()
    {
        return $this->belongsTo("Operasi", "id_operasi");
    }
    
}