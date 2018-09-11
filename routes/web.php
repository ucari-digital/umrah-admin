<?php

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
use App\Helper\OperatorSimCard;
Route::get('/', 'Auth\LoginController@index');
Route::post('login', 'Auth\LoginController@login');

Route::get('revoke', function(){
	Auth::logout();
	return redirect('/');
});

Route::get('operator', function(){
	return OperatorSimCard::info('62813');
});

Route::middleware(['login'])->group(function(){
	Route::get('dashboard', function(){
		return view('index');
	});
	/**
	* Users
	*/

	Route::get('users', 'UserController@index');
	Route::get('users-data', 'UserController@data');
	Route::get('users/{status}/{kode_user}', 'UserController@status');
	Route::post('users-post', 'UserController@save');

	/**
	* Travel
	*/
	Route::get('travel', 'TravelController@index');
	Route::get('travel-data', 'TravelController@data');
	Route::post('travel-post', 'TravelController@save');
	Route::get('travel-drop/{kode_travel}', 'TravelController@drop');

	/**
	* Bank
	*/
	Route::get('bank', 'BankController@index');
	Route::get('bank-data', 'BankController@data');
	Route::post('bank-post', 'BankController@save');
	Route::get('bank-drop/{kode_bank}', 'BankController@drop');

	/**
	* Tanggal Berangkat
	*/

	Route::get('tanggal-berangkat', 'TglKeberangkatanController@index');
	Route::get('tanggal-berangkat-data', 'TglKeberangkatanController@data');
	Route::get('publish-or-no/{status}/{kode_produk}', 'TglKeberangkatanController@pubOrNo');
	Route::get('tanggal-berangkat-drop/{kode_produk}', 'TglKeberangkatanController@drop');
	Route::post('tanggal-berangkat-post', 'TglKeberangkatanController@save');

	/**
	* Embarkasi
	*/

	Route::get('embarkasi', 'EmbarkasiController@index');
	Route::get('embarkasi-data', 'EmbarkasiController@data');
	Route::get('embarkasi-drop/{kode_produk}', 'EmbarkasiController@drop');
	Route::post('embarkasi-post', 'EmbarkasiController@save');

	/**
	* Peserta
	* - verikasi 
	* - informasi peserta
	* - hotel peserta
	*/

	Route::get('peserta', 'PesertaController@index');
	Route::get('peserta/pin/{nomor_peserta}', 'PesertaController@sendPin');
	Route::post('peserta/{status}/{nomor_peserta}', 'PesertaController@status');
	Route::post('peserta-cek', 'PesertaController@cekPeserta');
	Route::get('peserta-remove/{id}', 'PesertaController@hapusPeserta');

	// Informasi peserta
	Route::get('informasi-peserta', 'PesertaController@indexInformasiPeserta');
	Route::get('informasi-peserta-detail/{nomor_transaksi}', 'PesertaController@indexInformasiPesertaDetail');

	// Hotel Peserta
	Route::get('hotel-peserta', 'PesertaController@indexHotelPeserta');
	Route::get('hotel-peserta-detail/{kode_produk}/{kode_kamar_madinah}/{kode_kamar_mekkah}', 'PesertaController@detailHotelPeserta');
	Route::get('hotel-peserta-delete/{lokasi}/{nomor_transaksi}', 'PesertaController@hapusHotelPeserta');
	Route::get('hotel-peserta-check/{kode_produk}/{lokasi}/{kode_kamar_madinah}/{kode_kamar_mekkah}', 'PesertaController@checkHotelPeserta');


	/**
	* Perusahaan
	*/
	Route::get('perusahaan', 'PerusahaanController@index');
	Route::get('perusahaan-data', 'PerusahaanController@data');
	Route::post('perusahaan-post', 'PerusahaanController@save');
	Route::get('perusahaan-change/{kode_perusahaan?}', 'PerusahaanController@change');
	Route::post('perusahaan-update/{kode_perusahaan}', 'PerusahaanController@update');

	/**
	* Dokumen
	*/

	Route::get('dokumen', 'DokumenController@index');
	Route::get('dokumen/{nomor_transaksi}', 'DokumenController@detail');
	Route::get('dokumen/{field}/{status}/{nomor_transaksi}', 'DokumenController@status');

	/**
	* Pembayaran
	*/

	Route::get('pembayaran', 'PembayaranController@index');
	Route::get('pembayaran/{status}/{nomor_pembayaran}', 'PembayaranController@status');

	/**
	* Book Seat dan peserta
	*/

	Route::get('book/seat/', 'BookController@seatIndex');
	Route::get('book/seat/peserta/{nomor_peserta?}', 'BookController@seatIndexPeserta');
	Route::post('book/seat/availabel/{status?}', 'BookController@checkAvailabelSeat');
	Route::post('book/seat-post', 'BookController@saveIndex');
	Route::post('book/seat/peserta-post', 'BookController@saveIndexPeserta');

	/**
	* Book Hotel Seat dan peserta
	*/

	Route::get('book/hotel', 'BookController@hotelIndex');
	Route::get('book/hotel/peserta/{nomor_peserta?}', 'BookController@hotelIndexPeserta');
	Route::post('book/hotel/availabel', 'BookController@checkAvailabelHotel');
	Route::post('book/hotel-post', 'BookController@saveHotelIndex');
	Route::post('book/hotel/peserta-post', 'BookController@saveHotelIndexPeserta');

	/**
	 * Departemen
	 */
	Route::get('departemen', 'DepartemenController@index');
	Route::post('departemen-post', 'DepartemenController@save');
	Route::get('departemen-data', 'DepartemenController@data');
	Route::get('departemen-drop/{id}', 'DepartemenController@drop');
	

	/**
	* SMS
	*/
	Route::get('sms', 'SMSController@index');

	/**
	* Report
	*/

	// Perushaan pendaftar
	Route::get('perusahaan-pendaftar', 'PerusahaanPendaftarController@index');
	Route::get('perusahaan-pendaftar/{kode_perusahaan}', 'PerusahaanPendaftarController@detail');

	// Keberangkatan peserta
	Route::get('keberangkatan-peserta', 'KeberangkatanPesertaController@index');
	Route::get('keberangkatan-peserta/{kode_perusahaan}', 'KeberangkatanPesertaController@detail');

	// Kepulangan peserta
	Route::get('kepulangan-peserta', 'KepulanganPesertaController@index');
	Route::get('kepulangan-peserta/{kode_perusahaan}', 'KepulanganPesertaController@detail');

	// Kelengkapan Dokumen
	Route::get('kelengkapan-dokumen', 'KelengkapanDokumenController@index');
	Route::get('kelengkapan-dokumen/{nomor_transaksi}', 'KelengkapanDokumenController@detail');

	// Manifest Pesawat
	Route::get('manifest-pesawat', 'ManifestController@index');
	Route::get('manifest-pesawat/{kode_produk}', 'ManifestController@detail');

	// Pembayaran
	Route::get('laporan-pembayaran', 'PembayaranController@laporan');

	// Data Jamaah
	Route::get('data-jamaah', 'DataJamaahController@index');
	Route::get('data-jamaah-perusahaan/{kode_produk}', 'DataJamaahController@detailPerusahaan');
	Route::get('data-jamaah-perusahaan-detail/{kode_produk}/{kode_perusahaan}', 'DataJamaahController@detailPeserta');

	// Data Jamaah Hotel
	Route::get('data-jamaah-hotel', 'DataJamaahHotelController@index');
	Route::get('data-jamaah-hotel-detail/{kode_produk}/{kode_kamar_madinah}/{kode_kamar_mekkah}', 'DataJamaahHotelController@detail');

	// Bank
	Route::get('data-bank', 'BankController@reportIndex');
	Route::get('data-bank/{kode_bank}', 'BankController@reportIndexDetail');

	// Travel
	Route::get('data-travel', 'TravelController@reportIndex');
	Route::get('data-travel/{kode_bank}', 'TravelController@reportIndexDetail');


	/**
	 *
	 * REPORT
	 *
	 */
	Route::group(['prefix' => 'report'], function() {
		Route::match(['get', 'post'], 'data-jamaah', 'Report\JamaahController@index');
		Route::post('data-jamaah/print', 'Report\JamaahController@print');
		Route::get('data-jamaah/preview', 'Report\JamaahController@preview');
	});


	/**
	 * Setting
	 */

	Route::group(['prefix' => 'setting'], function(){
		Route::get('tahun-hijriah', 'SettingController@tahunHijriah');
	});
	

	/**
	* UNIT TESTING CONTROL
	*/

	Route::get('data-jamaah/{kode_produk}', 'DataJamaahController@produkPerusahaan');
	Route::get('generate-seat/{kode_pesawat}', 'GeneratorController@seat');
	Route::get('generate-hotel', 'GeneratorController@hotel');
	Route::get('generate-user', 'GeneratorController@user');
	Route::get('sms-send', 'SMSController@testing');
	Route::get('ntf', 'NotificationController@notificationHotel');
	Route::get('auto', 'HotelAutomationController@run');
	Route::get('th', 'SettingController@test');
});
