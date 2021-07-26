<?php

class AktifitasUser extends Eloquent {

	protected $table = 'm_aktifitas_user';
	protected $primaryKey = "id_aktifitas_user";

	protected $guarded = array();
	public static $rules = array();

	/* Be a source table */
    public function relHakAkses()
    {
        return $this->hasMany("HakAkses", "id_hak_akses");
    }

}
