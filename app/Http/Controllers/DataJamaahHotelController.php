<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataJamaahHotelController extends Controller
{
    public function index(Request $request)
    {
    	/**
    	* Hotel dengan distinc untuk menampilkan room hotel yang telah di pilih oleh jamaah
    	*/
    	$hotel = DB::table('transaksi')
    	->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
        ->join('transaksi_hotel_mekkah', 'transaksi.nomor_transaksi', 'transaksi_hotel_mekkah.nomor_transaksi')
    	->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
        ->join('dat_hotel_seat as dat_hotel_seat_madinah', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat_madinah.kode_kamar')
    	->join('dat_hotel_seat as dat_hotel_seat_mekkah', 'transaksi_hotel_mekkah.kode_kamar', 'dat_hotel_seat_mekkah.kode_kamar')

        ->join('dat_hotel as dat_hotel_madinah', 'dat_hotel_seat_madinah.kode_hotel', 'dat_hotel_madinah.kode_hotel')
    	->join('dat_hotel as dat_hotel_mekkah', 'dat_hotel_seat_mekkah.kode_hotel', 'dat_hotel_mekkah.kode_hotel')

    	->where('transaksi_hotel.status', 'approved')
    	->select('transaksi_hotel.kode_kamar as kode_kamar_madinah', 'transaksi_hotel_mekkah.kode_kamar as kode_kamar_mekkah', 'produk.kode_produk', 'produk.durasi_hotel_madinah', 'produk.durasi_hotel_mekkah', 'dat_hotel_madinah.nama_hotel as nama_hotel_madinah', 'dat_hotel_mekkah.nama_hotel as nama_hotel_mekkah', 'dat_hotel_madinah.lokasi as lokasi_madinah', 'dat_hotel_mekkah.lokasi as lokasi_mekkah', 'dat_hotel_seat_madinah.lantai as lantai_madinah', 'dat_hotel_seat_madinah.nomor_kamar as nomor_kamar_madinah', 'dat_hotel_seat_mekkah.lantai as lantai_mekkah', 'dat_hotel_seat_mekkah.nomor_kamar as nomor_kamar_mekkah')
    	->distinct()
    	->get();

        // return $hotel;

    	return view('page.report-data-jamaah-hotel.data-jamaah-hotel')
    	->with('hotel', $hotel);
    }

    public function detail($kode_produk, $kode_kamar_madinah, $kode_kamar_mekkah)
    {
    	$jamaah_hotel = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
    	->where('transaksi_hotel.kode_produk', $kode_produk)
    	->where('transaksi_hotel.kode_kamar', $kode_kamar)
    	->where('transaksi_hotel.status', 'approved')
    	->select('pendaftar.nama', 'pendaftar.nip', 'pendaftar.nik', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.hubungan_keluarga')
    	->get();

    	// return $jamaah_hotel;
    	return view('page.report-data-jamaah-hotel.data-jamaah-hotel-detail')
    	->with('jamaah_hotel', $jamaah_hotel);
    }

    /**
    * Mengambil jumlah orang dalam satu ruangan hotel
    */

    public static function jamaahHotel($kode_produk, $kode_kamar)
    {
    	$jamaah_hotel = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
    	->where('transaksi_hotel.kode_produk', $kode_produk)
    	->where('transaksi_hotel.kode_kamar', $kode_kamar)
    	->where('transaksi_hotel.status', 'approved')
    	->select('pendaftar.nama', 'pendaftar.nip', 'pendaftar.nik', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.hubungan_keluarga')
    	->get();

    	return count($jamaah_hotel);
    }
}
