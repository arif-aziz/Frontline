<?php

class RequestController extends BaseController {

	public function getIndex()
	{
		$dataRequest 		= $this->getDataRequest();
		
		if ($this->cekInputRequest() == 'available') {
			return View::make('request.home')
								->with(array(
		                                'request' 		=> $dataRequest
	                            ));
		} else {
			return Redirect::to('dashboard');	
		}
	}

	public function getViewRequest( $idRequest )
	{
		$dataRequest 		= $this->getDataRequest();
		$dataDetailRequest 	= $this->getDataDetailRequest( $idRequest );
		$dataPersonel 		= $this->getDataPersonel();
		$dataArea 			= $this->getDataArea();
		
		if ($this->cekInputRequest() == 'available') {
			return View::make('request.view')
								->with(array(
										'area'			=> $dataArea,
										'request' 		=> $dataRequest,
		                                'detailRequest' => $dataDetailRequest,
		                                'personel' 		=> $dataPersonel
	                            ));	
	    } else {
			return Redirect::to('dashboard');	
		}              
	}

	public function getUpdateRequest( $idRequest )
	{
		$dataRequest 		= $this->getDataRequest();
		$dataDetailRequest 	= $this->getDataDetailRequest( $idRequest );
		$dataPersonel 		= $this->getDataPersonelForUpdate();
		$dataPersonelOnOps 	= $this->getDataPersonelOnOperasi( $idRequest );
		$dataArea 			= $this->getDataArea();
		
		if ($this->cekInputRequest() == 'available') {
			return View::make('request.update')
								->with(array(
										'area'			=> $dataArea,
										'request' 		=> $dataRequest,
		                                'detailRequest' => $dataDetailRequest,
		                                'personel' 		=> $dataPersonel,
		                                'personelOnOps'	=> $dataPersonelOnOps
	                            ));	
	    } else {
			return Redirect::to('dashboard');	
		}              
	}
	
	public function getDataArea()
    {
        $dataWilayah = Area::where("level", 3)
                           ->where("id_provinsi", 35)
                           ->where("id_kota", 17)
                           ->get();
        
        return $dataWilayah;       
    }

	public function getDataRequest()
	{
		$dataRequest = RequestOperasi::join('m_user', 'm_user.id_user', '=', 't_request.id_penerima')
									 ->join('m_area', 'm_area.id_kecamatan', '=', 'm_user.id_kecamatan')
									 ->join('t_operasi', 't_operasi.id_operasi', '=', 't_request.id_operasi')
		                             ->where('m_area.id_provinsi', 35)
		                             ->where('m_area.id_kota', 17)
								   	 ->get();

		return $dataRequest;
	}

	public function getDataDetailRequest( $idRequest )
	{
		$dataDetailRequest 	= RequestOperasi::join('m_user', 'm_user.id_user', '=', 't_request.id_penerima')
											->join('t_operasi', 't_operasi.id_operasi', '=', 't_request.id_operasi')
				                            ->where('t_request.id_request', $idRequest)
										   	->firstOrFail();

		return $dataDetailRequest;
	}

	public function getDataPersonel()
	{
		$dataPersonel = Personel::join('t_absen', 't_absen.id_personel', '=', 'm_personel.id_personel')
								->where('t_absen.status_absen', 'hadir')
		  					    ->where('m_personel.is_operasi', 0)
							    ->where('t_absen.tanggal_absen', date('Y-m-d'))
							    ->orWhere(function($query)
					              {
					                $query->where('m_personel.jabatan', 'Kapolres')
					                      ->orWhere('m_personel.jabatan', 'Wakapolres');
					              })
							    ->get();

		return $dataPersonel;
	}

	public function getDataPersonelForUpdate()
	{
		$dataPersonel = Personel::join('t_absen', 't_absen.id_personel', '=', 'm_personel.id_personel')
								->where('t_absen.status_absen', 'hadir')
		  					    ->where('t_absen.tanggal_absen', date('Y-m-d'))
							    ->get();

		return $dataPersonel;
	}

	public function getDataPersonelOnOperasi( $idRequest )
	{
		$dataPersonelOnOps = RequestOperasi::join('t_detail_operasi', 't_detail_operasi.id_request', '=', 't_request.id_request')
										   ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
										   ->where('t_request.id_request', $idRequest)
										   ->get();

		return $dataPersonelOnOps;
	}

	public function cekInputRequest() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-request') {
                return 'available';
            }
        }
    }

}
