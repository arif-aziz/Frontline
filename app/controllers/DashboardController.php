<?php

class DashboardController extends BaseController {

	public function getIndex()
	{
		$jumlahUser 	= User::count();
		$jumlahPersonel = Personel::count();
		$jumlahOperasi 	= Operasi::count();
		$personelSiap 	= $this->getPersonelSiap();
		$personelAktif 	= $this->getPersonelAktif();
		$reminderOps 	= $this->getReminderOps();

		return View::make('dashboard.index')
				   ->with(array(
				   				'jmlUser' 		=> $jumlahUser,
				   				'jmlPersonel' 	=> $jumlahPersonel,
				   				'jmlOperasi' 	=> $jumlahOperasi,
				   				'personelSiap'  => $personelSiap,
				   				'personelAktif' => $personelAktif,
				   				'reminderOps'  	=> $reminderOps
				   	 ));
	}

	public function getPersonelSiap()
	{
		$dataPersonelSiap  =  DB::select('SELECT 
                                        COUNT(t_absen.id_personel) AS jumlahPersonelSiap, 
                                        m_personel.instansi,
                                        m_area.nama
                                  FROM t_absen 
                                  INNER JOIN m_personel ON m_personel.id_personel = t_absen.id_personel
                                  INNER JOIN m_area ON m_area.id_kecamatan = m_personel.id_kecamatan
                                  WHERE m_personel.status_personel = "aktif" AND
                                  		t_absen.status_absen = "hadir" AND
                                  		t_absen.tanggal_absen = CURDATE() AND
                                  		m_area.id_provinsi = 35 AND
                                  		m_area.id_kota = 17
                                  GROUP BY m_personel.id_kecamatan');

		return $dataPersonelSiap;
	}

	public function getPersonelAktif()
	{
		$dataPersonelAktif = Personel::where('status_personel', 'aktif')
									 ->get();

		return $dataPersonelAktif;
	}

	public function getStatusAbsen()
	{
		$dataAbsen = Absen::join('m_personel', 'm_personel.id_personel', '=', 't_absen.id_personel')
								->join('m_area', 'm_area.id_kecamatan', '=', 'm_personel.id_kecamatan')
								->where('m_area.id_provinsi', 35)
								->where('m_area.id_kota', 17)
								->get();

		$dataPersonelAktif = $this->getPersonelAktif();

		foreach ($dataAbsen as $absen) {
			if ($absen->tanggal_absen == date('Y-m-d')) {
				$tmpPersonel[] = $absen->id_personel;
			}
		}

		foreach ($dataPersonelAktif as $personelAktif) {
			if (in_array($personelAktif->id_personel, $tmpPersonel)) {
				$status[] = 1;
			} else {
				$status[] = 0;
			}
		}

		if (in_array(0, $status)) {
			$dataStatusAbsen = 'belum';
		} else {
			$dataStatusAbsen = 'sudah';
		}
		
		return $dataStatusAbsen;
	}

	public function getReminderOps()
	{
		$selisih 	 = 0;
		$tempOps 	 = array();
		$dataOperasi = Operasi::where('status_op', 'proses')->get();

		foreach ($dataOperasi as $operasi) {
			$selisih = $this->getHitungHari($operasi->tanggal_selesai, date('Y-m-d'));
			if ($selisih == 0) {
				$tempOps[] = Operasi::where('id_operasi', $operasi->id_operasi)->first();
			}
		}

		return $tempOps;		
	}

	public function getHitungHari( $tglOperasi, $now )
    {
        $tgl1 = $tglOperasi;
        $tgl2 = $now;

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

}