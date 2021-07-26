<?php

class TipeUser extends Eloquent {

	protected $table = 'm_tipe_user';
	protected $primaryKey = "id_tipe_user";

	protected $guarded = array();
	public static $rules = array();

	/* Be a source table */
    public function relUser()
    {
        return $this->hasMany("User", "id_user");
    }

    public function relHakAkses()
    {
        return $this->hasMany("HakAkses", "id_hak_akses");
    }
    
}