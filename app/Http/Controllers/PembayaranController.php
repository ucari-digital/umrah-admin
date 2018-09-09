<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TransaksiPembayaran;
use DB;
class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaran = DB::table('transaksi_pembayaran')
        ->join('transaksi', 'transaksi_pembayaran.nomor_transaksi', 'transaksi.nomor_transaksi')
        ->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
        ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
        ->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
        ->join('bank', 'pendaftar.kode_bank', 'bank.kode_bank')
        ->where('transaksi_pembayaran.status', '!=', 'approved')
        ->select('pendaftar.nama', 'perusahaan.nama as nama_perusahaan', 'transaksi_pembayaran.nomor_pembayaran', 'transaksi_pembayaran.jenis_pembayaran', 'transaksi_pembayaran.bukti', 'transaksi_pembayaran.jumlah_pembayaran', 'transaksi_pembayaran.tgl_pembayaran', 'transaksi_pembayaran.status', 'bank.nama_bank')
        ->get();
        // return $pembayaran;
        return view('page.pembayaran.pembayaran')
        ->with('pembayaran', $pembayaran);
    }

    public function status($status, $nomor_pembayaran)
    {
        try {
            $transaksi = TransaksiPembayaran::where('nomor_pembayaran', $nomor_pembayaran)
            ->update([
                'status' => $status
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            
        }
    }
    
    /**
    * LAPORAN
    */
    public function laporan()
    {
        $pembayaran = DB::table('transaksi_pembayaran')
        ->join('transaksi', 'transaksi_pembayaran.nomor_transaksi', 'transaksi.nomor_transaksi')
        ->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
        ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
        ->where('transaksi_pembayaran.status', 'approved')
        ->select('pendaftar.nama', 'transaksi_pembayaran.nomor_pembayaran', 'transaksi_pembayaran.jenis_pembayaran', 'transaksi_pembayaran.jumlah_pembayaran')
        ->get();
        // return $pembayaran;
        return view('page.report-pembayaran.pembayaran')
        ->with('pembayaran', $pembayaran);
    }


}
