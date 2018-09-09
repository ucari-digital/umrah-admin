<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
use DB;
class KepulanganPesertaController extends Controller
{
    public function index()
    {
    	$produk = Produk::where('tanggal_kepulangan', '<=', date('Y-m-d'))->get();
    	return view('page.report-kepulangan-peserta.kepulangan-peserta')
    	->with('produk', $produk);
    }

    public function detail($kode_produk)
    {
    	$produk = Produk::where('kode_produk', $kode_produk)->select('tanggal_kepulangan')->first();
    	$peserta = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->where('transaksi.kode_produk', $kode_produk)
    	->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status')
    	->get();

    	return view('page.report-kepulangan-peserta.kepulangan-peserta-detail')
    	->with('produk', $produk)
    	->with('peserta', $peserta);
    }
}
