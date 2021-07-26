<?php

class DetailOperasiController extends BaseController {

	public function postCreateDetailOperasi()
	{
		$idOperasi 		= Input::get('txt-id-operasi');
    	$idRequest 		= Input::get('txt-id-request');
    	$satker			= Input::get('txt-satuan-kerja');
		$personelInti 	= Input::get('slc-personel-inti-operasi');
		$personelCad 	= Input::get('slc-personel-cadangan-operasi');
    	$jmlInti 		= count($personelInti);
    	$jmlCad 		= count($personelCad);

		if (Input::has('slc-personel-inti-operasi')) {
			for ($i=0; $i < $jmlInti; $i++) {
				$idPersonelInti[$i] = Input::get('slc-personel-inti-operasi.'.$i);

				$dataDetailOperasiInti = array(
					'id_rekomender'		=> Auth::user()->id_user,
					'id_request'		=> $idRequest,
					'id_operasi'		=> $idOperasi,
		        	'id_personel'		=> $idPersonelInti[$i],
		        	'posisi'			=> 'inti'
		        );
	            
	            $tempCek = $this->cekPersonelOnOperasi( date('Y-m-d'), $idPersonelInti[$i] );
	            
	            if ($tempCek == 'not-available') {
	            	$this->updatePersonel($idPersonelInti[$i]);
	            }
	        	
	        	DetailOperasi::create($dataDetailOperasiInti);
			}
		}

		if (Input::has('slc-personel-cadangan-operasi')) {
        	for ($i=0; $i < $jmlCad; $i++) {
				$idPersonelCad[$i] = Input::get('slc-personel-cadangan-operasi.'.$i);

				$dataDetailOperasiCadangan = array(
					'id_rekomender'		=> Auth::user()->id_user,
					'id_request'		=> $idRequest,
					'id_operasi'		=> $idOperasi,
		        	'id_personel'		=> $idPersonelCad[$i],
		        	'posisi'			=> 'cadangan'
		        );
	            
	            $tempCek = $this->cekPersonelOnOperasi( date('Y-m-d'), $idPersonelCad[$i] );
	            
	            if ($tempCek == 'not-available') {
	            	$this->updatePersonel($idPersonelCad[$i]);
	            }
	        	
	        	DetailOperasi::create($dataDetailOperasiCadangan);
			}

		}

	    $this->updateRequest( $idRequest, $satker );

        return Redirect::to('request')
                       ->with('flash_success', 'Data personel operasi telah ditambahkan');
	}

	public function postUpdateDetailOperasi()
	{
		$idOperasi 		= Input::get('txt-id-operasi');
    	$idRequest 		= Input::get('txt-id-request');
    	$satker			= Input::get('txt-satuan-kerja');
		$personelInti 	= Input::get('slc-personel-inti-operasi');
		$personelCad 	= Input::get('slc-personel-cadangan-operasi');
    	$jmlInti 		= count($personelInti);
    	$jmlCad 		= count($personelCad);

    	$password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();

        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Auth::login($dataUser);

				if (Input::has('slc-personel-inti-operasi')) {
					for ($i=0; $i < $jmlInti; $i++) {
						$idPersonelInti[$i] = Input::get('slc-personel-inti-operasi.'.$i);

						$dataDetailOperasiInti = array(
							'id_rekomender'		=> Auth::user()->id_user,
							'id_request'		=> $idRequest,
							'id_operasi'		=> $idOperasi,
				        	'id_personel'		=> $idPersonelInti[$i],
				        	'posisi'			=> 'inti'
				        );
			            
			            $tempCek = $this->cekPersonelOnOperasi( date('Y-m-d'), $idPersonelInti[$i] );
			            
			            if ($tempCek == 'not-available') {
			            	$this->updatePersonel($idPersonelInti[$i]);
			            }
			        	
			        	DetailOperasi::where('id_request', $idRequest)
			        				 ->where('id_personel', $idPersonelInti[$i])
			        				 ->delete();

			        	DetailOperasi::create($dataDetailOperasiInti);
					}
				}

				if (Input::has('slc-personel-cadangan-operasi')) {
		        	for ($i=0; $i < $jmlCad; $i++) {
						$idPersonelCad[$i] = Input::get('slc-personel-cadangan-operasi.'.$i);

						$dataDetailOperasiCadangan = array(
							'id_rekomender'		=> Auth::user()->id_user,
							'id_request'		=> $idRequest,
							'id_operasi'		=> $idOperasi,
				        	'id_personel'		=> $idPersonelCad[$i],
				        	'posisi'			=> 'cadangan'
				        );
			            
			            $tempCek = $this->cekPersonelOnOperasi( date('Y-m-d'), $idPersonelCad[$i] );
			            
			            if ($tempCek == 'not-available') {
			            	$this->updatePersonel($idPersonelCad[$i]);
			            }
			        	
			        	DetailOperasi::where('id_request', $idRequest)
			        				 ->where('id_personel', $idPersonelCad[$i])
			        				 ->delete();

			        	DetailOperasi::create($dataDetailOperasiCadangan);
					}
				}

			    $this->updateRequest( $idRequest, $satker );

		        return Redirect::to('request')
		                       ->with('flash_success', 'Data personel operasi telah ditambahkan');
            } else {
                return Redirect::to('request')
                               ->with('flash_error', 'Password salah, Data personel operasi gagal diubah');
            }
        }
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

    public function updatePersonel( $idPersonel )
    {
    	Personel::where('id_personel', $idPersonel)
    			->update(array('is_operasi' => 1));
    }

    public function updateRequest( $idRequest, $satker )
    {
    	RequestOperasi::where('id_request', $idRequest)
	    			  ->where('satuan_kerja', $satker)
			          ->update(array('status_request' => 'diterima'));
    }

}