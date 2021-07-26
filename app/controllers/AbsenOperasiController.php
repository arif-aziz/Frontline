<?php

class AbsenOperasiController extends BaseController {

	public function getIndex()
	{
		if (Session::has('sessTglAbsenOp')) {
            $tmpTglAbsenOp = Session::get('sessTglAbsenOp');
        } else {
			$tmpTglAbsenOp  = date('Y-m-d');
            Session::put('sessTglAbsenOp', $tmpTglAbsenOp);
        }

        if (Session::has('sessOperasi')) {
            $tmpOp = Session::get('sessOperasi');
        } else {
        	$tmpOp = 0;
        	Session::put('sessOperasi', $tmpOp);
        }        
    	
    	$dataOperasi 		= $this->getDataOperasi();
		$dataPersonelOp		= $this->getDataPersonelOperasi( $tmpOp );
		$dataAbsenOperasi	= $this->getDataAbsenOperasi( $tmpOp, $tmpTglAbsenOp );

    	return View::make('absenoperasi.home')
                               ->with(array(
                                            'operasi'   	=> $dataOperasi,
                                            'personelOp'   	=> $dataPersonelOp,
                                            'absenOperasi'	=> $dataAbsenOperasi
                                 ));
	}

	public function getFilterAbsenOperasi() 
	{
        $tmpOp          = Input::get('slc-operasi');
        $tmpTglAbsenOp  = Input::get('txt-tanggal-absen');

        Session::forget('sessTglAbsenOp');
        Session::forget('sessOperasi');
        Session::put('sessTglAbsenOp', $tmpTglAbsenOp);
        Session::put('sessWilayah', $tmpOp);

        $dataOperasi 		= $this->getDataOperasi();
        $dataMatchOperasi	= $this->getDataMatchOperasi( $tmpOp );
		$dataPersonelOp		= $this->getDataPersonelOperasi( $tmpOp );
		$dataAbsenOperasi	= $this->getDataAbsenOperasi( $tmpOp, $tmpTglAbsenOp );
		$dataArea 			= $this->getDataArea();

        return View::make('absenoperasi.create')
                               ->with(array(
                                    		'operasi'   	=> $dataOperasi,
                                    		'matchOperasi'	=> $dataMatchOperasi,
                                            'personelOp'   	=> $dataPersonelOp,
                                            'absenOperasi'	=> $dataAbsenOperasi,
                                            'area'			=> $dataArea
                                 ));
	}

	public function postCreateAbsenOperasi()
	{
		if (Input::has('txt-id-detail-op')) {
            $postCount  = count($_POST['txt-id-detail-op']);

            for ($i = 0; $i < $postCount; $i++) {
            	$idOperasi 			= Input::get('txt-id-operasi');
            	$idDetailOp[$i] 	= Input::get('txt-id-detail-op.'.$i);
            	$statusAbsenOp[$i] 	= Input::get('slc-status-op.'.$i);

            	$gaji[$i] = $this->hitungGaji( $idOperasi, $statusAbsenOp[$i] );

                $dataAbsenOp = array(
                	'id_detail_operasi'		=>  $idDetailOp[$i],
                    'tanggal_absen_op'     	=>  Input::get('txt-tanggal-absen-op'),
                    'status_absen_op'       =>  $statusAbsenOp[$i],
                    'keterangan_absen_op'   =>  Input::get('txt-keterangan-op.'.$i),
                    'gaji'        			=>  $gaji[$i]
                );

                AbsenOperasi::create($dataAbsenOp);
            }
        }

        return Redirect::to('absenoperasi')
                       ->with('flash_success', 'Absen operasi telah dilakukan');
	}

