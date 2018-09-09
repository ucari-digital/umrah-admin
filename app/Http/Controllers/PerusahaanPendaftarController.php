<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Perusahaan;
use App\Model\Pendaftar;
class PerusahaanPendaftarController extends Controller
{
    public function index()
    {
    	// $perusahaan = DB::table('perusahaan')
    	// ->join('pendaftar', 'perusahaan.kode_perusahaan', 'pendaftar.kode_perusahaan')
    	// ->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    	// ->get();

    	$perusahaan = Perusahaan::all();
    	return view('page.report-perusahaan-pendaftar.perusahaan-pendaftar')
    	->with('perusahaan', $perusahaan);
    }

    public function detail($kode_perusahaan)
    {
        $title = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->first();
    	$peserta = DB::table('pendaftar')
    	->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
        ->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
    	->where('pendaftar.kode_perusahaan', $kode_perusahaan)
    	->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status', 'transaksi.kode_produk')
    	->get();

    	return view('page.report-perusahaan-pendaftar.perusahaan-pendaftar-detail')
        ->with('title_label', $title)
    	->with('peserta', $peserta);
    }

    /**
    * Helper
    */

    public static function jamaahPerusahaan($kode_perusahaan)
    {
    	$data = Pendaftar::where('kode_perusahaan', $kode_perusahaan)->count();
    	return $data;
    }

    public static function jamaahVerifikasi($kode_perusahaan)
    {
    	$data = DB::table('pendaftar')
    	->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    	->where('pendaftar.kode_perusahaan', $kode_perusahaan)
    	->where('peserta.status', 'approved')
    	->count();
    	return $data;
    }

    public static function jamaahUnverifikasi($kode_perusahaan)
    {
    	$data = DB::table('pendaftar')
    	->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    	->where('pendaftar.kode_perusahaan', $kode_perusahaan)
    	->where('peserta.status', 'pending')
    	->count();
    	return $data;
    }
}
