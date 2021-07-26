<?php

class UserController extends BaseController {

    public function getIndex()
    {
    	$dataUser       = $this->getDataUser();
        $dataAuthUser   = $this->getDataAuthUser();

        return View::make('user.home')
        		   ->with(array(
        		   				'user' 		=> $dataUser,
                                'authUser'  => $dataAuthUser
        		   	 ));
    }

    public function getCreateUser()
    {
        $dataWilayah    = $this->getDataWilayah();
        $dataTipeUser   = TipeUser::get();
        $dataUser       = $this->getDataUser();
        $dataAuthUser   = $this->getDataAuthUser();

        if ($this->cekInputUser() == 'available') {
            return View::make('user.create')
                       ->with(array(
                                    'wilayah'   => $dataWilayah,
                                    'tipeUser'  => $dataTipeUser,
                                    'user'      => $dataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } elseif ($this->cekViewUser() == 'available') {
            return View::make('user.home')
                       ->with(array(
                                    'user'      => $dataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postCreateUser()
	{
        $destinationPath = public_path().'images/user/';
        $hasilValidasi   = $this->validasi( Input::all() );
        
        if( $hasilValidasi->passes() ) {
            if (Input::hasFile('file-foto-user')) 
            {
                $fileFoto = Input::file('file-foto-user');
                $filename = $fileFoto->getClientOriginalName();

                $fileFoto->move($destinationPath, $filename);
            } else {
                $filename = 'fotodefault.jpg';
            }

            $dataUser = array(
                'id_tipe_user'      => Input::get('slc-tipe-user'),
                'id_provinsi'       => 35,
                'id_kota'           => 17,
                'id_kecamatan'      => Input::get('slc-wilayah'),
                'username'          => Input::get('txt-username'),
                'password'          => Hash::make( Input::get('txt-username') ),
                'nama_lengkap_user' => ucwords(Input::get('txt-nama-lengkap')),
                'status_user'       => Input::get('rad-status-user'),
                'foto_user'         => $filename
            );

            User::create($dataUser);

            return Redirect::to('user')
            			   ->with('flash_success', 'Data User telah ditambahkan');
        } else {
            return Redirect::to('user')
                           ->with('flash_error', 'Username sama, ganti dengan yang lain');
        }
	}

	public function getUpdateUser( $idUser )
    {
		$dataWilayah    = $this->getDataWilayah();
		$dataTipeUser 	= TipeUser::get();
    	$dataUser       = $this->getDataUser();
    	$matchDataUser	= User::where('id_user', $idUser)
    						  ->firstOrFail();
        $dataAuthUser   = $this->getDataAuthUser();

        if ($this->cekInputUser() == 'available') {
            return View::make('user.update')
            		   ->with(array(
            		   				'wilayah'	=> $dataWilayah,
            		   				'tipeUser' 	=> $dataTipeUser,
            		   				'user' 		=> $dataUser,
            		   				'matchUser' => $matchDataUser,
                                    'authUser'  => $dataAuthUser
            		   	 ));
        } elseif ($this->cekViewUser() == 'available') {
            return View::make('user.home')
                       ->with(array(
                                    'user'      => $dataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } else {
            return Redirect::to('dashboard');
        }
	}

	public function postUpdateUser( $idUser )
	{
        $destinationPath = public_path().'images/user/';
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();

        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);
                
                if (Input::hasFile('file-foto-user')) 
                {
                    $fileFoto = Input::file('file-foto-user');
                    $filename = $fileFoto->getClientOriginalName();;

                    $fileFoto->move($destinationPath, $filename);
                } else {
                    $filename = 'fotodefault.jpg';
                }

                User::where('id_user', $idUser)
                    ->update(array(
                            'username'          => Input::get('txt-username'),
                            'id_tipe_user'      => Input::get('slc-tipe-user'),
                            'id_kecamatan'      => Input::get('slc-wilayah'),
                            'status_user'       => Input::get('rad-status-user'),
                            'nama_lengkap_user' => ucwords(Input::get('txt-nama-lengkap')),
                            'foto_user'         => $filename
                            ));

                return Redirect::to('user')
                               ->with('flash_success', 'Data User telah diubah');
            } else {
                return Redirect::to('user')
                               ->with('flash_error', 'Password salah, Data User gagal diubah ');
            }
        }        
	}

    public function getDeleteUser( $idUser )
    {
        $dataWilayah    = $this->getDataWilayah();
        $dataUser       = $this->getDataUser();
        $matchDataUser  = User::where('id_user', $idUser)
                              ->firstOrFail();
        $dataAuthUser   = $this->getDataAuthUser();

        if ($this->cekInputUser() == 'available') {
            return View::make('user.delete')
                       ->with(array(
                                    'wilayah'   => $dataWilayah,
                                    'user'      => $dataUser,
                                    'matchUser' => $matchDataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } elseif ($this->cekViewUser() == 'available') {
            return View::make('user.home')
                       ->with(array(
                                    'user'      => $dataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postDeleteUser( $idUser )
    {
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();

        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);
                
                User::where('id_user', $idUser)
                    ->delete();

                return Redirect::to('user')
                               ->with('flash_success', 'Data User telah dihapus');
            } else {
                return Redirect::to('user')
                               ->with('flash_error', 'Password salah, Data User gagal dihapus');
            }
        }
    }

    public function getResetPasswordUser( $idUser )
    {
        $dataWilayah    = $this->getDataWilayah();
        $dataUser       = $this->getDataUser();
        $matchDataUser  = User::where('id_user', $idUser)
                              ->firstOrFail();
        $dataAuthUser   = $this->getDataAuthUser();

        if ($this->cekInputUser() == 'available') {
            return View::make('user.reset')
                       ->with(array(
                                    'wilayah'   => $dataWilayah,
                                    'user'      => $dataUser,
                                    'matchUser' => $matchDataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } elseif ($this->cekViewUser() == 'available') {
            return View::make('user.home')
                       ->with(array(
                                    'user'      => $dataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postResetPasswordUser( $idUser )
    {
        $password   = Input::get('txt-password');
        $dataUser   = User::where('username', Auth::user()->username)->firstOrFail();
        $matchUser  = User::where('id_user', $idUser)->firstOrFail();

        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);
                
                User::where('id_user', $idUser)
                    ->update(array( 'password' => $matchUser->username ));

                return Redirect::to('user')
                               ->with('flash_success', 'Password User <label>'. $matchUser->username .'</label> telah di-reset menjadi <label>'. $matchUser->username .'</label>');
            } else {
                return Redirect::to('user')
                               ->with('flash_error', 'Password salah, Password User gagal di-reset');
            }
        }
    }

	public function getViewUser( $idUser )
    {
		$dataUser 		= $this->getDataUser();
    	$matchDataUser	= User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                              ->join('m_area', 'm_area.id_kecamatan', '=', 'm_user.id_kecamatan')
                              ->where('m_area.id_provinsi', 35)
                              ->where('m_area.id_kota', 17)
                              ->where('m_user.id_user', $idUser)
                              ->firstOrFail();
        $dataAuthUser   = $this->getDataAuthUser();

        if ($this->cekViewUser() == 'available') {
            return View::make('user.view')
                       ->with(array(
                                    'user'      => $dataUser,
                                    'matchUser' => $matchDataUser,
                                    'authUser'  => $dataAuthUser
                         ));
        } else {
            return Redirect::to('dashboard');
        }
	}

    public function validasi( $input ) 
    {
        $rules = array(
            'txt-username' => 'unique:m_user,username'
        );

        return Validator::make($input, $rules);
    }

    public function getDataWilayah()
    {
        $dataWilayah = Area::where("level", 3)
                           ->where("id_provinsi", 35)
                           ->where("id_kota", 17)
                           ->get();
        
        return $dataWilayah;       
    }

    public function getDataUser()
    {
        $dataUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                        ->where('m_user.id_user', '<>', Auth::user()->id_user)
                        ->get();
                        
        return $dataUser;
    }

    public function getDataAuthUser()
    {
        $dataAuthUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                            ->where('m_user.id_user', Auth::user()->id_user)
                            ->firstOrFail();

        return $dataAuthUser;
    }

    public function cekInputUser() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-user') {
                return 'available';
            }
        }
    }

    public function cekViewUser() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'view-user') {
                return 'available';
            }
        }
    }

}