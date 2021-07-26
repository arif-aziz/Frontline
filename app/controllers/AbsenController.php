<?php

class AbsenController extends BaseController {

  	public function getIndex()
  	{
          $dataUser       = $this->getAuthUser();
          $tmpProv        = 35;
          $tmpKota        = 17;
          
          if (Session::has('sessTglAbsen')) {
              $tmpTglAbsen = Session::get('sessTglAbsen');
          } else {
              $tmpTglAbsen = date('Y-m-d');
              Session::put('sessTglAbsen', $tmpTglAbsen);
          }

          if (Session::has('sessWilayah')) {
              $tmpKec = Session::get('sessWilayah');
          } else {
              $tmpKec = $dataUser->id_kecamatan;
              Session::put('sessWilayah', $tmpKec);
          }

          if (Session::has('sessSatker')) {
              $tmpSatker = Session::get('sessSatker');
          } else {
              $tmpSatker = $dataUser->satuan_kerja;
              Session::put('sessSatker', $tmpSatker);
          }
          
          $dataWilayah    = $this->getDataWilayah();
          $dataSatker     = $this->getDataSatker();
          $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker );
          $dataAbsen      = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
          
          if ($this->cekInputAbsen() == 'available') {
              return View::make('absen.create')
                                 ->with(array(
                                              'wilayah'   => $dataWilayah,
                                              'personel'  => $dataPersonel,
                                              'absen'     => $dataAbsen,
                                              'satker'    => $dataSatker,
                                              'user'      => $dataUser
                                   ));
  	      } elseif ($this->cekViewAbsen() == 'available') {
              return View::make('absen.home')
                                 ->with(array(
                                              'wilayah'   => $dataWilayah,
                                              'personel'  => $dataPersonel,
                                              'absen'     => $dataAbsen,
                                              'satker'    => $dataSatker,
                                              'user'      => $dataUser
                                   ));
          } else {
              return Redirect::to('dashboard');
          }
  	}

  	public function getFilterAbsen() 
  	{
          $dataUser       = $this->getAuthUser();
          $tmpProv        = 35;
          $tmpKota        = 17;
          $tmpKec         = Input::get('slc-wilayah');
          $tmpSatker      = Input::get('slc-satker');
          $tmpTglAbsen    = Input::get('txt-tanggal-absen');

          Session::forget('sessTglAbsen');
          Session::forget('sessWilayah');
          Session::forget('sessSatker');
          Session::put('sessTglAbsen', $tmpTglAbsen);
          Session::put('sessWilayah', $tmpKec);
          Session::put('sessSatker', $tmpSatker);
          
          $dataWilayah    = $this->getDataWilayah();
          $dataSatker     = $this->getDataSatker();
          $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker );
          $dataAbsen      = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
          
          if ($this->cekInputAbsen() == 'available') {
              return View::make('absen.create')
                                 ->with(array(
                                              'wilayah'   => $dataWilayah,
                                              'personel'  => $dataPersonel,
                                              'absen'     => $dataAbsen,
                                              'satker'    => $dataSatker,
                                              'user'      => $dataUser

                                   ));
          } elseif ($this->cekViewAbsen() == 'available') {
              return View::make('absen.home')
                                 ->with(array(
                                              'wilayah'   => $dataWilayah,
                                              'personel'  => $dataPersonel,
                                              'absen'     => $dataAbsen,
                                              'satker'    => $dataSatker,
                                              'user'      => $dataUser
                                   ));
          } else {
              return Redirect::to('dashboard');
          }
  	}

    public function postCreateAbsen()
    {
        $isOperasi = 0;

        if (Input::has('txt-id-personel')) {
            $postCount  = count($_POST['txt-id-personel']);
            $tglAbsen   = Input::get('txt-tanggal-absen');
            
            for ($i = 0; $i < $postCount; $i++) {
                $idPersonel[$i] = Input::get('txt-id-personel.'.$i);

                if ($this->cekPersonelOnOperasi( $tglAbsen, $idPersonel[$i] ) == 'available') {
                    $isOperasi = 1;
                } else {
                    $isOperasi = 0;
                }

                $this->updatePersonel( $isOperasi, $idPersonel[$i] );
                
                $dataAbsen = array(
                    'tanggal_absen'     =>  Input::get('txt-tanggal-absen'),
                    'id_personel'       =>  Input::get('txt-id-personel.'.$i),
                    'status_absen'      =>  Input::get('slc-status.'.$i),
                    'keterangan_absen'  =>  Input::get('txt-keterangan.'.$i)
                );

                Absen::create($dataAbsen);
            }
        }

        return Redirect::to('absen');
    }

    public function getUpdateAbsen( $tmpKec, $tmpSatker, $tmpTglAbsen, $idAbsen )
    {
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;

        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataMatchAbsen = $this->getDataMatchAbsen( $idAbsen );
        $dataAbsen      = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
        
        if ($this->cekInputAbsen() == 'available') {
            return View::make('absen.update')
                               ->with(array(
                                            'wilayah'       => $dataWilayah,
                                            'matchAbsen'    => $dataMatchAbsen,
                                            'absen'         => $dataAbsen,
                                            'satker'        => $dataSatker,
                                            'user'          => $dataUser
                                 ));
        } elseif ($this->cekViewAbsen() == 'available') {
            return View::make('absen.home')
                               ->with(array(
                                            'wilayah'       => $dataWilayah,
                                            'matchAbsen'    => $dataMatchAbsen,
                                            'absen'         => $dataAbsen,
                                            'satker'        => $dataSatker,
                                            'user'          => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postUpdateAbsen( $idAbsen )
    {
        $tglAbsen       = Input::get('txt-tanggal-absen');
        $idPersonel     = Input::get('txt-id-personel');
        $namaPersonel   = Input::get('txt-nama-personel');
        $password       = Input::get('txt-password');
        $dataUser       = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                
                if ($this->cekPersonelOnOperasi( $tglAbsen, $idPersonel ) == 'available') {
                    $isOperasi = 1;
                } else {
                    $isOperasi = 0;
                }

                $this->updatePersonel( $isOperasi, $idPersonel );

                Absen::where('id_absen', $idAbsen)
                     ->update(array(
                            'status_absen'        => Input::get('slc-status'),
                            'keterangan_absen'    => Input::get('txt-keterangan')
                     ));

                return Redirect::to('absen')
                               ->with('flash_success', 'Data absen '. $namaPersonel .' tanggal '. $tglAbsen .' telah diubah');
            } else {
                return Redirect::to('absen')
                               ->with('flash_error', 'Password salah, Data Absen gagal diubah');
            }
        }
    }

    public function getViewAbsen( $tmpKec, $tmpSatker, $tmpTglAbsen, $idPersonel )
    {
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
        
        $dataWilayah        = $this->getDataWilayah();
        $dataSatker         = $this->getDataSatker();
        $dataMatchPersonel  = $this->getDataMatchPersonel( $idPersonel );
        $dataRiwayatAbsen   = $this->getDataRiwayatAbsen( $idPersonel );
        $dataAbsen          = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
        
        if ($this->cekViewAbsen() == 'available') {
            return View::make('absen.view')
                               ->with(array(
                                            'wilayah'       => $dataWilayah,
                                            'matchPersonel' => $dataMatchPersonel,
                                            'riwayatAbsen'  => $dataRiwayatAbsen,
                                            'absen'         => $dataAbsen,
                                            'satker'        => $dataSatker,
                                            'user'          => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function cekInputAbsen() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();

        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-absen') {
                return 'available';
            }
        }
    }

    public function cekViewAbsen() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'view-absen') {
                return 'available';
            }
        }
    }

    public function getDataWilayah()
    {
        $dataWilayah  = Area::where('level', 3)
                            ->where('id_provinsi', 35)
                            ->where('id_kota', 17)
                            ->get();
        
        return $dataWilayah;
    }

    public function getDataPersonel( $idProv, $idKota, $idKec, $satker )
    {
        if ($idKec == 0) {
            $dataPersonel = Personel::where('id_provinsi', $idProv)
                                    ->where('id_kota', $idKota)
                                    ->where('id_kecamatan', $idKec)
                                    ->where('satuan_kerja', $satker)
                                    ->get();
        } else {
            $dataPersonel = Personel::where('id_provinsi', $idProv)
                                    ->where('id_kota', $idKota)
                                    ->where('id_kecamatan', $idKec)
                                    ->get();
        }
        
        return $dataPersonel;
    }

    public function getDataMatchPersonel( $idPersonel )
    {
        $dataMatchPersonel = Personel::where('id_personel', $idPersonel)
                                ->firstOrFail();

        return $dataMatchPersonel;
    }

    public function getDataAbsen( $idProv, $idKota, $idKec, $satker, $tglAbsen )
    {
        if ($idKec == 0) {
            $dataAbsen    = Absen::join('m_personel', 'm_personel.id_personel', '=', 't_absen.id_personel')
                                 ->select('m_personel.nrp',
                                          'm_personel.nama_lengkap',
                                          'm_personel.id_kecamatan',
                                          'm_personel.satuan_kerja',
                                          'm_personel.is_operasi',
                                          't_absen.id_absen',
                                          't_absen.id_personel',
                                          't_absen.tanggal_absen',
                                          't_absen.status_absen',
                                          't_absen.keterangan_absen')
                                 ->where('m_personel.id_provinsi', $idProv)
                                 ->where('m_personel.id_kota', $idKota)
                                 ->where('m_personel.id_kecamatan', $idKec)
                                 ->where('m_personel.satuan_kerja', $satker)
                                 ->where('t_absen.tanggal_absen', $tglAbsen)
                                 ->get();
        } else {
            $dataAbsen    = Absen::join('m_personel', 'm_personel.id_personel', '=', 't_absen.id_personel')
                                 ->select('m_personel.nrp',
                                          'm_personel.nama_lengkap',
                                          'm_personel.id_kecamatan',
                                          'm_personel.satuan_kerja',
                                          'm_personel.is_operasi',
                                          't_absen.id_absen',
                                          't_absen.id_personel',
                                          't_absen.tanggal_absen',
                                          't_absen.status_absen',
                                          't_absen.keterangan_absen')
                                 ->where('m_personel.id_provinsi', $idProv)
                                 ->where('m_personel.id_kota', $idKota)
                                 ->where('m_personel.id_kecamatan', $idKec)
                                 ->where('t_absen.tanggal_absen', $tglAbsen)
                                 ->get();
        }
        
        return $dataAbsen;
    }

    public function getDataMatchAbsen( $idAbsen )
    {
        $dataMatchAbsen = Absen::join('m_personel', 'm_personel.id_personel', '=', 't_absen.id_personel')
                               ->where('t_absen.id_absen', $idAbsen)
                               ->firstOrFail();

        return $dataMatchAbsen;
    }

    public function getDataRiwayatAbsen( $idPersonel )
    {
        $dataRiwayatAbsen = Absen::join('m_personel', 'm_personel.id_personel', '=', 't_absen.id_personel')
                                 ->where('t_absen.id_personel', $idPersonel)
                                 ->orderBy('t_absen.id_absen', 'desc')
                                 ->get();

        return $dataRiwayatAbsen;
    }

    public function getDataSatker() 
    {
        $dataSatker   = TipeUser::where('satuan_kerja', '<>', 'superadmin')
                                ->where('satuan_kerja', '<>', 'kapolres')
                                ->where('satuan_kerja', '<>', 'wakapolres')
                                ->where('satuan_kerja', '<>', 'kapolsek')
                                ->where('satuan_kerja', '<>', 'wakapolsek')
                                ->groupBy('satuan_kerja')
                                ->get();
        
        return $dataSatker;
    }

    public function getAuthUser()
    {
        $dataUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                        ->where('m_user.id_user', Auth::user()->id_user)
                        ->firstOrFail();

        return $dataUser;
    }

    public function cekPersonelOnOperasi( $tglAbsen, $idPersonel )
    {
        $dataOperasi = Operasi::join('t_detail_operasi', 't_detail_operasi.id_operasi', '=', 't_operasi.id_operasi')
                              ->where('t_detail_operasi.id_personel', $idPersonel)
                              ->where('t_operasi.tanggal_mulai', '<=', $tglAbsen)
                              ->where('t_operasi.tanggal_selesai', '>=', $tglAbsen)
                              ->first();

        if (count($dataOperasi) != 0) {
            $hasilCek = 'available';
        } else {
            $hasilCek = 'not-available';
        }

        return $hasilCek;
    }

    public function updatePersonel( $isOperasi, $idPersonel )
    {
        Personel::where('id_personel', $idPersonel)
                ->update(array('is_operasi' => $isOperasi));
    }

}