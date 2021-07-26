<?php

// use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class RekapAbsenController extends BaseController {

  	public function getRekapAbsen()
    {
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
          
        if (Session::has('sessTglAbsen')) {
            $tmpTglAwal   = Session::get('sessTglAwal');
            $tmpTglAkhir  = Session::get('sessTglAkhir');
        } else {
            $tmpTglAwal   = date('Y-m-d');
            $tmpTglAkhir  = date('Y-m-d');
            Session::put('sessTglAwal', $tmpTglAwal);
            Session::put('sessTglAkhir', $tmpTglAkhir);
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
        $dataRekap      = $this->getDataRekap( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAwal, $tmpTglAkhir );
        
        if ($this->cekViewAbsen() == 'available') {
            return View::make('absen.rekap')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'rekap'     => $dataRekap,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function getRekapFilter()
    {
        $dataUser       = $this->getAuthUser();
        $tmpProv        = 35;
        $tmpKota        = 17;
        $tmpKec         = Input::get('slc-wilayah');
        $tmpSatker      = Input::get('slc-satker');
        $tmpTglAwal     = Input::get('txt-tanggal-awal-rekap');
        $tmpTglAkhir    = Input::get('txt-tanggal-akhir-rekap');
        $tmpFilterRekap = Input::get('rad-filter-rekap');

        Session::forget('sessTglAwal');
        Session::forget('sessTglAkhir');
        Session::forget('sessWilayah');
        Session::forget('sessSatker');
        Session::put('sessTglAwal', $tmpTglAwal);
        Session::put('sessTglAkhir', $tmpTglAkhir);
        Session::put('sessWilayah', $tmpKec);
        Session::put('sessSatker', $tmpSatker);
        
        $dataWilayah    = $this->getDataWilayah();
        $dataSatker     = $this->getDataSatker();
        $dataPersonel   = $this->getDataPersonel( $tmpProv, $tmpKota, $tmpKec, $tmpSatker );
        $dataRekap      = $this->getDataRekap( $tmpProv, $tmpKota, $tmpKec, $tmpSatker, $tmpTglAwal, $tmpTglAkhir );
        
        if ($tmpFilterRekap == 0) {
            $this;
        } elseif ($tmpFilterRekap == 1) {
            $this->getRekapDownloadByFilter( $tmpKec, $tmpSatker, $tmpTglAwal, $tmpTglAkhir, $dataWilayah, $dataRekap );
        } elseif ($tmpFilterRekap == 2) {
            $this->getRekapDownloadAll( $dataWilayah, $tmpTglAwal, $tmpTglAkhir );
        }

        if ($this->cekViewAbsen() == 'available') {
            return Redirect::to('absen/rekap')
                               ->with(array(
                                            'wilayah'   => $dataWilayah,
                                            'personel'  => $dataPersonel,
                                            'rekap'     => $dataRekap,
                                            'satker'    => $dataSatker,
                                            'user'      => $dataUser
                                 ));
        } else {
            return Redirect::to('dashboard');
        }
    }

    public function getRekapDownloadByFilter( $idUnit, $satker, $tglAwal, $tglAkhir, $dataWilayah, $dataRekap )
    {        
        $columns = array('NRP', 
                         'Nama', 
                         'Hadir', 
                         'Sakit', 
                         'Cuti', 
                         'Sekolah', 
                         'Izin', 
                         'Alpha');

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Rekap Absen');

        // Create heading excel
        if ($idUnit == 0) {
            $tmpUnit = 'POLRES JOMBANG';
        } else {
            foreach ($dataWilayah as $valWilayah) {
                if ($valWilayah->id_kecamatan == $idUnit) {
                    $tmpUnit = 'Polres '.$valWilayah->nama; break;
                }
            }
        }

        $tmpSatker = $satker;
        if ($satker == 'tanpa-satuan') {
            $tmpSatker = '-';
        }
        
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'TANGGAL');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', $tglAwal .' s/d '. $tglAkhir);
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'UNIT');
        $objPHPExcel->getActiveSheet()->setCellValue('B2', $tmpUnit);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'SATUAN KERJA');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', $tmpSatker);
        $objPHPExcel->getActiveSheet()->mergeCells('B1:H1');
        $objPHPExcel->getActiveSheet()->mergeCells('B2:H2');
        $objPHPExcel->getActiveSheet()->mergeCells('B3:H3');

        $rowNumber = 5;
        $col = 'A';
        foreach($columns as $column => $heading) {
           $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber, $heading);
           $col++;
        }

        // Loop through the result set
        $rowNumber = 6;
        foreach($dataRekap as $data){
            $col = 'A';
            foreach($columns as $column => $heading) {
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, $data->nrp, PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowNumber, $data->nama_lengkap);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowNumber, $data->jmlHadir);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowNumber, $data->jmlSakit);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$rowNumber, $data->jmlCuti);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$rowNumber, $data->jmlSekolah);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$rowNumber, $data->jmlIzin);
                $objPHPExcel->getActiveSheet()->setCellValue('H'.$rowNumber, $data->jmlAlpha);
            }
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('15');
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('20');
            $objPHPExcel->getActiveSheet()->getStyle('A5:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowNumber.':H'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $rowNumber++;
        }

        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\""."Rekap Absen Personel.xlsx"."\""); 
        header("Cache-Control: max-age=0"); 

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit();
    }

    public function getRekapDownloadAll( $dataWilayah, $tglAwal, $tglAkhir )
    {
        $dataRekapAll   = $this->getDataRekapAll( $tglAwal, $tglAkhir );
        $dataWilayahAll = $this->getDataWilayahAll();

        $columns = array('NRP', 
                         'Nama',
                         'Satker', 
                         'Hadir', 
                         'Sakit', 
                         'Cuti', 
                         'Sekolah', 
                         'Izin', 
                         'Alpha');

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        
        foreach($dataWilayahAll as $valWilayah){
            $objWorksheet = new PHPExcel_Worksheet($objPHPExcel);
            
            if ($valWilayah->id_kecamatan == 0) {
                $namaSheet = 'POLRES '. $valWilayah->nama;
            } else {
                $namaSheet = 'Polsek '. $valWilayah->nama;
            }
            
            $objPHPExcel->addSheet($objWorksheet);
            $objWorksheet->setTitle($namaSheet);
            $objWorksheet->setCellValue('A1', 'TANGGAL');
            $objWorksheet->setCellValue('B1', $tglAwal .' s/d '. $tglAkhir);
            $objWorksheet->setCellValue('A2', 'UNIT');
            $objWorksheet->setCellValue('B2', $namaSheet);
            $objWorksheet->mergeCells('B1:I1');
            $objWorksheet->mergeCells('B2:I2');

            $rowNumber = 4;
            $col = 'A';
            foreach($columns as $column => $heading) {
               $objWorksheet->setCellValue($col.$rowNumber, $heading);
               $col++;
            }

            $rowNumber = 5;
            foreach($dataRekapAll as $data){
                $col = 'A';
                if ($data->id_kecamatan == $valWilayah->id_kecamatan) {
                    foreach($columns as $column => $heading) {
                        $objWorksheet->setCellValue('A'.$rowNumber, $data->nrp, PHPExcel_Cell_DataType::TYPE_STRING);
                        $objWorksheet->setCellValue('B'.$rowNumber, $data->nama_lengkap);
                        $objWorksheet->setCellValue('C'.$rowNumber, $data->satuan_kerja);
                        $objWorksheet->setCellValue('D'.$rowNumber, $data->jmlHadir);
                        $objWorksheet->setCellValue('E'.$rowNumber, $data->jmlSakit);
                        $objWorksheet->setCellValue('F'.$rowNumber, $data->jmlCuti);
                        $objWorksheet->setCellValue('G'.$rowNumber, $data->jmlSekolah);
                        $objWorksheet->setCellValue('H'.$rowNumber, $data->jmlIzin);
                        $objWorksheet->setCellValue('I'.$rowNumber, $data->jmlAlpha);
                    }
                    $objWorksheet->getColumnDimension('A')->setWidth('15');
                    $objWorksheet->getColumnDimension('B')->setWidth('20');
                    $objWorksheet->getColumnDimension('C')->setWidth('15');
                    $objWorksheet->getStyle('A4:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objWorksheet->getStyle('A'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $objWorksheet->getStyle('D'.$rowNumber.':I'.$rowNumber)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    
                    $rowNumber++;
                }                
            }
        }

        $objPHPExcel->removeSheetByIndex(0);
        
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\""."Rekap Absen Seluruh Personel.xlsx"."\""); 
        header("Cache-Control: max-age=0"); 

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit();
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

    public function getDataWilayahAll()
    {
        $dataWilayah  = Area::where('id_provinsi', 35)
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

    public function getDataRekap( $idProv, $idKota, $idKec, $satker, $tglAwal, $tglAkhir )
    {
        if ($idKec == 0) {
            $dataRekap           = DB::select('SELECT 
                                                    m_personel.nrp,
                                                    m_personel.nama_lengkap,
                                                    m_personel.id_kecamatan,
                                                    m_personel.satuan_kerja,
                                                    t_absen.tanggal_absen,
                                                    COUNT(CASE WHEN t_absen.status_absen = "hadir" THEN 1 END) as jmlHadir,
                                                    COUNT(CASE WHEN t_absen.status_absen = "sakit" THEN 1 END) as jmlSakit,
                                                    COUNT(CASE WHEN t_absen.status_absen = "cuti" THEN 1 END) as jmlCuti,
                                                    COUNT(CASE WHEN t_absen.status_absen = "sekolah" THEN 1 END) as jmlSekolah,
                                                    COUNT(CASE WHEN t_absen.status_absen = "izin" THEN 1 END) as jmlIzin,
                                                    COUNT(CASE WHEN t_absen.status_absen = "alpha" THEN 1 END) as jmlAlpha
                                              FROM t_absen
                                              INNER JOIN m_personel ON m_personel.id_personel = t_absen.id_personel
                                              WHERE m_personel.id_provinsi = '. $idProv .' AND
                                                    m_personel.id_kota = '. $idKota .' AND
                                                    m_personel.id_kecamatan = '. $idKec .' AND
                                                    m_personel.satuan_kerja = "'. $satker .'" AND
                                                    t_absen.tanggal_absen BETWEEN "'. $tglAwal .'" AND "'. $tglAkhir .'"
                                              GROUP BY m_personel.nrp');
        } else {
            $dataRekap           = DB::select('SELECT 
                                                    m_personel.nrp,
                                                    m_personel.nama_lengkap,
                                                    m_personel.id_kecamatan,
                                                    m_personel.satuan_kerja,
                                                    t_absen.tanggal_absen,
                                                    COUNT(CASE WHEN t_absen.status_absen = "hadir" THEN 1 END) as jmlHadir,
                                                    COUNT(CASE WHEN t_absen.status_absen = "sakit" THEN 1 END) as jmlSakit,
                                                    COUNT(CASE WHEN t_absen.status_absen = "cuti" THEN 1 END) as jmlCuti,
                                                    COUNT(CASE WHEN t_absen.status_absen = "sekolah" THEN 1 END) as jmlSekolah,
                                                    COUNT(CASE WHEN t_absen.status_absen = "izin" THEN 1 END) as jmlIzin,
                                                    COUNT(CASE WHEN t_absen.status_absen = "alpha" THEN 1 END) as jmlAlpha
                                              FROM t_absen
                                              INNER JOIN m_personel ON m_personel.id_personel = t_absen.id_personel
                                              WHERE m_personel.id_provinsi = '. $idProv .' AND
                                                    m_personel.id_kota = '. $idKota .' AND
                                                    m_personel.id_kecamatan = '. $idKec .' AND
                                                    t_absen.tanggal_absen BETWEEN "'. $tglAwal .'" AND "'. $tglAkhir .'"
                                              GROUP BY m_personel.nrp');
        }
        
        return $dataRekap;
    }

    public function getDataRekapAll( $tglAwal, $tglAkhir )
    {
        $dataRekap           = DB::select('SELECT 
                                                m_personel.nrp,
                                                m_personel.nama_lengkap,
                                                m_personel.id_kecamatan,
                                                m_personel.satuan_kerja,
                                                t_absen.tanggal_absen,
                                                COUNT(CASE WHEN t_absen.status_absen = "hadir" THEN 1 END) as jmlHadir,
                                                COUNT(CASE WHEN t_absen.status_absen = "sakit" THEN 1 END) as jmlSakit,
                                                COUNT(CASE WHEN t_absen.status_absen = "cuti" THEN 1 END) as jmlCuti,
                                                COUNT(CASE WHEN t_absen.status_absen = "sekolah" THEN 1 END) as jmlSekolah,
                                                COUNT(CASE WHEN t_absen.status_absen = "izin" THEN 1 END) as jmlIzin,
                                                COUNT(CASE WHEN t_absen.status_absen = "alpha" THEN 1 END) as jmlAlpha
                                          FROM t_absen
                                          INNER JOIN m_personel ON m_personel.id_personel = t_absen.id_personel
                                          WHERE t_absen.tanggal_absen BETWEEN "'. $tglAwal .'" AND "'. $tglAkhir .'"
                                          GROUP BY m_personel.nrp');
        
        return $dataRekap;
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
    
}