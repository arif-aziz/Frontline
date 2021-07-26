<?php

class Area extends Eloquent {

	protected $table = 'm_area';
	protected $primaryKey = "id_area";

	protected $guarded = array();
	public static $rules = array();

	/* Be a source table */
    public function relUser()
    {
        return $this->hasMany("User", "id_user");
    }

    /* Be a source table */
    public function relPersonel()
    {
        return $this->hasMany("Personel", "id_personel");
    }

}
