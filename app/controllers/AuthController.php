<?php

class AuthController extends BaseController {

    public function getIndex()
	{
        if (Auth::check()){
            return Redirect::to('dashboard');
        } else {
		    return View::make('login.index');
        }
	}

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

	public function postLogin()
    {
        $username =  strtolower(Input::get('txt-username'));
        $password =  Input::get('txt-password');
        
        /* Select database user */
        $dataUser = User::where('username', $username)
            			->first();

        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);
                return Redirect::to('dashboard');
            }
        }

        return Redirect::to('/')
                       ->with('flash_error', ' Username / Password Anda salah');
    }

    public function getJumlahRequest()
    {
        $dataRequest = RequestOperasi::join('t_operasi', 't_operasi.id_operasi', '=', 't_request.id_operasi')
                                     ->where('t_request.status_request', 'proses')
                                     ->get();

        return $dataRequest;
    }

    public function getTipeUser()
    {
        $dataUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                        ->where('m_user.id_user', Auth::user()->id_user)
                        ->firstOrFail();

        return $dataUser;
    }

    public function getAktifitasUser()
    {
        $aktifitasUser = array();
        $tmpInputUser = 'not-available';
        $tmpInputPersonel = 'not-available';
        $tmpInputAbsen = 'not-available';
        $tmpInputOperasi = 'not-available';
        $tmpInputRequest = 'not-available';
        $tmpInputAbsenOperasi = 'not-available';
        $tmpInputSuratPerintah = 'not-available';
        $tmpViewUser = 'not-available';
        $tmpViewPersonel = 'not-available';
        $tmpViewAbsen = 'not-available';
        $tmpViewOperasi = 'not-available';
        $tmpViewAbsenOperasi = 'not-available';
        $tmpViewSuratPerintah = 'not-available';
        $tmpSistemSetting = 'not-available';
        $tmpSistemBackup = 'not-available';

        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-user') {
                $tmpInputUser = 'available';
            }

            if ($valDataUser->aktifitas == 'input-personel') {
                $tmpInputPersonel = 'available';
            }

            if ($valDataUser->aktifitas == 'input-absen') {
                $tmpInputAbsen = 'available';
            }

            if ($valDataUser->aktifitas == 'input-operasi') {
                $tmpInputOperasi = 'available';
            }

            if ($valDataUser->aktifitas == 'input-request') {
                $tmpInputRequest = 'available';
            }

            if ($valDataUser->aktifitas == 'input-absen-operasi') {
                $tmpInputAbsenOperasi = 'available';
            }

            if ($valDataUser->aktifitas == 'input-surat-perintah') {
                $tmpInputSuratPerintah = 'available';
            }

            if ($valDataUser->aktifitas == 'view-user') {
                $tmpViewUser = 'available';
            }

            if ($valDataUser->aktifitas == 'view-personel') {
                $tmpViewPersonel = 'available';
            }

            if ($valDataUser->aktifitas == 'view-absen') {
                $tmpViewAbsen = 'available';
            }

            if ($valDataUser->aktifitas == 'view-operasi') {
                $tmpViewOperasi = 'available';
            }

            if ($valDataUser->aktifitas == 'view-absen-operasi') {
                $tmpViewAbsenOperasi = 'available';
            }

            if ($valDataUser->aktifitas == 'view-surat-perintah') {
                $tmpViewSuratPerintah = 'available';
            }

            if ($valDataUser->aktifitas == 'sistem-setting') {
                $tmpSistemSetting = 'available';
            }

            if ($valDataUser->aktifitas == 'sistem-backup') {
                $tmpSistemBackup = 'available';
            }
        }

        $aktifitasUser = array( 'inputUser'         => $tmpInputUser,
                                'inputPersonel'     => $tmpInputPersonel,
                                'inputAbsen'        => $tmpInputAbsen,
                                'inputOperasi'      => $tmpInputOperasi, 
                                'inputRequest'      => $tmpInputRequest, 
                                'inputAbsenOperasi' => $tmpInputAbsenOperasi, 
                                'inputSuratPerintah'=> $tmpInputSuratPerintah, 
                                'viewUser'          => $tmpViewUser, 
                                'viewPersonel'      => $tmpViewPersonel, 
                                'viewAbsen'         => $tmpViewAbsen, 
                                'viewOperasi'       => $tmpViewOperasi, 
                                'viewAbsenOperasi'  => $tmpViewAbsenOperasi, 
                                'viewSuratPerintah' => $tmpViewSuratPerintah, 
                                'sistemSetting'     => $tmpSistemSetting, 
                                'sistemBackup'      => $tmpSistemBackup );
        
        return $aktifitasUser;
    }

    public function getUpdateStatusOpPersonel()
    {
        $dataOperasi = Operasi::get();
    }

    public function getUpdatePassword()
    {
        return View::make('login.updatepassword');
    }

    public function postUpdatePassword()
    {
        $password = Input::get('txt-password-lama');
        $dataUser = User::where('username', Auth::user()->username)->first();

        if (Input::get('txt-password-baru') == Input::get('txt-password-baru-ulang')) {
            if(Hash::check($password, $dataUser->password)) {
                User::where('id_user', $dataUser->id_user)
                    ->update(array('password' => Hash::make(Input::get('txt-password-baru'))));

                Auth::login($dataUser);

                return Redirect::to('dashboard');
            }
        } else {
            return Redirect::to('password/update')
                   ->with('flash_error', 'Pengulangan password yang Anda masukkan tidak sama');
        }
    }

    public function getAksesUser() 
    {
        $tmpHakAkses       = array();
        $tmpAksesAbsen     = 'not-available';
        $tmpAksesAbsenOps  = 'not-available';
        $tmpAksesPersonel  = 'not-available';
        $tmpAksesOperasi   = 'not-available';

        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->first();

        if (($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'superadmin') ||
            ($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == Session::get('sessSatker')) ||
            ($dataUser->instansi == 'polsek' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'superadmin' && $dataUser->id_kecamatan == Session::get('sessWilayah'))) {
            $tmpAksesAbsen = 'available';
        }

        if (($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'superadmin') ||
            ($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'sumda')) {
            $tmpAksesPersonel = 'available';
        }

        if (($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'superadmin') ||
            ($dataUser->instansi == 'polres' && $dataUser->jabatan == 'admin' && $dataUser->satuan_kerja == 'ops')) {
            $tmpAksesAbsenOps = 'available';
            $tmpAksesOperasi  = 'available';
        }

        $tmpHakAkses = array( 'aksesAbsen'      => $tmpAksesAbsen,
                              'aksesPersonel'   => $tmpAksesPersonel,
                              'aksesAbsenOps'   => $tmpAksesAbsenOps,
                              'aksesOperasi'    => $tmpAksesOperasi );
        
        return $tmpHakAkses;
    }

}