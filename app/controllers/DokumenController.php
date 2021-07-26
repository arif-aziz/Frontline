<?php

class DokumenController extends BaseController {

	public function getCetakTelegram( $idOperasi )
    {
        $dataTelegram = Telegram::where('id_operasi', $idOperasi)->first();

        $tanggalTelegram = $this->getKonversiTanggal( $dataTelegram->tgram_tanggal );

        $html = View::make('dokumen.telegram')->with(array('telegram' => $dataTelegram, 'tglTgram' => $tanggalTelegram));

        return PDF::load($html, 'A4', 'portrait')->download('telegram_ops_' . $idOperasi);
    }

    public function getCetakSprin( $idOperasi )
    {
        $dataSprin      = SuratPerintah::where('id_operasi', $idOperasi)->first();
        $dataDetailOps  = Operasi::join('t_detail_operasi', 't_detail_operasi.id_operasi', '=', 't_operasi.id_operasi')
                                     ->join('m_personel', 'm_personel.id_personel', '=', 't_detail_operasi.id_personel')
                                     ->where('t_operasi.id_operasi', $idOperasi)
                                     ->get();

        $tanggalSprin       = $this->getKonversiTanggal( $dataSprin->sprin_tanggal );
        
        $html = View::make('dokumen.sprin')->with(array('sprin'          => $dataSprin, 
                                                        'tglSprin'       => $tanggalSprin, 
                                                        'tglKeluarSprin' => $tanggalSprin, 
                                                        'detailOps'      => $dataDetailOps));

        return PDF::load($html, 'A4', 'portrait')->download('sprin_ops_' . $idOperasi);
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