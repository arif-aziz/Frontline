<?php

Route::get('/', 'AuthController@getIndex');
Route::get('login', 'AuthController@getIndex')->before('guest');
Route::get('logout', 'AuthController@getLogout')->before('auth');
Route::get('tipeuser', 'AuthController@getTipeUser')->before('auth');
Route::get('aktifitas', 'AuthController@getAktifitasUser')->before('auth');
Route::get('akses', 'AuthController@getAksesUser')->before('auth');
Route::get('jumlahrequest', 'AuthController@getJumlahRequest')->before('auth');
Route::get('password/update', 'AuthController@getUpdatePassword')->before('auth');
Route::post('password/update', 'AuthController@postUpdatePassword')->before('auth');
Route::post('login/post', 'AuthController@postLogin');

Route::get('dashboard', 'DashboardController@getIndex')->before('auth');

Route::get('user', 'UserController@getIndex')->before('auth');
Route::get('user/create', 'UserController@getCreateUser')->before('auth');
Route::get('user/view/{idUser}', 'UserController@getViewUser')->before('auth');
Route::get('user/update/{idUser}', 'UserController@getUpdateUser')->before('auth');
Route::get('user/delete/{idUser}', 'UserController@getDeleteUser')->before('auth');
Route::get('user/resetpassword/{idUser}', 'UserController@getResetPasswordUser')->before('auth');
Route::post('user/create', 'UserController@postCreateUser')->before('auth');
Route::post('user/update/{idUser}', 'UserController@postUpdateUser')->before('auth');
Route::post('user/delete/{idUser}', 'UserController@postDeleteUser')->before('auth');
Route::post('user/resetpassword/{idUser}', 'UserController@postResetPasswordUser')->before('auth');

Route::get('personel', 'PersonelController@getIndex')->before('auth');
Route::get('personel/create', 'PersonelController@getCreatePersonel')->before('auth');
Route::get('personel/filter', 'PersonelController@getFilterPersonel')->before('auth');
//source ganjil ditambahkan biar ndak error di laravel.log
Route::get('personel/personel/filter', 'PersonelController@getFilterPersonel')->before('auth');
//end of source ganjil
Route::get('personel/view/{idWilayah}/{satker}/{idPersonel}', 'PersonelController@getViewPersonel')->before('auth');
Route::get('personel/update/{idWilayah}/{satker}/{idPersonel}', 'PersonelController@getUpdatePersonel')->before('auth');
Route::get('personel/delete/{idWilayah}/{satker}/{idPersonel}', 'PersonelController@getDeletePersonel')->before('auth');
Route::get('personel/download', 'PersonelController@getDownloadPersonel')->before('auth');
Route::post('personel/create', 'PersonelController@postCreatePersonel')->before('auth');
Route::post('personel/update/{idPersonel}', 'PersonelController@postUpdatePersonel')->before('auth');
Route::post('personel/delete/{idPersonel}', 'PersonelController@postDeletePersonel')->before('auth');

Route::get('absen', 'AbsenController@getIndex')->before('auth');
Route::get('absen/filter', 'AbsenController@getFilterAbsen')->before('auth');
Route::get('absen/view/{idWilayah}/{satker}/{tglAbsen}/{idPersonel}', 'AbsenController@getViewAbsen')->before('auth');
Route::get('absen/update/{idWilayah}/{satker}/{tglAbsen}/{idAbsen}', 'AbsenController@getUpdateAbsen')->before('auth');
Route::get('absen/rekap', 'RekapAbsenController@getRekapAbsen')->before('auth');
Route::get('absen/rekap/filter', 'RekapAbsenController@getRekapFilter')->before('auth');
Route::post('absen/create', 'AbsenController@postCreateAbsen')->before('auth');
Route::post('absen/update/{idAbsen}', 'AbsenController@postUpdateAbsen')->before('auth');

