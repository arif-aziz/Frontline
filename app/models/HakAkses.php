<?php

class HakAkses extends Eloquent {

	protected $table = 'm_hak_akses';
	protected $primaryKey = "id_hak_akses";

	protected $guarded = array();
	public static $rules = array();

	/* Be a target table */
    public function relAktifitasUser()
    {
        return $this->belongsToMany("AktifitasUser", "id_aktifitas_user");
    }

    public function relTipeUser()
    {
        return $this->belongsToMany("TipeUser", "id_tipe_user");
    }

}
