<?php

class AktifitasUserSeeder extends Seeder {

    public function run()
    {
        DB::table('m_aktifitas_user')->delete();

        AktifitasUser::create(array('id_aktifitas_user' => 1, 'aktifitas' => 'input-user', 'kelompok' => 'user', 'keterangan_aktifitas' => 'Input, Edit, Hapus'));
        AktifitasUser::create(array('id_aktifitas_user' => 2, 'aktifitas' => 'input-personel', 'kelompok' => 'personel', 'keterangan_aktifitas' => 'Input, Edit, Hapus'));
        AktifitasUser::create(array('id_aktifitas_user' => 3, 'aktifitas' => 'input-absen', 'kelompok' => 'absen', 'keterangan_aktifitas' => 'Input, Edit'));
        AktifitasUser::create(array('id_aktifitas_user' => 4, 'aktifitas' => 'input-operasi', 'kelompok' => 'operasi', 'keterangan_aktifitas' => 'Input, Edit, Hapus'));
        AktifitasUser::create(array('id_aktifitas_user' => 5, 'aktifitas' => 'input-request', 'kelompok' => 'request', 'keterangan_aktifitas' => 'Input'));
        AktifitasUser::create(array('id_aktifitas_user' => 6, 'aktifitas' => 'input-absen-operasi', 'kelompok' => 'absen-operasi', 'keterangan_aktifitas' => 'Input, Edit'));
        AktifitasUser::create(array('id_aktifitas_user' => 7, 'aktifitas' => 'input-surat-perintah', 'kelompok' => 'surat-perintah', 'keterangan_aktifitas' => 'Input, Edit'));
        AktifitasUser::create(array('id_aktifitas_user' => 8, 'aktifitas' => 'view-user', 'kelompok' => 'user', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 9, 'aktifitas' => 'view-personel', 'kelompok' => 'personel', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 10, 'aktifitas' => 'view-absen', 'kelompok' => 'absen', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 11, 'aktifitas' => 'view-operasi', 'kelompok' => 'operasi', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 12, 'aktifitas' => 'view-absen-operasi', 'kelompok' => 'absen-operasi', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 13, 'aktifitas' => 'view-surat-perintah', 'kelompok' => 'surat-perintah', 'keterangan_aktifitas' => 'Lihat'));
        AktifitasUser::create(array('id_aktifitas_user' => 14, 'aktifitas' => 'sistem-setting', 'kelompok' => 'sistem', 'keterangan_aktifitas' => 'Input, Edit, Hapus'));
        AktifitasUser::create(array('id_aktifitas_user' => 15, 'aktifitas' => 'sistem-backup', 'kelompok' => 'sistem', 'keterangan_aktifitas' => 'Backup Data'));
    }

}