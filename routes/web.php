<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Auth::routes();

// Profile
Route::get('/profile', 'PelangganController@show_profile')->name('profile');
Route::get('/profile/edit', 'PelangganController@edit')->name('edit_profile');
Route::get('/profile/ubah-password', 'PelangganController@ubahpassword')->name('ubah_password');
Route::post('/profile/save', 'PelangganController@save');
Route::post('/profile/ubah-password/update', 'PelangganController@saveUbahpassword');


Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/persetujuan', 'AdminController@persetujuan')->name('persetujuan');
    Route::get('/admin/pembayaran', 'AdminController@pembayaran')->name('pembayaran');
    Route::get('/admin/pengujian', 'AdminController@pengujian')->name('pengujian');
    Route::get('/admin/laporan', 'AdminController@laporan')->name('laporan');
    Route::get('/admin/selesai', 'AdminController@selesai')->name('selesai');
    Route::get('/admin/semua', 'AdminController@semua')->name('semua');


    Route::get('/pengajuan/{id}', 'AdminController@showSample')->name('show');
    Route::post('/persetujuan/insert', 'AdminController@insert');
    Route::post('/pembayaran/update', 'AdminController@updatePembayaran');
    Route::post('/hasil/update', 'AdminController@updateHasil');
    Route::post('/hasil/insert', 'AdminController@insertHasil');
    Route::get('/download/laporan/{id}', 'AdminController@downloadLaporan')->name('download');

    Route::get('/penerimaan-contoh/{id}', 'AdminController@showPenerimaan')->name('penerimaan');
    Route::post('/penerimaan-contoh/insert', 'AdminController@insertPenerimaan');

    Route::get('/admin/umpan-balik', 'AdminController@feedbackStatistik')->name('admin-feedback');
    Route::get('/admin/umpan-balik/{id}', 'AdminController@feedbackDetail')->name('admin-feedback-detail');
    Route::get('/admin/saran', 'AdminController@feedbackSaran')->name('saran');
});


Route::group(['middleware' => ['role:user']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/status', 'SampleController@statusPengajuan')->name('status');


    Route::get('/sample/{id}', 'SampleController@show')->name('show_sample');
    Route::delete('/sample/{sample:id}/delete', 'SampleController@deleteSample');

    Route::get('/pengajuan', 'SampleController@add')->name('add_sample');
    Route::post('/pengajuan/save', 'SampleController@save');
    Route::get('/pengajuan/{sample:id}/edit', 'SampleController@editSample')->name('edit_sample');
    Route::post('/pengajuan/update', 'SampleController@updateSample');

    Route::get('/pengiriman-contoh/{id}', 'SampleController@kirimContoh')->name('kirim_contoh');
    Route::post('/pengiriman-contoh/{id}/save', 'SampleController@updatePengiriman');

    Route::get('/umpan-balik/{id}', 'SampleController@feedback')->name('feedback');
    Route::post('/umpan-balik/{id}/save', 'SampleController@saveFeedback');
    
    Route::post('/sample/{id}/upload-bukti', 'SampleController@uploadBukti');

    Route::get('/info', 'PelangganController@info')->name('info');
});