	public function getUpdateAbsenOperasi( $tglAbsenOp, $idOperasi, $idPersonel )
	{
		$dataOperasi 			= $this->getDataOperasi();
		$dataAbsenOperasi		= $this->getDataAbsenOperasi( $idOperasi, $tglAbsenOp );
		$dataMatchAbsenOperasi	= $this->getDataMatchAbsenOperasi( $idPersonel, $idOperasi, $tglAbsenOp );
		$dataMatchOperasi		= $this->getDataMatchOperasi( $idOperasi );
		$dataArea 				= $this->getDataArea();

    	return View::make('absenoperasi.update')
                               ->with(array(
                                            'operasi'   	=> $dataOperasi,
                                            'matchOperasi'	=> $dataMatchOperasi,
                                            'matchAbsenOp'  => $dataMatchAbsenOperasi,
                                            'absenOperasi'	=> $dataAbsenOperasi,
                                            'area'			=> $dataArea
                                 ));
	}

	public function postUpdateAbsenOperasi()
	{
    	$idOperasi 		= Input::get('txt-id-operasi');
    	$idDetailOp 	= Input::get('txt-id-detail-op');
    	$idAbsenOp 		= Input::get('txt-id-absen-op');
    	$statusAbsenOp 	= Input::get('slc-status-op');

    	$password       = Input::get('txt-password');
        $dataUser       = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {

		    	$gaji = $this->hitungGaji( $idOperasi, $statusAbsenOp );

		        AbsenOperasi::where('id_absen_operasi', $idAbsenOp)
		        			->update(array(
		        					'status_absen_op'       =>  $statusAbsenOp,
						            'keterangan_absen_op'   =>  Input::get('txt-keterangan-op'),
						            'gaji'        			=>  $gaji
		        			  ));

		        return Redirect::to('absenoperasi')
		                       ->with('flash_success', 'Absen operasi telah diubah');
        	} else {
                return Redirect::to('absenoperasi')
                               ->with('flash_error', 'Password salah, Data absen operasi gagal diubah');
            }
        }
	}

	public function getViewAbsenOperasi( $tglAbsenOp, $idOperasi, $idPersonel )
	{
		$dataOperasi 				= $this->getDataOperasi();
		$dataAbsenOperasi			= $this->getDataAbsenOperasi( $idOperasi, $tglAbsenOp );
		$dataMatchAbsenOpByPersonel	= $this->getDataMatchAbsenOpByPersonel( $idOperasi, $tglAbsenOp, $idPersonel );
		$dataMatchOperasi			= $this->getDataMatchOperasi( $idOperasi );
		$dataMatchPersonel 			= $this->getDataMatchPersonel( $idPersonel );

    	return View::make('absenoperasi.view')
                               ->with(array(
                                            'operasi'   				=> $dataOperasi,
                                            'matchOperasi'				=> $dataMatchOperasi,
                                            'matchAbsenOpByPersonel'	=> $dataMatchAbsenOpByPersonel,
                                            'absenOperasi'				=> $dataAbsenOperasi,
                                            'matchPersonel'				=> $dataMatchPersonel
                                 ));
	}

	public function getDataMatchPersonel( $idPersonel )
    {
        $dataMatchPersonel = Personel::where('id_personel', $idPersonel)
                                ->firstOrFail();

        return $dataMatchPersonel;
    }

	public function hitungGaji( $idOperasi, $statusAbsenOp )
	{
		if ($statusAbsenOp == 'kerja') {
			$dataOperasi 	= Operasi::where('id_operasi', $idOperasi)->firstOrFail();
			$jumlahHari 	= $this->getHitungHari($dataOperasi);

			$hasilGaji = ($dataOperasi->anggaran_pasti / $jumlahHari) / $dataOperasi->jumlah_personel;

			if ($hasilGaji >= $dataOperasi->index_anggaran_min && $hasilGaji <= $dataOperasi->index_anggaran_max) {
				$gaji = $hasilGaji;
			} elseif ($hasilGaji < $dataOperasi->index_anggaran_min) {
				$gaji = $dataOperasi->index_anggaran_min;
			} elseif ($hasilGaji > $dataOperasi->index_anggaran_max) {
				$gaji = $dataOperasi->index_anggaran_max;
			}
		} else {
			$gaji = 0;
		}
		
		return $gaji;
	}

	public function getDataOperasi()
	{
		$dataOperasi = Operasi::where('status_op', 'proses')
							  ->get();
		
		return $dataOperasi;
	}

	public function getDataMatchOperasi( $idOperasi )
	{
		$dataMatchOperasi = Operasi::where('id_operasi',  $idOperasi )
							  	   ->firstOrFail();
		
		return $dataMatchOperasi;
	}

	public function getDataPersonelOperasi( $idOperasi )
	{
		$dataPersonelOp = DetailOperasi::join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
									   ->join('t_operasi', 't_operasi.id_operasi', '=', 't_detail_operasi.id_operasi')
									   ->where('t_operasi.status_op', 'proses')
									   ->where('t_operasi.id_operasi', $idOperasi)
									   ->get();

		return $dataPersonelOp;
	}

	public function getDataAbsenOperasi( $idOperasi, $tglAbsenOp )
	{
		$dataAbsenOperasi = AbsenOperasi::join('t_detail_operasi', 't_detail_operasi.id_detail_operasi', '=', 't_absen_operasi.id_detail_operasi')
										->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
										->join('t_operasi', 't_operasi.id_operasi', '=', 't_detail_operasi.id_operasi')
										->where('t_operasi.id_operasi', $idOperasi)
										->where('t_absen_operasi.tanggal_absen_op', $tglAbsenOp)
										->get();
		
		return $dataAbsenOperasi;
	}

	public function getDataMatchAbsenOperasi( $idPersonel, $idOperasi, $tglAbsenOp )
	{
		$dataMatchAbsenOperasi = AbsenOperasi::join('t_detail_operasi', 't_detail_operasi.id_detail_operasi', '=', 't_absen_operasi.id_detail_operasi')
											 ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
											 ->join('t_operasi', 't_operasi.id_operasi', '=', 't_detail_operasi.id_operasi')
											 ->where('t_operasi.id_operasi', $idOperasi)
											 ->where('t_absen_operasi.tanggal_absen_op', $tglAbsenOp)
											 ->where('m_personel.id_personel', $idPersonel)
										     ->firstOrFail();
		
		return $dataMatchAbsenOperasi;
	}

	public function getDataMatchAbsenOpByPersonel( $idOperasi, $tglAbsenOp, $idPersonel )
	{
		$dataMatchAbsenOpByPersonel = AbsenOperasi::join('t_detail_operasi', 't_detail_operasi.id_detail_operasi', '=', 't_absen_operasi.id_detail_operasi')
											 ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
											 ->join('t_operasi', 't_operasi.id_operasi', '=', 't_detail_operasi.id_operasi')
											 ->where('t_operasi.id_operasi', $idOperasi)
											 // ->where('t_absen_operasi.tanggal_absen_op', $tglAbsenOp)
											 ->where('m_personel.id_personel', $idPersonel)
										     ->get();
		
		return $dataMatchAbsenOpByPersonel;
	}

	public function getHitungHari( $dataMatchOperasi )
    {
        $tgl1 = $dataMatchOperasi->tanggal_mulai;
        $tgl2 = $dataMatchOperasi->tanggal_selesai;

        $tmp1 = date_parse($tgl1);
        $date1 = $tmp1['day'];
        $month1 = $tmp1['month'];
        $year1 =  $tmp1['year'];

        $tmp2 = date_parse($tgl2);
        $date2 = $tmp2['day'];
        $month2 = $tmp2['month'];
        $year2 =  $tmp2['year'];

        $jd1 = gregoriantojd($month1, $date1, $year1);
        $jd2 = gregoriantojd($month2, $date2, $year2);

        $selisih = $jd2 - $jd1;

        return $selisih;
    }

    public function getDataArea()
    {
        $dataWilayah  = Area::where('level', 3)
                            ->where('id_provinsi', 35)
                            ->where('id_kota', 17)
                            ->get();
        
        return $dataWilayah;
    }

}