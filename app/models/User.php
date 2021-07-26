<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'm_user';
	protected $primaryKey = 'id_user';

	protected $hidden = array('password', 'remember_token');
	protected $guarded = array();
	public static $rules = array();

	public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /* Be a source table */
    public function relPersonel()
    {
        return $this->hasMany('Personel', 'id_personel');
    }

    public function relAbsen()
    {
        return $this->hasMany('Absen', 'id_absen');
    }

    public function relOperasi()
    {
        return $this->hasMany('Operasi', 'id_operasi');
    }

    public function relRequest()
    {
        return $this->hasMany('RequestOperasi', 'id_request');
    }

    public function relDetailOperasi()
    {
        return $this->hasMany('DetailOperasi', 'id_detail_operasi');
    }

    public function relAbsenOperasi()
    {
        return $this->hasMany('AbsenOperasi', 'id_absen_operasi');
    }

    /* Be a target table */
    public function relTipeUser()
    {
        return $this->belongsTo('TipeUser', 'id_tipe_user');
    }

    public function relArea()
    {
        return $this->belongsTo('Area', 'id_area');
    }

}
