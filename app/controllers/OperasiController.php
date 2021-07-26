<?php

class OperasiController extends BaseController {

    public function getJsonoperasi()
    {
        $dataOperasi = Operasi::get();

        foreach ($dataOperasi as $val) {
            $data = array(
                'id'        => $val->id_operasi, 
                'title'     => $val->nama_op, 
                'start'     => $val->tanggal_mulai,
                'end'       => $val->tanggal_selesai,
                'allDay'    => false,
                'url'       => URL::to('operasi/view/'. $val->id_operasi)
            );
        }

        return Response::json($data, 200);
    }

    public function getIndex()
    {
        $dataOperasi = $this->getDataOperasi();
        
    	return View::make('operasi.home')
                    ->with(array(
                            'operasi'   => $dataOperasi
                    ));
    }

    public function getCreateOperasi()
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
        
        $dataUserUnit           = $this->getDataUserUnit();
        $dataWilayah            = $this->getDataWilayah();
        $dataSatker             = $this->getDataSatker();
        $dataAbsen              = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
        $dataOperasi            = $this->getDataOperasi();

        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.create')
                               ->with(array(
                                            'wilayah'           => $dataWilayah,
                                            'satker'            => $dataSatker,
                                            'user'              => $dataUser,
                                            'userUnit'          => $dataUserUnit,
                                            'absen'             => $dataAbsen
                                 ));
        } elseif ($this->cekViewOperasi() == 'available') {
            return Redirect::to('operasi');
        } else {
            return Redirect::to('dashboard');
        }
  	}

    public function getFilterOperasi() 
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
        
        $dataUserUnit   = $this->getDataUserUnit();
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataAbsen      = $this->getDataAbsen( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAbsen );
        $dataOperasi    = $this->getDataOperasi();
        
        return Response::json(array(
            'wilayah'   => $dataWilayah->toArray(),
            'satker'    => $dataSatker->toArray(),
            'user'      => $dataUser->toArray(),
            'userUnit'  => $dataUserUnit->toArray(),
            'absen'     => $dataAbsen->toArray()),
        200);
    }

  	public function postCreateOperasi()
  	{
        if (Input::has('slc-req-penerima')) {
            $dataOperasi = array(
                'id_user'               => Auth::user()->id_user,
                'jenis_op'              => Input::get('rad-jenis-op'),
                'nama_op'               => ucwords(Input::get('txt-nama-op')),
                'tanggal_mulai'         => Input::get('txt-tanggal-mulai'),
                'tanggal_selesai'       => Input::get('txt-tanggal-selesai'),
                'jam_mulai'             => Input::get('txt-jam-mulai'),
                'jam_selesai'           => Input::get('txt-jam-selesai'),
                'anggaran_pasti'        => Input::get('txt-anggaran-pasti'),
                'index_anggaran_min'    => Input::get('txt-index-anggaran-min'),
                'index_anggaran_max'    => Input::get('txt-index-anggaran-max'),
                'jumlah_personel'       => Input::get('txt-jumlah-personel'),
                'keterangan_op'         => Input::get('txt-keterangan'),
                'status_op'             => Input::get('slc-status-operasi')
            );

            $operasi = Operasi::create($dataOperasi);
            
            $this->postCreateFotoOp( $operasi->id_operasi );
            $this->postCreateRequestOp( $operasi->id_operasi );
            $this->postCreateTelegram( $operasi->id_operasi );

            return Redirect::to('operasi')
                           ->with('flash_success', 'Data operasi telah ditambahkan');
        } else {
            return Redirect::to('operasi/create')
                           ->with('flash_error', 'Tidak ada request personel. Pastikan minimal ada 1 request');
        }
    }

    public function postCreateFotoOp( $idOperasi )
    {
        $destinationPath = public_path().'images/operasi/';
        $postCount       = count(Input::file('file-foto-op'));
        
        echo $postCount;

        for ($i = 0; $i < $postCount; $i++) {
            if (Input::hasFile('file-foto-op.'.$i)) {
                $rules          = array('file-foto-op.'.$i => 'mimes:jpeg,png');
                $hasilValidasi  = Validator::make( Input::all(), $rules );

                if ( $hasilValidasi->passes() )
                {
                    $fileFoto[$i] = Input::file('file-foto-op.'.$i);
                    $filename[$i] = $fileFoto[$i]->getClientOriginalName();

                    $fileFoto[$i]->move($destinationPath, $filename[$i]);

                    $dataFotoOp = array(
                        'id_operasi'    => $idOperasi,
                        'foto_op'       => $filename[$i]
                    );

                    FotoOperasi::create( $dataFotoOp );
                } else {
                    return Redirect::to('operasi/create')
                                   ->with('flash_error', 'Format gambar harus jpeg atau png');
                }
            }
        }
    }

    public function postCreateRequestOp( $idOperasi )
    {
        $postCount  = count($_POST['slc-req-penerima']);
        $tmpSatker  = array();

        for ($i = 0; $i < $postCount; $i++) {
            $tmpSatker[$i] = Input::get('slc-req-satker.'.$i);

            if ($tmpSatker[$i] == 'semua') {
                $dataRequest = array(
                    'id_pengirim'               => Auth::user()->id_user,
                    'id_penerima'               => Input::get('slc-req-penerima.'.$i),
                    'tanggal_request'           => date('Y-m-d'),
                    'id_operasi'                => $idOperasi,
                    'jumlah_personel_perunit'   => Input::get('txt-req-jumlah-personel-unit.'.$i),
                    'satuan_kerja'              => 'semua',
                    'status_request'            => 'proses'
                );
            } else {
                $dataRequest = array(
                    'id_pengirim'               => Auth::user()->id_user,
                    'id_penerima'               => Input::get('slc-req-penerima.'.$i),
                    'tanggal_request'           => date('Y-m-d'),
                    'id_operasi'                => $idOperasi,
                    'jumlah_personel_perunit'   => Input::get('txt-req-jumlah-personel-unit.'.$i),
                    'satuan_kerja'              => $tmpSatker[$i],
                    'status_request'            => 'proses'
                );  
            }            

            RequestOperasi::create($dataRequest);
        }
    }

    public function postCreateTelegram( $idOperasi )
    {
        $dari           = Input::get('txt-tgram-dari');
        $namaPengirim   = Input::get('txt-tgram-nama');
        $nrp            = Input::get('txt-tgram-nrp');
        $pangkat        = Input::get('txt-tgram-pangkat');
        $kepada         = Input::get('txt-tgram-kepada');
        $tembusan       = Input::get('txt-tgram-tembusan');
        $derajat        = Input::get('txt-tgram-derajat');
        $klasifikasi    = Input::get('txt-tgram-klasifikasi');
        $nomor          = Input::get('txt-tgram-nomor');
        $tanggal        = Input::get('txt-tgram-tanggal');
        $isiA           = Input::get('txt-tgram-isiA');
        $isiB           = Input::get('txt-tgram-isiB');
        $isiC           = Input::get('txt-tgram-isiC');
        $isiD           = Input::get('txt-tgram-isiD');
        $isiE           = Input::get('txt-tgram-isiE');

        $dataTelegram = array(
                    'id_operasi'        => $idOperasi,
                    'tgram_dari'        => $dari,
                    'tgram_nama'        => $namaPengirim,
                    'tgram_nrp'         => $nrp,
                    'tgram_pangkat'     => $pangkat,
                    'tgram_kepada'      => $kepada,
                    'tgram_tembusan'    => $tembusan,
                    'tgram_derajat'     => $derajat,
                    'tgram_klasifikasi' => $klasifikasi,
                    'tgram_nomor'       => $nomor,
                    'tgram_tanggal'     => $tanggal,
                    'tgram_isia'        => $isiA,
                    'tgram_isib'        => $isiB,
                    'tgram_isic'        => $isiC,
                    'tgram_isid'        => $isiD,
                    'tgram_isie'        => $isiE
                );

        Telegram::create($dataTelegram);
    }

    public function getDeleteOperasi( $idOperasi )
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
        
        $dataMatchOperasi       = $this->getDataMatchOperasi( $idOperasi );
        $dataOperasi            = $this->getDataOperasi();

        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.delete')
                               ->with(array(
                                            'matchOps'          => $dataMatchOperasi,
                                            'operasi'           => $dataOperasi
                                 ));
        } elseif ($this->cekViewOperasi() == 'available') {
            return Redirect::to('operasi');
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postDeleteOperasi( $idOperasi )
    {
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                
                Operasi::where('id_operasi', $idOperasi)->delete();
                RequestOperasi::where('id_operasi', $idOperasi)->delete();
                Telegram::where('id_operasi', $idOperasi)->delete();
                SuratPerintah::where('id_operasi', $idOperasi)->delete();
                FotoOperasi::where('id_operasi', $idOperasi)->delete();
                
                $detailOps = DetailOperasi::where('id_operasi', $idOperasi)->get();
                foreach ($detailOps as $valDetailOps) {
                    AbsenOperasi::where('id_detail_operasi', $valDetailOps->id_detail_operasi)->delete();
                    Personel::where('id_personel', $valDetailOps->id_personel)
                            ->update(array('is_operasi' => 0));
                }
                
                DetailOperasi::where('id_operasi', $idOperasi)->delete();

                return Redirect::to('operasi')
                               ->with('flash_success', 'Data operasi telah dihapus');
            } else {
                return Redirect::to('operasi')
                               ->with('flash_error', 'Password salah, Data Operasi gagal dihapus');
            }
        }
    }

    public function getStatusOperasi( $idOperasi )
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
        
        $dataMatchOperasi       = $this->getDataMatchOperasi( $idOperasi );
        $dataOperasi            = $this->getDataOperasi();

        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.status')
                               ->with(array(
                                            'matchOps'          => $dataMatchOperasi,
                                            'operasi'           => $dataOperasi
                                 ));
        } elseif ($this->cekViewOperasi() == 'available') {
            return Redirect::to('operasi');
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postStatusOperasi( $idOperasi )
    {
        $password        = Input::get('txt-password');
        $dataUser        = User::where('username', Auth::user()->username)->first();
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                echo Input::get('rad-status-op');

                if (Input::get('rad-status-op') == 'selesai') {
                    $detailOps = DetailOperasi::where('id_operasi', $idOperasi)->get();
                    foreach ($detailOps as $valDetailOps) {
                        echo $valDetailOps->id_personel;
                        Personel::where('id_personel', $valDetailOps->id_personel)
                                ->update(array('is_operasi' => 0));
                    }
                }                

                Operasi::where('id_operasi', $idOperasi)
                       ->update(array(
                                'status_op' => Input::get('rad-status-op')
                        ));
                
                return Redirect::to('operasi')
                               ->with('flash_success', 'Status operasi telah diubah');
            } else {
                return Redirect::to('operasi')
                               ->with('flash_error', 'Password salah, status operasi gagal diubah');
            }
        }
    }

    public function getDokumenOperasi( $idOperasi )
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
        
        $dataMatchOperasi   = $this->getDataMatchOperasi( $idOperasi );
        $dataOperasi        = $this->getDataOperasi();
        $dataSprin          = SuratPerintah::where('id_operasi', $idOperasi)->first();

        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.dokumen')
                               ->with(array(
                                            'matchOps'  => $dataMatchOperasi,
                                            'operasi'   => $dataOperasi,
                                            'sprin'     => $dataSprin
                                 ));
        } elseif ($this->cekViewOperasi() == 'available') {
            return Redirect::to('operasi');
        } else {
            return Redirect::to('dashboard');
        }   
    }

    public function getViewOperasi( $idOperasi )
    {
        $dataOperasi        = $this->getDataOperasi();
        $dataMatchOperasi   = Operasi::where('id_operasi', $idOperasi)->firstOrFail();
        $dataFotoOperasi    = FotoOperasi::where('id_operasi', $idOperasi)->get();
        $hitungHari         = $this->getHitungHari( $dataMatchOperasi );
        $dataDetailOperasi  = $this->getDataDetailOperasi( $idOperasi );
        
        $dataRequest        = RequestOperasi::where('id_operasi', $idOperasi)
                                            ->groupBy('satuan_kerja')
                                            ->get();
        

        $dataAbsenOperasi   = AbsenOperasi::join('t_detail_operasi', 't_detail_operasi.id_detail_operasi', '=', 't_absen_operasi.id_detail_operasi')
                                          ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
                                          ->join('t_operasi', 't_operasi.id_operasi', '=', 't_detail_operasi.id_operasi')
                                          ->where('t_operasi.id_operasi', $idOperasi)
                                          ->get();

        $dataGaji           = DB::select('SELECT 
                                                t_operasi.id_operasi,
                                                t_absen_operasi.id_detail_operasi,
                                                m_personel.nrp,
                                                m_personel.nama_lengkap, 
                                                SUM(t_absen_operasi.gaji) AS gaji 
                                          FROM t_absen_operasi 
                                          INNER JOIN t_detail_operasi ON t_detail_operasi.id_detail_operasi = t_absen_operasi.id_detail_operasi
                                          INNER JOIN m_personel ON m_personel.id_personel = t_detail_operasi.id_personel
                                          INNER JOIN t_operasi ON t_operasi.id_operasi = t_detail_operasi.id_operasi
                                          WHERE t_operasi.id_operasi = '. $idOperasi .'
                                          GROUP BY t_absen_operasi.id_detail_operasi');
        $totalGaji = 0; 

        foreach ($dataGaji as $value) {
            $totalGaji += $value->gaji;
        }

        $sisaDana = $dataMatchOperasi->anggaran_pasti - $totalGaji;

        return View::make('operasi.view')
                               ->with(array(
                                            'operasi'       => $dataOperasi,
                                            'fotoOperasi'   => $dataFotoOperasi,
                                            'matchOperasi'  => $dataMatchOperasi,
                                            'request'       => $dataRequest,
                                            'detailOperasi' => $dataDetailOperasi,
                                            'jumlahHari'    => $hitungHari,
                                            'absenOperasi'  => $dataAbsenOperasi,
                                            'gaji'          => $dataGaji,
                                            'sisaDana'      => $sisaDana
                                 ));
    }

    public function getViewTelegram( $idOperasi )
    {
        $dataTelegram    = Telegram::where('id_operasi', $idOperasi)->first();
        $tanggalTelegram = $this->getKonversiTanggal( $dataTelegram->tgram_tanggal );
        
        if ($this->cekViewOperasi() == 'available') {
            return View::make('operasi.telegram')->with(array('telegram' => $dataTelegram, 'tglTgram' => $tanggalTelegram));
        } else {
            return Redirect::to('dashboard');   
        }
    }

    public function getViewSprin( $idOperasi )
    {
        $dataSprin      = SuratPerintah::where('id_operasi', $idOperasi)->first();
        $dataDetailOps  = $this->getDataDetailOperasi( $idOperasi );
        $tanggalSprin   = $this->getKonversiTanggal( $dataSprin->sprin_tanggal );
        
        if ($this->cekViewOperasi() == 'available') {
            if (count($dataSprin) == 0) {
                return Redirect::to('operasi/sprin/create/'.$idOperasi);
            } else {
                return View::make('operasi.sprin')->with(array('sprin' => $dataSprin, 'tglSprin' => $tanggalSprin, 'detailOps' => $dataDetailOps));
            }    
        } else {
            return Redirect::to('dashboard');   
        }   
    }

    public function getCreateSprin( $idOperasi )
    {
        $dataOperasi        = $this->getDataOperasi();
        $dataMatchOperasi   = Operasi::where('id_operasi', $idOperasi)->firstOrFail();
        $dataDetailOperasi  = $this->getDataDetailOperasi( $idOperasi );
        $dataSprin          = SuratPerintah::where('id_operasi', $idOperasi)->first();
        $cekRequest         = RequestOperasi::where('id_operasi', $idOperasi)
                                            ->where('status_request', '<>', 'diterima')
                                            ->get();

        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.createsprin')
                                   ->with(array(
                                                'operasi'       => $dataOperasi,
                                                'matchOperasi'  => $dataMatchOperasi,
                                                'detailOperasi' => $dataDetailOperasi,
                                                'cekRequest'    => $cekRequest
                                     ));
        } elseif ($this->cekViewOperasi() == 'available') {
            return Redirect::to('operasi')->with('flash_error', 'Belum ada Surat Perintah untuk Operasi '. $dataMatchOperasi->nama_op);
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postCreateSprin( $idOperasi )
    {
        $nomor          = Input::get('txt-sprin-nomor');
        $pertimbangan   = Input::get('txt-sprin-pertimbangan');
        $dasar          = Input::get('txt-sprin-dasar');
        $kepada         = Input::get('txt-sprin-kepada');
        $untuk          = Input::get('txt-sprin-untuk');
        $tembusan       = Input::get('txt-sprin-tembusan');
        $dikeluarkanDi  = Input::get('txt-sprin-dikeluarkan-di');
        $tanggal        = Input::get('txt-sprin-tanggal');
        $pengirim       = Input::get('txt-sprin-pengirim');
        $jabatan        = Input::get('txt-sprin-jabatan');
        $pangkat        = Input::get('txt-sprin-pangkat');
        $nrp            = Input::get('txt-sprin-nrp');

        $dataSprin = array(
                    'id_operasi'            => $idOperasi,
                    'sprin_nomor'           => $nomor,
                    'sprin_pertimbangan'    => $pertimbangan,
                    'sprin_dasar'           => $dasar,
                    'sprin_kepada'          => $kepada,
                    'sprin_untuk'           => $untuk,
                    'sprin_tembusan'        => $tembusan,
                    'sprin_dikeluarkan_di'  => $dikeluarkanDi,
                    'sprin_tanggal'         => $tanggal,
                    'sprin_pengirim'        => $pengirim,
                    'sprin_jabatan'         => $jabatan,
                    'sprin_pangkat'         => $pangkat,
                    'sprin_nrp'             => $nrp,
                );

        SuratPerintah::create($dataSprin);

        $postCount  = count(Input::get('txt-id-detail-op'));
        $tempID     = array();
        
        for ($i = 0; $i < $postCount; $i++) {
            $tempID[$i] = Input::get('txt-id-detail-op.'.$i);

            DetailOperasi::where('id_detail_operasi', $tempID[$i])
                         ->update(array(
                                    'keterangan_detail_op' => Input::get('txt-keterangan-detail-op-'. $tempID[$i])
                           ));
        }

        return Redirect::to('operasi/dokumen/'.$idOperasi)->with('flash_success', 'Surat perintah telah diterbitkan');
    }

    public function getUpdateTelegram( $idOperasi )
    {
        $dataTelegram       = Telegram::where('id_operasi', $idOperasi)->first();
        $dataOperasi        = $this->getDataOperasi();
        $dataMatchOperasi   = Operasi::where('id_operasi', $idOperasi)->firstOrFail();
        
        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.updatetelegram')
                                   ->with(array(
                                                'operasi'       => $dataOperasi,
                                                'matchOperasi'  => $dataMatchOperasi,
                                                'telegram'      => $dataTelegram
                                     ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postUpdateTelegram( $idOperasi )
    {
        $password       = Input::get('txt-password');
        $dataUser       = User::where('username', Auth::user()->username)->first();
        $dari           = Input::get('txt-tgram-dari');
        $namaPengirim   = Input::get('txt-tgram-nama');
        $nrp            = Input::get('txt-tgram-nrp');
        $pangkat        = Input::get('txt-tgram-pangkat');
        $kepada         = Input::get('txt-tgram-kepada');
        $tembusan       = Input::get('txt-tgram-tembusan');
        $derajat        = Input::get('txt-tgram-derajat');
        $klasifikasi    = Input::get('txt-tgram-klasifikasi');
        $nomor          = Input::get('txt-tgram-nomor');
        $tanggal        = Input::get('txt-tgram-tanggal');
        $isiA           = Input::get('txt-tgram-isiA');
        $isiB           = Input::get('txt-tgram-isiB');
        $isiC           = Input::get('txt-tgram-isiC');
        $isiD           = Input::get('txt-tgram-isiD');
        $isiE           = Input::get('txt-tgram-isiE');
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                Telegram::where('id_operasi', $idOperasi)
                        ->update(array(
                            'id_operasi'        => $idOperasi,
                            'tgram_dari'        => $dari,
                            'tgram_nama'        => $namaPengirim,
                            'tgram_nrp'         => $nrp,
                            'tgram_pangkat'     => $pangkat,
                            'tgram_kepada'      => $kepada,
                            'tgram_tembusan'    => $tembusan,
                            'tgram_derajat'     => $derajat,
                            'tgram_klasifikasi' => $klasifikasi,
                            'tgram_nomor'       => $nomor,
                            'tgram_tanggal'     => $tanggal,
                            'tgram_isia'        => $isiA,
                            'tgram_isib'        => $isiB,
                            'tgram_isic'        => $isiC,
                            'tgram_isid'        => $isiD,
                            'tgram_isie'        => $isiE
                          ));

                return Redirect::to('operasi/dokumen/'.$idOperasi)->with('flash_success', 'Telegram telah diubah');
            } else {
                return Redirect::to('operasi')
                               ->with('flash_error', 'Password salah, telegram gagal diubah');
            }
        }
    }

    public function getUpdateSprin( $idOperasi )
    {
        $dataSprin          = SuratPerintah::where('id_operasi', $idOperasi)->first();
        $dataOperasi        = $this->getDataOperasi();
        $dataMatchOperasi   = Operasi::where('id_operasi', $idOperasi)->firstOrFail();
        $dataDetailOperasi  = $this->getDataDetailOperasi( $idOperasi );
        $cekRequest         = RequestOperasi::where('id_operasi', $idOperasi)
                                            ->where('status_request', '<>', 'diterima')
                                            ->get();
        
        if ($this->cekInputOperasi() == 'available') {
            return View::make('operasi.updatesprin')
                                   ->with(array(
                                                'operasi'       => $dataOperasi,
                                                'matchOperasi'  => $dataMatchOperasi,
                                                'sprin'         => $dataSprin,
                                                'detailOperasi' => $dataDetailOperasi,
                                                'cekRequest'    => $cekRequest
                                     ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function postUpdateSprin( $idOperasi )
    {
        $password       = Input::get('txt-password');
        $dataUser       = User::where('username', Auth::user()->username)->first();
        
        $postCount      = count(Input::get('txt-id-detail-op'));
        $tempID         = array();

        $nomor          = Input::get('txt-sprin-nomor');
        $pertimbangan   = Input::get('txt-sprin-pertimbangan');
        $dasar          = Input::get('txt-sprin-dasar');
        $kepada         = Input::get('txt-sprin-kepada');
        $untuk          = Input::get('txt-sprin-untuk');
        $tembusan       = Input::get('txt-sprin-tembusan');
        $dikeluarkanDi  = Input::get('txt-sprin-dikeluarkan-di');
        $tanggal        = Input::get('txt-sprin-tanggal');
        $pengirim       = Input::get('txt-sprin-pengirim');
        $jabatan        = Input::get('txt-sprin-jabatan');
        $pangkat        = Input::get('txt-sprin-pangkat');
        $nrp            = Input::get('txt-sprin-nrp');
        
        if (!is_null($dataUser)) {
            if(Hash::check($password, $dataUser->password)) {
                SuratPerintah::where('id_operasi', $idOperasi)
                             ->update(array(
                                    'id_operasi'            => $idOperasi,
                                    'sprin_nomor'           => $nomor,
                                    'sprin_pertimbangan'    => $pertimbangan,
                                    'sprin_dasar'           => $dasar,
                                    'sprin_kepada'          => $kepada,
                                    'sprin_untuk'           => $untuk,
                                    'sprin_tembusan'        => $tembusan,
                                    'sprin_dikeluarkan_di'  => $dikeluarkanDi,
                                    'sprin_tanggal'         => $tanggal,
                                    'sprin_pengirim'        => $pengirim,
                                    'sprin_jabatan'         => $jabatan,
                                    'sprin_pangkat'         => $pangkat,
                                    'sprin_nrp'             => $nrp,
                                ));
         
                for ($i = 0; $i < $postCount; $i++) {
                    $tempID[$i] = Input::get('txt-id-detail-op.'.$i);

                    DetailOperasi::where('id_detail_operasi', $tempID[$i])
                                 ->update(array(
                                            'keterangan_detail_op' => Input::get('txt-keterangan-detail-op-'. $tempID[$i])
                                   ));
                }

                return Redirect::to('operasi/dokumen/'.$idOperasi)->with('flash_success', 'Surat Perintah telah diubah');
            } else {
                return Redirect::to('operasi')
                               ->with('flash_error', 'Password salah, Surat Perintah gagal diubah');
            }
        }   
    }

    public function cekInputOperasi() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'input-operasi' || $valDataUser->aktifitas == 'input-personel-operasi') {
                return 'available';
            }
        }
    }

    public function cekViewOperasi() 
    {
        $dataUser   = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                          ->join('m_hak_akses', 'm_hak_akses.id_tipe_user', '=', 'm_tipe_user.id_tipe_user')
                          ->join('m_aktifitas_user', 'm_aktifitas_user.id_aktifitas_user', '=', 'm_hak_akses.id_aktifitas_user')
                          ->where('m_user.id_user', Auth::user()->id_user)
                          ->get();
        
        foreach ($dataUser as $valDataUser) {
            if ($valDataUser->aktifitas == 'view-operasi') {
                return 'available';
            }
        }
    }

    public function getDataDetailOperasi( $idOperasi )
    {
        $dataDetailOperasi  = Operasi::join('t_detail_operasi', 't_detail_operasi.id_operasi', '=', 't_operasi.id_operasi')
                                     ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
                                     ->where('t_operasi.id_operasi', $idOperasi)
                                     ->get();
        
        return $dataDetailOperasi;   
    }

    public function getDataWilayah()
    {
        $dataWilayah  = Area::where('level', 3)
                            ->where('id_provinsi', 35)
                            ->where('id_kota', 17)
                            ->get();
    
        return $dataWilayah;
    }

    public function getDataSatker() 
    {
        $dataSatker   = TipeUser::where('satuan_kerja', '<>', 'superadmin')
                                ->where('satuan_kerja', '<>', 'kapolres')
                                ->where('satuan_kerja', '<>', 'wakapolres')
                                ->where('satuan_kerja', '<>', 'kapolsek')
                                ->where('satuan_kerja', '<>', 'wakapolsek')
                                ->where('satuan_kerja', '<>', 'pns')
                                ->groupBy('satuan_kerja')
                                ->get();
     
        return $dataSatker;
    }

    public function getDataUserUnit()
    {
        $dataUserUnit = User::join('m_area', 'm_area.id_kecamatan', '=', 'm_user.id_kecamatan')
                            ->where('m_user.id_user', '<>', Auth::user()->id_user)
                            ->where('m_area.id_provinsi', 35)
                            ->where('m_area.id_kota', 17)
                            ->groupBy('m_area.nama')
                            ->orderBy('m_area.id_kecamatan')
                            ->get();

        return $dataUserUnit;
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

    public function getAuthUser()
    {
        $dataUser = User::join('m_tipe_user', 'm_tipe_user.id_tipe_user', '=', 'm_user.id_tipe_user')
                        ->where('m_user.id_user', Auth::user()->id_user)
                        ->firstOrFail();

        return $dataUser;
    }

    public function getDataOperasi()
    {
        $dataOperasi = Operasi::get();

        return $dataOperasi;
    }

    public function getDataMatchOperasi( $idOperasi )
    {
        $dataMatchOperasi = Operasi::where('id_operasi', $idOperasi)->firstOrFail();

        return $dataMatchOperasi;
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

    public function getKonversiTanggal( $tanggal )
    {
        $formatBulan = array(
                            '01' => 'Januari',
                            '02' => 'Februari',
                            '03' => 'Maret',
                            '04' => 'April',
                            '05' => 'Mei',
                            '06' => 'Juni',
                            '07' => 'Juli',
                            '08' => 'Agustus',
                            '09' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember'
                        );

        $tmpTanggal = explode('-', $tanggal);

        $tahun      = $tmpTanggal[0];
        $bulan      = strtr($tmpTanggal[1], $formatBulan);
        $hari       = $tmpTanggal[2];

        return implode(' ', array($hari, $bulan, $tahun));
    }

}