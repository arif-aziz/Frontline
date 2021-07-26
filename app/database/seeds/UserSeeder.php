<?php

class UserSeeder extends Seeder {

    public function run()
    {
        DB::table('m_user')->delete();

        User::create(array('id_tipe_user' => 1, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'superadmin', 'password' => Hash::make('superadmin'), 'nama_lengkap_user' => 'Polres Superadmin'));
        User::create(array('id_tipe_user' => 2, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminops', 'password' => Hash::make('adminops'), 'nama_lengkap_user' => 'Polres Admin Ops'));
        User::create(array('id_tipe_user' => 3, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsumda', 'password' => Hash::make('adminsumda'), 'nama_lengkap_user' => 'Polres Admin Sumda'));
        User::create(array('id_tipe_user' => 4, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminreskrim', 'password' => Hash::make('adminreskrim'), 'nama_lengkap_user' => 'Polres Admin Reskrim'));
        User::create(array('id_tipe_user' => 5, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminintel', 'password' => Hash::make('adminintel'), 'nama_lengkap_user' => 'Polres Admin Intel'));
        User::create(array('id_tipe_user' => 6, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminlantas', 'password' => Hash::make('adminlantas'), 'nama_lengkap_user' => 'Polres Admin Lantas'));
        User::create(array('id_tipe_user' => 7, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminbrimob', 'password' => Hash::make('adminbrimob'), 'nama_lengkap_user' => 'Polres Admin Brimob'));
        User::create(array('id_tipe_user' => 8, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsabhara', 'password' => Hash::make('adminsabhara'), 'nama_lengkap_user' => 'Polres Admin Sabhara'));
        User::create(array('id_tipe_user' => 9, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminnarkoba', 'password' => Hash::make('adminnarkoba'), 'nama_lengkap_user' => 'Polres Admin Narkoba'));
        User::create(array('id_tipe_user' => 10, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsiewas', 'password' => Hash::make('adminsiewas'), 'nama_lengkap_user' => 'Polres Admin Siewas'));
        User::create(array('id_tipe_user' => 11, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsiepropam', 'password' => Hash::make('adminsiepropam'), 'nama_lengkap_user' => 'Polres Admin Siepropam'));
        User::create(array('id_tipe_user' => 12, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsieum', 'password' => Hash::make('adminsieum'), 'nama_lengkap_user' => 'Polres Admin Sieum'));
        User::create(array('id_tipe_user' => 13, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsietipol', 'password' => Hash::make('adminsietipol'), 'nama_lengkap_user' => 'Polres Admin Sietipol'));
        User::create(array('id_tipe_user' => 14, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminsiekeu', 'password' => Hash::make('adminsiekeu'), 'nama_lengkap_user' => 'Polres Admin Siekeu'));
        User::create(array('id_tipe_user' => 15, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'adminpns', 'password' => Hash::make('adminpns'), 'nama_lengkap_user' => 'Polres Admin PNS'));

        /* -------------------------------------------------------------------------------- */

        User::create(array('id_tipe_user' => 16, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kapolres', 'password' => Hash::make('kapolres'), 'nama_lengkap_user' => 'Kapolres'));
        User::create(array('id_tipe_user' => 17, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'wakapolres', 'password' => Hash::make('wakapolres'), 'nama_lengkap_user' => 'Wakapolres'));
        User::create(array('id_tipe_user' => 18, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kabagops', 'password' => Hash::make('kabagops'), 'nama_lengkap_user' => 'Polres Kabag Ops'));
        User::create(array('id_tipe_user' => 19, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kabagsumda', 'password' => Hash::make('kabagsumda'), 'nama_lengkap_user' => 'Polres Kabag Sumda'));
        User::create(array('id_tipe_user' => 20, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatreskrim', 'password' => Hash::make('kasatreskrim'), 'nama_lengkap_user' => 'Polres Kasat Reskrim'));
        User::create(array('id_tipe_user' => 21, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatintel', 'password' => Hash::make('kasatintel'), 'nama_lengkap_user' => 'Polres Kasat Intel'));
        User::create(array('id_tipe_user' => 22, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatlantas', 'password' => Hash::make('kasatlantas'), 'nama_lengkap_user' => 'Polres Kasat Lantas'));
        User::create(array('id_tipe_user' => 23, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatbrimob', 'password' => Hash::make('kasatbrimob'), 'nama_lengkap_user' => 'Polres Kasat Brimob'));
        User::create(array('id_tipe_user' => 24, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatsabhara', 'password' => Hash::make('kasatsabhara'), 'nama_lengkap_user' => 'Polres Kasat Sabhara'));
        User::create(array('id_tipe_user' => 25, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 0, 'username' => 'kasatnarkoba', 'password' => Hash::make('kasatnarkoba'), 'nama_lengkap_user' => 'Polres Kasat Narkoba'));

        /* -------------------------------------------------------------------------------- */

        User::create(array('id_tipe_user' => 26, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 10, 'username' => 'adminsekbandar', 'password' => Hash::make('adminsekbandar'), 'nama_lengkap_user' => 'Admin Bandar Kedung Mulyo'));
        User::create(array('id_tipe_user' => 27, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 10, 'username' => 'kapolsekbandar', 'password' => Hash::make('kapolsekbandar'), 'nama_lengkap_user' => 'Kapolsek Bandar Kedung Mulyo'));
        User::create(array('id_tipe_user' => 28, 'id_provinsi' => 35, 'id_kota' => 17, 'id_kecamatan' => 10, 'username' => 'wakapolsekbandar', 'password' => Hash::make('wakapolsekbandar'), 'nama_lengkap_user' => 'Wakapolsek Bandar Kedung Mulyo'));
    }

}