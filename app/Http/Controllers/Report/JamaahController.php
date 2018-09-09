<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;

// Model
use App\Model\Perusahaan;
use App\Model\Produk;
class JamaahController extends Controller
{
    public function index(Request $r)
    {
    	$perusahaan = Perusahaan::where('status', 'active')->get();
    	$produk = DB::table('produk')
    	->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
    	->select('produk.kode_produk', 'produk.nama_produk', 'embarkasi.kota')
    	->get();

    	// return $r->all();

    	if (!empty($r->all())) {
    		$data = self::query($r);

    		return view('report.data-jamaah')
    		->with('data', $data)
	    	->with('perusahaan', $perusahaan)
	    	->with('produk', $produk);
    	} else {
    		$data = DB::table('pendaftar')
    		->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    		->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
    		->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
    		->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
    		->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
    		->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status', 'produk.nama_produk', 'produk.tanggal_keberangkatan', 'embarkasi.kota as embarkasi', 'perusahaan.nama as nama_perusahaan')
    		->paginate(10);
	    	return view('report.data-jamaah')
	    	->with('data', $data)
	    	->with('perusahaan', $perusahaan)
	    	->with('produk', $produk);
    	}
    }

    public function print(Request $r)
    {
    	$produk = DB::table('produk')
    	->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
    	->select('produk.kode_produk', 'produk.nama_produk', 'produk.tanggal_keberangkatan', 'embarkasi.kota as embarkasi')
    	->where('produk.kode_produk', $r->kode_produk)
    	->first();

    	$data = self::query($r);

    	$pdf = PDF::loadView('report.print.data-jamaah', ['data' => $data, 'produk' => $produk]);
    	$pdf->setPaper('a4', 'landscape');
		return $pdf->stream('data-jamaah.pdf');
    }

    public function preview(Request $r)
    {
    	$produk = DB::table('produk')
    	->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
    	->select('produk.kode_produk', 'produk.nama_produk', 'produk.tanggal_keberangkatan', 'embarkasi.kota as embarkasi')
    	->where('produk.kode_produk', $r->kode_produk)
    	->first();

    	$data = DB::table('pendaftar')
		->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
		->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
		->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
		->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
		->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status', 'produk.nama_produk', 'produk.tanggal_keberangkatan', 'perusahaan.nama as nama_perusahaan')
		->get();
    	return view('report.print.data-jamaah')
    	->with('produk', $produk)
    	->with('data', $data);
    }



    public static function query($r)
    {

    	if (!empty($r->all())) {
    		$data = DB::table('pendaftar')
    		->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    		->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
    		->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
    		->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
    		->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
    		->where(function($query) use ($r){
    			if ($r->kode_perusahaan) {
    				$query->where('perusahaan.kode_perusahaan', '=', $r->kode_perusahaan);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->nip) {
    				$query->where('pendaftar.nip', '=', $r->nip);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->nik) {
    				$query->where('pendaftar.nik', '=', $r->nik);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->nama) {
    				$query->where('pendaftar.nama', 'like', '%'.$r->nama.'%');
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->jk) {
    				$query->where('pendaftar.jk', '=', $r->jk);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->telp) {
    				$query->where('pendaftar.telephone', 'like', '%'.$r->telp.'%');
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->email) {
    				$query->where('pendaftar.email', 'like', '%'.$r->email.'%');
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->kode_produk) {
    				$query->where('produk.kode_produk', '=', $r->kode_produk);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->tgl_dari) {
    				$query->where('produk.tanggal_keberangkatan', '>=', $r->tgl_dari);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->tgl_sampai) {
    				$query->where('produk.tanggal_keberangkatan', '<=', $r->tgl_sampai);
    			}
    		})
    		->where(function($query) use ($r){
    			if ($r->status) {
    				$query->where('peserta.status', '=', $r->status);
    			}
    		})
    		->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.status', 'produk.nama_produk', 'produk.tanggal_keberangkatan', 'embarkasi.kota as embarkasi', 'perusahaan.nama as nama_perusahaan')
    		->get();

    		return $data;
    	}
    }
}
