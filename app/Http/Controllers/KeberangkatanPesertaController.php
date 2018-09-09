<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
use App\Model\Transaksi;
use DB;
class KeberangkatanPesertaController extends Controller
{
    public function index()
    {
    	$produk = Produk::all();
    	return view('page.report-keberangkatan-peserta.keberangkatan-peserta')
    	->with('produk', $produk);
    }

    public function detail($kode_produk)
    {
    	$produk = Produk::where('kode_produk', $kode_produk)->select('tanggal_keberangkatan')->first();
    	$peserta = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->where('transaksi.kode_produk', $kode_produk)
    	->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status')
    	->get();

    	return view('page.report-keberangkatan-peserta.keberangkatan-peserta-detail')
    	->with('produk', $produk)
    	->with('peserta', $peserta);
    }


    /**
    * Helper
    */

    public static function produkPeserta($kode_produk)
    {
    	$peserta = Transaksi::where('kode_produk', $kode_produk)->where('status', 'approved')->count();
    	return $peserta;
    }
}
