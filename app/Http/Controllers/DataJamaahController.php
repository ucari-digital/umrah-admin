<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Produk;
use App\Model\Transaksi;
/**
* Data Jamaah adalah data peserta final
*/
class DataJamaahController extends Controller
{
	public function index()
	{
		$produk = Produk::orderBy('created_at', 'desc')->get();
		return view('page.report-data-jamaah.data-jamaah')
		->with('produk', $produk);
	}

	public function detailPerusahaan($kode_produk)
	{
		$perusahaan = DB::table('produk')
		->join('transaksi', 'produk.kode_produk', 'transaksi.kode_produk')
		->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
		->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
		->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
		->where('transaksi.kode_produk', $kode_produk)
		->select('perusahaan.nama', 'perusahaan.kode_perusahaan', 'transaksi.kode_produk')
		->distinct()
		->get();
		
		return view('page.report-data-jamaah.data-jamaah-perusahaan')
		->with('perusahaan', $perusahaan);
	}

	public function detailPeserta($kode_produk, $kode_perusahaan)
	{
		$data = DB::table('perusahaan')
		->join('pendaftar', 'perusahaan.kode_perusahaan', 'pendaftar.kode_perusahaan')
		->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
		->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
		->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
		->join('transaksi_hotel_mekkah', 'transaksi.nomor_transaksi', 'transaksi_hotel_mekkah.nomor_transaksi')
		->join('transaksi_dokumen', 'transaksi.nomor_transaksi', 'transaksi_dokumen.nomor_transaksi')
		->join('transaksi_pembayaran', 'transaksi.nomor_transaksi', 'transaksi_pembayaran.nomor_transaksi')
		->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
		->join('travel', 'pendaftar.kode_travel', 'travel.kode_travel')
		->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
		->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
		->where('peserta.status', 'approved')
		->where([['transaksi_pembayaran.status', '=', 'approved'], ['transaksi_pembayaran.jenis_pembayaran', '=', 'pelunasan']])
		->where('transaksi_dokumen.foto_status', 'approved')
		->where('transaksi_dokumen.passpor_status', 'approved')
		->where('transaksi_dokumen.kartu_keluarga_status', 'approved')
		->where('transaksi_dokumen.kartu_karyawan_status', 'approved')
		->where('transaksi_dokumen.kartu_kuning_status', 'approved')
		->where('pendaftar.kode_perusahaan', $kode_perusahaan)
		->where('transaksi.kode_produk', $kode_produk)

		->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'transaksi.nomor_transaksi', 'travel.nama_travel', 'embarkasi.kota as embarkasi')
		->distinct()
		->get();

		// return $data;
		return view('page.report-data-jamaah.data-jamaah-perusahaan-detail')
		->with('peserta', $data);
	}

	/**
    * Helper
    */

    public static function produkPerusahaan($kode_produk)
    {
    	$peserta = DB::table('transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
    	->where('transaksi.kode_produk', $kode_produk)
    	->select('pendaftar.kode_perusahaan')
    	->distinct()
    	->get();
    	return count($peserta);
    }

    public static function pesertaPerusahaan($kode_perusahaan, $kode_produk)
    {
    	$data = DB::table('perusahaan')
		->join('pendaftar', 'perusahaan.kode_perusahaan', 'pendaftar.kode_perusahaan')
		->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
		->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
		->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
		->join('transaksi_hotel_mekkah', 'transaksi.nomor_transaksi', 'transaksi_hotel_mekkah.nomor_transaksi')
		->join('transaksi_dokumen', 'transaksi.nomor_transaksi', 'transaksi_dokumen.nomor_transaksi')
		->join('transaksi_pembayaran', 'transaksi.nomor_transaksi', 'transaksi_pembayaran.nomor_transaksi')
		->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
		->where('peserta.status', 'approved')
		->where([['transaksi_pembayaran.status', '=', 'approved'], ['transaksi_pembayaran.jenis_pembayaran', '=', 'pelunasan']])
		->where('transaksi_dokumen.foto_status', 'approved')
		->where('transaksi_dokumen.passpor_status', 'approved')
		->where('transaksi_dokumen.kartu_keluarga_status', 'approved')
		->where('transaksi_dokumen.kartu_karyawan_status', 'approved')
		->where('transaksi_dokumen.kartu_kuning_status', 'approved')
		->where('pendaftar.kode_perusahaan', $kode_perusahaan)
		->where('transaksi.kode_produk', $kode_produk)

		->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'transaksi.nomor_transaksi')
		->distinct()
		->get();

		return count($data);
    }
}