Route::get('operasi', 'OperasiController@getIndex')->before('auth');
Route::get('operasi/create', 'OperasiController@getCreateOperasi')->before('auth');
Route::get('operasi/personel/filter', 'OperasiController@getFilterOperasi')->before('auth');
Route::get('operasi/personel/cek/{tglAbsen}/{idPersonel}', 'OperasiController@cekPersonelOnOperasi')->before('auth');
Route::get('operasi/view/{idOperasi}', 'OperasiController@getViewOperasi')->before('auth');
Route::get('operasi/update/{idOperasi}', 'OperasiController@getUpdateOperasi')->before('auth');
Route::get('operasi/delete/{idOperasi}', 'OperasiController@getDeleteOperasi')->before('auth');
Route::get('operasi/status/{idOperasi}', 'OperasiController@getStatusOperasi')->before('auth');
Route::get('operasi/dokumen/{idOperasi}', 'OperasiController@getDokumenOperasi')->before('auth');
Route::post('operasi/create/post', 'OperasiController@postCreateOperasi')->before('auth');
Route::post('operasi/update/{idOperasi}', 'OperasiController@postUpdateOperasi')->before('auth');
Route::post('operasi/delete/{idOperasi}', 'OperasiController@postDeleteOperasi')->before('auth');
Route::post('operasi/status/{idOperasi}', 'OperasiController@postStatusOperasi')->before('auth');

Route::get('operasi/telegram/view/{idOperasi}', 'OperasiController@getViewTelegram')->before('auth');
Route::get('operasi/telegram/update/{idOperasi}', 'OperasiController@getUpdateTelegram')->before('auth');
Route::post('operasi/telegram/update/{idOperasi}', 'OperasiController@postUpdateTelegram')->before('auth');

Route::get('operasi/sprin/create/{idOperasi}', 'OperasiController@getCreateSprin')->before('auth');
Route::get('operasi/sprin/update/{idOperasi}', 'OperasiController@getUpdateSprin')->before('auth');
Route::get('operasi/sprin/view/{idOperasi}', 'OperasiController@getViewSprin')->before('auth');
Route::post('operasi/sprin/create/{idOperasi}', 'OperasiController@postCreateSprin')->before('auth');
Route::post('operasi/sprin/update/{idOperasi}', 'OperasiController@postUpdateSprin')->before('auth');

Route::controller('kalenderoperasi', 'OperasiController');

Route::get('request', 'RequestController@getIndex')->before('auth');
Route::get('request/view/{idRequest}', 'RequestController@getViewRequest')->before('auth');
Route::get('request/update/{idRequest}', 'RequestController@getUpdateRequest')->before('auth');

Route::post('detailoperasi/create', 'DetailOperasiController@postCreateDetailOperasi')->before('auth');
Route::post('detailoperasi/update', 'DetailOperasiController@postUpdateDetailOperasi')->before('auth');

Route::get('absenoperasi', 'AbsenOperasiController@getIndex')->before('auth');
Route::get('absenoperasi/filter', 'AbsenOperasiController@getFilterAbsenOperasi')->before('auth');
Route::get('absenoperasi/view/{tglAbsen}/{idOperasi}/{idPersonel}', 'AbsenOperasiController@getViewAbsenOperasi')->before('auth');
Route::get('absenoperasi/update/{tglAbsen}/{idOperasi}/{idPersonel}', 'AbsenOperasiController@getUpdateAbsenOperasi')->before('auth');
Route::post('absenoperasi/update', 'AbsenOperasiController@postUpdateAbsenOperasi')->before('auth');
Route::post('absenoperasi/create', 'AbsenOperasiController@postCreateAbsenOperasi')->before('auth');

Route::get('pengaturan', 'PengaturanController@getIndex')->before('auth');
Route::get('pengaturan/create', 'PengaturanController@getCreatePengaturan')->before('auth');
Route::get('pengaturan/view/{idTipeUser}', 'PengaturanController@getViewPengaturan')->before('auth');
Route::get('pengaturan/update/{idTipeUser}', 'PengaturanController@getUpdatePengaturan')->before('auth');
Route::get('pengaturan/delete/{idTipeUser}', 'PengaturanController@getDeletePengaturan')->before('auth');
Route::post('pengaturan/create', 'PengaturanController@postCreatePengaturan')->before('auth');
Route::post('pengaturan/update/{idTipeUser}', 'PengaturanController@postUpdatePengaturan')->before('auth');
Route::post('pengaturan/delete/{idTipeUser}', 'PengaturanController@postDeletePengaturan')->before('auth');

Route::get('kalender', 'KalenderController@getIndex')->before('auth');

Route::get('cetak/telegram/{idOperasi}', 'DokumenController@getCetakTelegram')->before('auth');
Route::get('cetak/sprin/{idOperasi}', 'DokumenController@getCetakSprin')->before('auth');

Route::controller('area', 'AreaController');