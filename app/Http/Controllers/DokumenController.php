<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Helper\AuthManager;
use App\Helper\Number;
use App\Model\TransaksiDokumen;
use App\Http\Controllers\SMSController as Sms;
class DokumenController extends Controller
{
    public function index()
    {
    	$dokumen = DB::table('transaksi_dokumen')
    	->join('transaksi', 'transaksi_dokumen.nomor_transaksi', 'transaksi.nomor_transaksi')
    	->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
    	->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
    	->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
    	->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
    	->select('transaksi_dokumen.*', 'pendaftar.nama', 'perusahaan.nama as nama_perusahaan', 'produk.tanggal_keberangkatan', 'transaksi.nomor_transaksi')
    	->get();

    	return view('page.dokumen.dokumen')
    	->with('dokumen', $dokumen);
    }

    public function detail($nomor_transaksi)
    {
    	try {
    		$dokumen = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)->first();
            // $dokumen = DB::table('transaksi_dokumen')
            // ->join
	    	return view('page.dokumen.dokumen-detail')
	    	->with('dokumen', $dokumen);
    	} catch (\Exception $e) {
    		
    	}
    	
    }

    public function status($field, $status, $nomor_transaksi)
    {
        try {
        	$transaksi_dokumen = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)
        	->update([
        		$field => $status,
        		'created_by' => AuthManager::users()->user_id
        	]);

            /**
            * Otomatis kirim sms dp
            */

            $dokumen_lengkap = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)
            ->where([
                ['passpor_status', '=', 'approved'],
                ['foto_status', '=', 'approved'],
                ['kartu_keluarga_status', '=', 'approved'],
                ['kartu_kuning_status', '=', 'approved'],
                ['kartu_karyawan_status', '=', 'approved']
            ])
            ->first();
            if (!$dokumen_lengkap) {
                return redirect()->back();
            }

            $peserta = DB::table('transaksi')
            ->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
            ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
            ->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
            ->where('transaksi.nomor_transaksi', $nomor_transaksi)
            ->select('peserta.nomor_peserta', 'pendaftar.nama', 'pendaftar.telephone', 'transaksi.uang_muka', 'perusahaan.nama as nama_perusahaan')
            ->first();

            // Jika DP != 0
            if ($peserta->uang_muka) {
                // Set masa berakhir
                $date = Carbon::today();
                $masa_tenggang = $date->addDays(3);

                // Set nama depan
                $nama = explode(' ',trim($peserta->nama));

                $param['nomor_peserta'] = $peserta->nomor_peserta;
                $param['number'] = $peserta->telephone;
                $param['text'] = $peserta->nama_perusahaan.' - Hai '.$nama[0].'. Silahkan untuk melakukan pembayaran DP sebesar '.Number::rupiah($peserta->uang_muka).' sebelum tgl '.$masa_tenggang->format('d-m-Y').'. Detail ucari.id/pembayaran';
                // Kirim SMS
                $sms = Sms::send($param);
                if (isset($sms['status'])) {
                    return redirect()
                    ->back()
                    ->with('status', 'success')
                    ->with('message', 'Dokumen berhasil di approve');
                }
            } else {
                return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Dokumen berhasil di approve');
            }
        	
        } catch (\Exception $e) {
            return redirect()
            ->back()
            ->with('status', 'failed')
            ->with('message', $e->getMessage());
        }
    }
}
