<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
use DB;
class ManifestController extends Controller
{
    public function index()
    {
    	$produk = Produk::all();
    	return view('page.report-manifest-pesawat.manifest-pesawat')
    	->with('produk', $produk);
    }

    public function detail($kode_produk)
    {
    	$produk = Produk::where('kode_produk', $kode_produk)->select('tanggal_keberangkatan')->first();
    	$manifest = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
    	->join('dat_pesawat_seat', 'transaksi_pesawat.kode_kursi', 'dat_pesawat_seat.kode_kursi')
    	->where('transaksi_pesawat.status', 'approved')
    	->where('transaksi.kode_produk', $kode_produk)
    	->select('pendaftar.nama', 'dat_pesawat_seat.kursi')
    	->get();

    	return view('page.report-manifest-pesawat.manifest-pesawat-detail')
    	->with('produk', $produk)
    	->with('manifest', $manifest);
    }
}
