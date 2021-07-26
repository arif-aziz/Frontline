<?php

class HakAksesSeeder extends Seeder {

    public function run()
    {
        DB::table('m_hak_akses')->delete();

        /* POLRES ADMIN SUPERADMIN */
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 1));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 2));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 4));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 6));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 7));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 8));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 13));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 14));
        HakAkses::create(array('id_tipe_user' => 1, 'id_aktifitas_user' => 15));

        /* POLRES ADMIN OPS */
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 4));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 6));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 7));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 2, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SUMDA */
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 2));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 3, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN RESKRIM */
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 4, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN INTEL */
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 5, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN LANTAS */
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 6, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN BRIMOB */
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 7, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SABHARA */
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 8, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN NARKOBA */
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 9, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SIEWAS */
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 10, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SIEPROPAM */
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 11, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SIEUM */
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 12, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SIETIPOL */
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 13, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN SIEKEU */
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 14, 'id_aktifitas_user' => 13));

        /* POLRES ADMIN PNS */
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 15, 'id_aktifitas_user' => 13));

        /* ------------------------------------------------------------------------------------------------------- */

        /* POLRES KABAG KAPOLRES */
        HakAkses::create(array('id_tipe_user' => 16, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 16, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 16, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 16, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 16, 'id_aktifitas_user' => 13));

        /* POLRES KABAG WAKAPOLRES */
        HakAkses::create(array('id_tipe_user' => 17, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 17, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 17, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 17, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 17, 'id_aktifitas_user' => 13));

        /* POLRES KABAG OPS */
        HakAkses::create(array('id_tipe_user' => 18, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 18, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 18, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 18, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 18, 'id_aktifitas_user' => 13));

        /* POLRES KABAG SUMDA */
        HakAkses::create(array('id_tipe_user' => 19, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 19, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 19, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 19, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 19, 'id_aktifitas_user' => 13));

        /* POLRES KABAG RESKRIM */
        HakAkses::create(array('id_tipe_user' => 20, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 20, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 20, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 20, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 20, 'id_aktifitas_user' => 13));

        /* POLRES KABAG INTEL */
        HakAkses::create(array('id_tipe_user' => 21, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 21, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 21, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 21, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 21, 'id_aktifitas_user' => 13));

        /* POLRES KABAG LANTAS */
        HakAkses::create(array('id_tipe_user' => 22, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 22, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 22, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 22, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 22, 'id_aktifitas_user' => 13));

        /* POLRES KABAG BRIMOB */
        HakAkses::create(array('id_tipe_user' => 23, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 23, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 23, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 23, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 23, 'id_aktifitas_user' => 13));

        /* POLRES KABAG SABHARA */
        HakAkses::create(array('id_tipe_user' => 24, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 24, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 24, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 24, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 24, 'id_aktifitas_user' => 13));

        /* POLRES KABAG NARKOBA */
        HakAkses::create(array('id_tipe_user' => 25, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 25, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 25, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 25, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 25, 'id_aktifitas_user' => 13));

        /* ----------------------------------------------------------------------------------------------- */

        /* POLSEK ADMIN SUPERADMIN */
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 3));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 5));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 26, 'id_aktifitas_user' => 13));

        /* POLSEK KABAG KAPOLSEK */
        HakAkses::create(array('id_tipe_user' => 27, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 27, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 27, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 27, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 27, 'id_aktifitas_user' => 13));

        /* POLSEK KABAG WAKAPOLSEK */
        HakAkses::create(array('id_tipe_user' => 28, 'id_aktifitas_user' => 9));
        HakAkses::create(array('id_tipe_user' => 28, 'id_aktifitas_user' => 10));
        HakAkses::create(array('id_tipe_user' => 28, 'id_aktifitas_user' => 11));
        HakAkses::create(array('id_tipe_user' => 28, 'id_aktifitas_user' => 12));
        HakAkses::create(array('id_tipe_user' => 28, 'id_aktifitas_user' => 13));
    }

}