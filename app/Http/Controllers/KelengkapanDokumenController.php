<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\TransaksiDokumen;
class KelengkapanDokumenController extends Controller
{
    public function index()
    {
    	$dokumen = DB::table('transaksi_dokumen')
    	->join('transaksi', 'transaksi_dokumen.nomor_transaksi', 'transaksi.nomor_transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
    	->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
    	->select('pendaftar.nama', 'perusahaan.nama as nama_perusahaan', 'produk.tanggal_keberangkatan', 'transaksi.nomor_transaksi')
    	->get();

    	return view('page.report-kelengkapan-dokumen.kelengkapan-dokumen')
    	->with('dokumen', $dokumen);
    }

    public function detail($nomor_transaksi)
    {
    	try {
    		$dokumen = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)->first();
	    	return view('page.report-kelengkapan-dokumen.kelengkapan-dokumen-detail')
	    	->with('dokumen', $dokumen);
    	} catch (\Exception $e) {
    		
    	}
    	
    }

    /**
    * Helper
    */

    public static function statusDokumen($nomor_transaksi)
    {
    	$dokumen = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)
    	->whereNotNull('passpor')
    	->whereNotNull('foto')
    	->whereNotNull('kartu_keluarga')
    	->whereNotNull('kartu_kuning')
    	->whereNotNull('kartu_karyawan')
    	->where('nomor_transaksi', $nomor_transaksi)
    	->first();

    	if ($dokumen) {
    		return 'Lengkap';
    	} else {
    		return 'Tidak Lengkap';
    	}
    }
}
