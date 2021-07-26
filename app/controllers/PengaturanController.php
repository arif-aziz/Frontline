<?php

class PengaturanController extends BaseController {

	public function getIndex()
	{
		$dataTipeUser = $this->getDataTipeUser();

		return View::make('pengaturan.home')
                                 ->with(array(
                                              'tipeUser'   => $dataTipeUser,
                                   ));
	}

	public function getCreatePengaturan()
	{
		$dataTipeUser 		= $this->getDataTipeUser();
		$dataAktifitasUser 	= $this->getDataAktifitasUser();

		return View::make('pengaturan.create')
                                 ->with(array(
                                              'tipeUser'   => $dataTipeUser,
                                              'aktifitas'  => $dataAktifitasUser
                                   ));	
	}

	public function postCreatePengaturan()
	{
		$dataTipeUser = array(
        	'instansi'		=> Input::get('rad-instansi'),
            'jabatan'      	=> Input::get('rad-jabatan'),
            'satuan_kerja'  => Input::get('txt-nama-satker')
        );

        $tipeUser = TipeUser::create($dataTipeUser);

        $postCount = count(Input::get('chk-aktifitas'));

        for ($i = 0; $i < $postCount; $i++) {
            $dataHakAkses = array(
                'id_tipe_user'          => $tipeUser->id_tipe_user,
                'id_aktifitas_user' 	=> Input::get('chk-aktifitas.'.$i)
            );
            
            HakAkses::create($dataHakAkses);
        }

		return Redirect::to('pengaturan')
					   ->with('flash_success', 'Data Tipe User & Aktifitasnya telah ditambahkan');
	}

	public function getUpdatePengaturan( $idTipeUser )
	{
		$tempHakAkses 		= array();
		$dataTipeUser 		= $this->getDataTipeUser();
		$dataAktifitasUser 	= $this->getDataAktifitasUser();
		$dataMatchTipeUser 	= $this->getDataMatchTipeUser( $idTipeUser );
		$dataMatchHakAkses 	= TipeUser::join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
									  ->select('m_hak_akses.id_aktifitas_user')
									  ->where('m_tipe_user.id_tipe_user', $idTipeUser)
									  ->get();

		foreach ($dataMatchHakAkses as $data) {
			$tempHakAkses[] = $data->id_aktifitas_user;
		}

		return View::make('pengaturan.update')
                                 ->with(array(
                                              'tipeUser'   		=> $dataTipeUser,
                                              'aktifitas'  		=> $dataAktifitasUser,
                                              'matchTipeUser'  	=> $dataMatchTipeUser,
                                              'matchHakAkses'  	=> $tempHakAkses
                                   ));	
	}

	public function postUpdatePengaturan( $idTipeUser )
	{
		$password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
				TipeUser::where('id_tipe_user', $idTipeUser)
						->update(array(
									'instansi'		=> Input::get('rad-instansi'),
						            'jabatan'      	=> Input::get('rad-jabatan'),
						            'satuan_kerja'  => Input::get('txt-nama-satker')
						  ));

		        HakAkses::where('id_tipe_user', $idTipeUser)->delete();

				$postCount = count(Input::get('chk-aktifitas'));

		        for ($i = 0; $i < $postCount; $i++) {
		            $dataHakAkses = array(
		                'id_tipe_user'          => $idTipeUser,
		                'id_aktifitas_user' 	=> Input::get('chk-aktifitas.'.$i)
		            );

		            HakAkses::create($dataHakAkses);
		        }

				return Redirect::to('pengaturan')
							   ->with('flash_success', 'Data Tipe User & Aktifitasnya telah diubah');
			} else {
                return Redirect::to('pengaturan')
                               ->with('flash_error', 'Password salah, Data Tipe User gagal diubah');
            }
        }
	}

	public function getDeletePengaturan( $idTipeUser )
	{
		$dataTipeUser 		= $this->getDataTipeUser();
		$dataMatchTipeUser 	= $this->getDataMatchTipeUser( $idTipeUser );

		return View::make('pengaturan.delete')
                                 ->with(array(
                                              'tipeUser'   		=> $dataTipeUser,
                                              'matchTipeUser'  	=> $dataMatchTipeUser
                                   ));	
	}

	public function postDeletePengaturan( $idTipeUser )
	{
		$password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
				TipeUser::where('id_tipe_user', $idTipeUser)->delete();
		        HakAkses::where('id_tipe_user', $idTipeUser)->delete();

				return Redirect::to('pengaturan')
							   ->with('flash_success', 'Data Tipe User & Aktifitasnya telah dihapus');	
			} else {
                return Redirect::to('pengaturan')
                               ->with('flash_error', 'Password salah, Data Tipe User gagal dihapus');
            }
        }
	}

	public function getViewPengaturan( $idTipeUser )
	{
		$dataTipeUser 		= $this->getDataTipeUser();
		$dataMatchTipeUser 	= $this->getDataMatchTipeUser( $idTipeUser );
		$dataMatchHakAkses 	= $this->getDataMatchHakAkses( $idTipeUser );

		return View::make('pengaturan.view')
                                 ->with(array(
                                              'tipeUser'   		=> $dataTipeUser,
                                              'matchTipeUser'  	=> $dataMatchTipeUser,
                                              'matchHakAkses'  	=> $dataMatchHakAkses
                                   ));	
	}

	public function getDataTipeUser()
	{
		$dataTipeUser = TipeUser::get();

		return $dataTipeUser;
	}

	public function getDataAktifitasUser()
	{
		$dataAktifitasUser = AktifitasUser::orderBy('kelompok', 'asc')->get();

		return $dataAktifitasUser;
	}

	public function getDataMatchTipeUser( $idTipeUser )
	{
		$dataMatchTipeUser = TipeUser::where('id_tipe_user', $idTipeUser)
									 ->firstOrFail();

		return $dataMatchTipeUser;
	}

	public function getDataMatchHakAkses( $idTipeUser )
	{
		$dataMatchHakAkses = HakAkses::join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
									 ->where('m_hak_akses.id_tipe_user', $idTipeUser)
									 ->orderBy('m_aktifitas_user.kelompok')
									 ->get();

		return $dataMatchHakAkses;
	}

}