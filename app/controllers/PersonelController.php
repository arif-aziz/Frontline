<?php

class PersonelController extends BaseController {

	public function getIndex()
	{
        $dataUser   = $this->getAuthUser();
        $tmpProv    = 35;
        $tmpKota    = 17;

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

        $dataWilayah      = $this->getDataWilayah();
        $dataSatker       = $this->getDataSatker();
        $dataPersonel     = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker);
        
        return View::make('personel.home')
                   ->with(array(
                                'wilayah'       => $dataWilayah,
                                'personel'      => $dataPersonel,
                                'satker'        => $dataSatker,
                                'user'          => $dataUser
                     ));
	}

    public function getFilterPersonel() 
    {
        $dataUser   = $this->getAuthUser();
        $tmpProv    = 35;
        $tmpKota    = 17;
        $tmpKec     = Input::get('slc-wilayah');
        $tmpSatker  = Input::get('slc-satker');
        
        Session::forget('sessWilayah');
        Session::forget('sessSatker');
        Session::put('sessWilayah', $tmpKec);
        Session::put('sessSatker', $tmpSatker);
        
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker );
        
        return View::make('personel.home')
                   ->with(array(
                                'wilayah'   => $dataWilayah,
                                'personel'  => $dataPersonel,
                                'satker'    => $dataSatker,
                                'user'      => $dataUser
                     ));
    }

    public function getCreatePersonel()
    {
        $dataUser   = $this->getAuthUser();
        $tmpProv    = 35;
        $tmpKota    = 17;
        
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
        
        if ($this->cekInputPersonel() == 'available') {
            return View::make('personel.create')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } elseif ($this->cekViewPersonel() == 'available') {
            return View::make('personel.home')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

	public function postCreatePersonel()
	{
        $destinationPath = public_path().'images/personel/';
        $hasilValidasi   = $this->validasi( Input::all() );
        
        if( $hasilValidasi->passes() ) {
            if (Input::hasFile('file-foto-personel')) 
            {
                $fileFoto = Input::file('file-foto-personel');
                $filename = $fileFoto->getClientOriginalName();

                $fileFoto->move($destinationPath, $filename);
            } else {
                $filename = 'fotodefault.jpg';
            }

    		$dataPersonel = array(
            	'id_user'          	=> Auth::user()->id_user,
                'nrp'             	=> Input::get('txt-nrp'),
                'id_provinsi'       => 35,
                'id_kota'           => 17,
                'id_kecamatan'      => Input::get('slc-wilayah'),
                'foto_personel'     => $filename,
                'nama_lengkap'      => ucwords(Input::get('txt-nama-lengkap')),
                'tempat_lahir'      => ucwords(Input::get('txt-tempat-lahir')),
                'tanggal_lahir'     => Input::get('txt-tanggal-lahir'),
                'alamat'       		=> Input::get('txt-alamat'),
                'pangkat'           => ucwords(Input::get('txt-pangkat')),
                'jabatan'      		=> ucwords(Input::get('txt-jabatan')),
                'tanggal_jabatan'   => Input::get('txt-tanggal-jabatan'),
                'instansi'          => Input::get('rad-instansi'),
                'satuan_kerja'      => Input::get('slc-satuan-kerja'),
                'riwayat_pendidikan'=> Input::get('txt-riwayat-pendidikan'),
                'riwayat_kerja'     => Input::get('txt-riwayat-kerja'),
                'status_personel'   => Input::get('slc-status-personel'),
                'is_operasi'        => 0
            );

            Personel::create($dataPersonel);

    		return Redirect::to('personel')
    					   ->with('flash_success', 'Data personel telah ditambahkan');
        } else {
            return Redirect::to('personel')
                           ->with('flash_error', 'NRP sama, pastikan tidak ada duplikasi data personel');
        }
	}

	public function getViewPersonel( $tmpKec, $tmpSatker, $idPersonel ) 
	{
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker);
        $dataOperasi    = $this->getDataOperasi( $idPersonel );
        $dataAbsen      = $this->getDataAbsen( $idPersonel );
        
        $matchDataPersonel  = Personel::where('id_personel', $idPersonel)
                                      ->firstOrFail();

        if ($this->cekViewPersonel() == 'available') {
    		return View::make('personel.view')
            		   ->with(array(
            		   				'wilayah'   => $dataWilayah,
                                    'personel'  => $dataPersonel,
                                    'satker'    => $dataSatker,
                                    'user'      => $dataUser,
                                    'operasi'   => $dataOperasi,
                                    'absen'     => $dataAbsen,
                                    'matchPersonel' => $matchDataPersonel
            		   	 ));
        } else {
            return Redirect::to('dashboard');
        }
	}

	public function getUpdatePersonel( $tmpKec, $tmpSatker, $idPersonel ) 
	{
		$dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker);
        
        $matchDataPersonel  = Personel::where('id_personel', $idPersonel)
                                      ->firstOrFail();

        if ($this->cekInputPersonel() == 'available') {
            return View::make('personel.update')
                       ->with(array(
                                    'wilayah'   => $dataWilayah,
                                    'personel'  => $dataPersonel,
                                    'satker'    => $dataSatker,
                                    'user'      => $dataUser,
                                    'matchPersonel' => $matchDataPersonel
                         ));
        } elseif ($this->cekViewPersonel() == 'available') {
            return View::make('personel.home')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
	}

    public function postUpdatePersonel( $idPersonel )
    {
        $destinationPath = public_path().'images/personel/';
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);

                if (Input::hasFile('file-foto-personel')) 
                {
                    $fileFoto = Input::file('file-foto-personel');
                    $filename = $fileFoto->getClientOriginalName();;

                    $fileFoto->move($destinationPath, $filename);
                } else {
                    $filename = 'fotodefault.jpg';
                }

                Personel::where('id_personel', $idPersonel)
                        ->update(array(
                            'id_user'           => Auth::user()->id_user,
                            'nrp'               => Input::get('txt-nrp'),
                            'id_provinsi'       => 35,
                            'id_kota'           => 17,
                            'id_kecamatan'      => Input::get('slc-wilayah'),
                            'foto_personel'     => $filename,
                            'nama_lengkap'      => ucwords(Input::get('txt-nama-lengkap')),
                            'tempat_lahir'      => ucwords(Input::get('txt-tempat-lahir')),
                            'tanggal_lahir'     => Input::get('txt-tanggal-lahir'),
                            'alamat'            => Input::get('txt-alamat'),
                            'pangkat'           => ucwords(Input::get('txt-pangkat')),
                            'jabatan'           => ucwords(Input::get('txt-jabatan')),
                            'tanggal_jabatan'   => Input::get('txt-tanggal-jabatan'),
                            'instansi'          => Input::get('rad-instansi'),
                            'satuan_kerja'      => Input::get('slc-satuan-kerja'),
                            'riwayat_pendidikan'=> Input::get('txt-riwayat-pendidikan'),
                            'riwayat_kerja'     => Input::get('txt-riwayat-kerja'),
                            'status_personel'   => Input::get('slc-status-personel'),
                            'is_operasi'        => 0
                        ));

                return Redirect::to('personel')
                               ->with('flash_success', 'Data personel telah diubah');
            } else {
                return Redirect::to('personel')
                               ->with('flash_error', 'Password salah, Data Personel gagal diubah');
            }
        }
    }

    public function getDeletePersonel( $tmpKec, $tmpSatker, $idPersonel ) 
    {
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker);
        
        $matchDataPersonel  = Personel::where('id_personel', $idPersonel)
                                      ->firstOrFail();

        if ($this->cekInputPersonel() == 'available') {
            return View::make('personel.delete')
                       ->with(array(
                                    'wilayah'   => $dataWilayah,
                                    'personel'  => $dataPersonel,
                                    'satker'    => $dataSatker,
                                    'user'      => $dataUser,
                                    'matchPersonel' => $matchDataPersonel
                         ));
        } elseif ($this->cekViewPersonel() == 'available') {
            return View::make('personel.home')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postDeletePersonel( $idPersonel )
    {
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);

                Personel::where('id_personel', $idPersonel)
                        ->delete();

                return Redirect::to('personel')
                               ->with('flash_success', 'Data personel telah dihapus');
            } else {
                return Redirect::to('personel')
                               ->with('flash_error', 'Password salah, Data Personel gagal dihapus');
            }
        }
    }

    public function getDownloadPersonel()
    {
        $dataPersonel = Personel::join('m_area', 'm_area.id_kecamatan', '=', 'm_personel.id_kecamatan')
                                ->where('m_area.id_provinsi', 35)
                                ->where('m_area.id_kota', 17)
                                ->get();

        $columns = array('NRP', 
                         'Nama', 
                         'Tempat, Tanggal Lahir', 
                         'Alamat', 
                         'Instansi', 
                         'Wilayah', 
                         'Jabatan', 
                         'Tanggal Mulai Menjabat', 
                         'Satuan Kerja', 
                         'Riwayat Pendidikan', 
                         'Riyawat Kerja', 
                         'Status Personel');

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Daftar Personel');

        // Create heading excel
        $rowNumber = 1;
        $col = 'A';
        foreach($columns as $column => $heading) {
           $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
           $col++;
        }

        // Loop through the result set
        $rowNumber = 2;
        foreach($dataPersonel as $data){
            $col = 'A';
            foreach($columns as $column => $heading) {
              $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, $data->nrp);
              $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowNumber, $data->nama_lengkap);
              $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowNumber, $data->tempat_lahir . ', ' . $data->tanggal_lahir);
              $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowNumber, $data->alamat);
              $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowNumber, $data->instansi);
              $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowNumber, $data->nama);
              $objPHPExcel->getActiveSheet()->setCellValue('G'.$rowNumber, $data->jabatan);
              $objPHPExcel->getActiveSheet()->setCellValue('H'.$rowNumber, $data->tanggal_jabatan);
              $objPHPExcel->getActiveSheet()->setCellValue('I'.$rowNumber, $data->satuan_kerja);
              $objPHPExcel->getActiveSheet()->setCellValue('J'.$rowNumber, $data->riwayat_pendidikan);
              $objPHPExcel->getActiveSheet()->setCellValue('K'.$rowNumber, $data->riwayat_kerja);
              $objPHPExcel->getActiveSheet()->setCellValue('L'.$rowNumber, $data->status_personel);
            }
            $rowNumber++;
        }

        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\""."Daftar Personel Unit Polres Jombang.xlsx"."\""); 
        header("Cache-Control: max-age=0"); 

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit();
    }

    public function cekInputPersonel() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-personel') {
                return 'available';
            }
        }
    }

    public function cekViewPersonel() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'view-personel') {
                return 'available';
            }
        }
    }

    public function validasi( $input ) 
    {
        $rules = array(
            'txt-nrp' => 'unique:m_personel,nrp'
        );

        return Validator::make($input, $rules);
    }

    public function getAuthUser()
    {
        $dataUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                        ->where('m_user.id_user', Auth::user()->id_user)
                        ->firstOrFail();

        return $dataUser;
    }

    public function getDataWilayah()
    {
        $dataWilayah  = Area::where('level', 3)
                            ->where('id_provinsi', 35)
                            ->where('id_kota', 17)
                            ->get();
        
        return $dataWilayah;
    }

    public function getDataPersonel( $idProv, $idKota, $idKec, $satker)
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

    public function getDataOperasi( $idPersonel )
    {
        $dataOperasi = Operasi::join('t_detail_operasi', 't_detail_operasi.id_operasi', '=', 't_operasi.id_operasi')
                              ->where('t_detail_operasi.id_personel', $idPersonel)
                              ->get();

        return $dataOperasi;
    }

    public function getDataAbsen( $idPersonel )
    {
        $dataAbsen = Absen::where('id_personel', $idPersonel)
                          ->get();

        return $dataAbsen;
    }

}
