<?php

class TipeUserSeeder extends Seeder {

    public function run()
    {
        DB::table('m_tipe_user')->delete();

        TipeUser::create(array('id_tipe_user' => 1, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'superadmin'));
        TipeUser::create(array('id_tipe_user' => 2, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'ops'));
        TipeUser::create(array('id_tipe_user' => 3, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'sumda'));
        TipeUser::create(array('id_tipe_user' => 4, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'reskrim'));
        TipeUser::create(array('id_tipe_user' => 5, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'intel'));
        TipeUser::create(array('id_tipe_user' => 6, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'lantas'));
        TipeUser::create(array('id_tipe_user' => 7, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'brimob'));
        TipeUser::create(array('id_tipe_user' => 8, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'sabhara'));
        TipeUser::create(array('id_tipe_user' => 9, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'narkoba'));
        TipeUser::create(array('id_tipe_user' => 10, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'siewas'));
        TipeUser::create(array('id_tipe_user' => 11, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'siepropam'));
        TipeUser::create(array('id_tipe_user' => 12, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'sieum'));
        TipeUser::create(array('id_tipe_user' => 13, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'sietipol'));
        TipeUser::create(array('id_tipe_user' => 14, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'siekeu'));
        TipeUser::create(array('id_tipe_user' => 15, 'instansi' => 'polres', 'jabatan' => 'admin', 'satuan_kerja' => 'pns'));
        /* ------------------------------------------------------------------------------------------------ */
        TipeUser::create(array('id_tipe_user' => 16, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'kapolres'));
        TipeUser::create(array('id_tipe_user' => 17, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'wakapolres'));
        TipeUser::create(array('id_tipe_user' => 18, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'ops'));
        TipeUser::create(array('id_tipe_user' => 19, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'sumda'));
        TipeUser::create(array('id_tipe_user' => 20, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'reskrim'));
        TipeUser::create(array('id_tipe_user' => 21, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'intel'));
        TipeUser::create(array('id_tipe_user' => 22, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'lantas'));
        TipeUser::create(array('id_tipe_user' => 23, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'brimob'));
        TipeUser::create(array('id_tipe_user' => 24, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'sabhara'));
        TipeUser::create(array('id_tipe_user' => 25, 'instansi' => 'polres', 'jabatan' => 'kabag', 'satuan_kerja' => 'narkoba'));
        /* ------------------------------------------------------------------------------------------------ */
        TipeUser::create(array('id_tipe_user' => 26, 'instansi' => 'polsek', 'jabatan' => 'admin', 'satuan_kerja' => 'superadmin'));
        TipeUser::create(array('id_tipe_user' => 27, 'instansi' => 'polsek', 'jabatan' => 'kabag', 'satuan_kerja' => 'kapolsek'));
        TipeUser::create(array('id_tipe_user' => 28, 'instansi' => 'polsek', 'jabatan' => 'kabag', 'satuan_kerja' => 'wakapolsek'));
    }

}