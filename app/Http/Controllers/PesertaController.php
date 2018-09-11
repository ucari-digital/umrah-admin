<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helper\Sms;
use App\Helper\Response;
use App\Helper\AuthManager;
use App\Model\Peserta;
use App\Model\Pendaftar;
use App\Model\Transaksi;
use App\Model\TransaksiDokumen;
use App\Model\TransaksiPembayaran;
use App\Model\TransaksiHotel;
use App\Model\TransaksiHotelMekkah;
use App\Model\DurasiHotel;
class PesertaController extends Controller
{
    public function index()
    {
    	$peserta = DB::table('pendaftar')
    	->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
    	->select('pendaftar.nip', 'pendaftar.nik', 'pendaftar.nama', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.email', 'peserta.nomor_peserta', 'peserta.status', 'pendaftar.created_at')
        ->orderBy('created_at', 'DESC')
    	->get();
    	return view('page.peserta.peserta')
    	->with('peserta', $peserta);
    }

    public function sendPin($nomor_peserta)
    {
        try {
            $data = DB::table('peserta')
            ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
            ->select('peserta.pin', 'peserta.nomor_peserta', 'pendaftar.telephone')
            ->first();
            $param = [];
            $param['number'] = $data->telephone;
            $param['text'] = 'Anda barusaja melupakan PIN '.$data->pin.' Mohon untuk mencatat atau menyimpannya dengan baik.';
            $param['nomor_peserta'] = $data->nomor_peserta;
            $sms = Sms::send($param);
            return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', 'PIN berhasil dikirim');
        } catch (\Exception $e) {
            return Response::json($e->getMessage(), 'Terjadi kesalahan', 'failed', 500);                
        }
    }

    public function status(Request $request, $status, $nomor_peserta)
    {
    	// try {
	    	$data = DB::table('peserta')
            ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
            ->select('peserta.id', 'peserta.nomor_peserta', 'peserta.pin', 'pendaftar.telephone')
            ->where('peserta.nomor_peserta', $nomor_peserta)
            ->first();

            if ($data) {
                $peserta = Peserta::find($data->id);
                $peserta->status = $status;
                $peserta->save();

                if ($peserta) {
                    $transaksi = Transaksi::where('nomor_peserta', $nomor_peserta)
                    ->where('status', 'approved')
                    ->update(['uang_muka' => str_replace(['.',',','Rp'],'', !empty($request->uang_muka) ? $request->uang_muka : 0)]);

                    /**
                    * Mengirimkan SMS
                    */
                    $param = [];
                    $param['number'] = $data->telephone;
                    $param['text'] = 'Akun Anda telah diverifikasi dengan ID Peserta '.substr($data->nomor_peserta, 5).' dan PIN : '.$data->pin;
                    $param['nomor_peserta'] = $data->nomor_peserta;
                    return $sms = Sms::send($param);
                    return redirect()
                    ->back()
                    ->with('status', 'success')
                    ->with('message', $sms['messages'][0]['status']['description']);
                }
                // return 'response peserta'; // menganalisa error
            }
            // return 'response data'; // menganalisa error
    	// } catch (\Exception $e) {
	    // 	return $e->getMessage();
    	// }
    }

    public function cekPeserta(Request $request)
    {
        try {
            $data = DB::table('pendaftar')
            ->join('peserta', 'pendaftar.nomor_pendaftar', 'peserta.nomor_pendaftar')
            ->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
            ->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
            ->join('embarkasi', 'produk.kode_embarkasi', 'embarkasi.kode_embarkasi')
            ->where('peserta.nomor_peserta', $request->nomor_peserta)
            ->select('peserta.nomor_peserta', 'pendaftar.nama', 'transaksi.nomor_transaksi', 'transaksi.kode_embarkasi', 'produk.nama_produk', 'produk.kode_produk', 'embarkasi.kota as embarkasi')
            ->first();
            return Response::json($data, 'Berhasil mengambil query', 'success', 200);
        } catch (\Exception $e) {
            return Response::json($e->getMessage(), 'Terjadi kesalahan', 'failed', 500);
        }
    }

    /**
    * INFORMASI PESERTA
    *
    * @return
    */

    public function indexInformasiPeserta()
    {
        $peserta = DB::table('peserta')
        ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
        ->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
        ->join('transaksi', 'peserta.nomor_peserta', 'transaksi.nomor_peserta')
        ->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
        ->select('pendaftar.nama', 'perusahaan.nama as nama_perusahaan', 'produk.tanggal_keberangkatan', 'transaksi.nomor_transaksi')
        ->orderBy('pendaftar.nama', 'ASC')
        ->get();
        // return $peserta;
        return view('page.peserta.informasi-peserta')
        ->with('peserta', $peserta);
    }

    public function indexInformasiPesertaDetail($nomor_transaksi)
    {
        $peserta = DB::table('transaksi')
        ->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
        ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
        ->join('perusahaan', 'pendaftar.kode_perusahaan', 'perusahaan.kode_perusahaan')
        ->where('transaksi.nomor_transaksi', $nomor_transaksi)
        ->select('pendaftar.nama', 'pendaftar.nik', 'pendaftar.nip', 'pendaftar.email', 'pendaftar.telephone', 'pendaftar.jk', 'perusahaan.nama as nama_perusahaan')
        ->first();

        $produk = DB::table('transaksi')
        ->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
        ->where('transaksi.nomor_transaksi', $nomor_transaksi)
        ->select('produk.nama_produk', 'produk.kode_embarkasi', 'produk.harga', 'produk.tanggal_keberangkatan', 'produk.tanggal_kepulangan')
        ->first();

        $hotel_madinah = DB::table('transaksi_hotel')
        ->join('dat_hotel_seat', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat.kode_kamar')
        ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
        ->where('transaksi_hotel.nomor_transaksi', $nomor_transaksi)
        ->select('dat_hotel.nama_hotel', 'dat_hotel.lokasi', 'dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.lantai')
        ->first();

        $hotel_mekkah = DB::table('transaksi_hotel_mekkah')
        ->join('dat_hotel_seat', 'transaksi_hotel_mekkah.kode_kamar', 'dat_hotel_seat.kode_kamar')
        ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
        ->where('transaksi_hotel_mekkah.nomor_transaksi', $nomor_transaksi)
        ->select('dat_hotel.nama_hotel', 'dat_hotel.lokasi', 'dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.lantai')
        ->first();

        $pesawat = DB::table('transaksi_pesawat')
        ->join('dat_pesawat_seat', 'transaksi_pesawat.kode_kursi', 'dat_pesawat_seat.kode_kursi')
        ->where('transaksi_pesawat.nomor_transaksi', $nomor_transaksi)
        ->select('dat_pesawat_seat.kursi')
        ->first();

        $dokumen = TransaksiDokumen::where('nomor_transaksi', $nomor_transaksi)->first();
        $pembayaran = TransaksiPembayaran::where('nomor_transaksi', $nomor_transaksi)->orderBy('created_at', 'DESC')->get();

        // return (array) $hotel_mekkah;

        return view('page.peserta.informasi-peserta-detail')
        ->with('peserta', $peserta)
        ->with('produk', $produk)
        ->with('hotel_madinah', $hotel_madinah)
        ->with('hotel_mekkah', $hotel_mekkah)
        ->with('pesawat', $pesawat)
        ->with('dokumen', $dokumen)
        ->with('pembayaran', $pembayaran);
    }

    public static function informasiPesertaDetailHelper($type, $nomor_transaksi)
    {
        if ($type == 'hotel-madinah') {
            $hotel = DB::table('transaksi_hotel')
            ->join('dat_hotel_seat', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat.kode_kamar')
            ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
            ->select('dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.lantai', 'dat_hotel.nama_hotel', 'dat_hotel.lokasi')
            ->where('transaksi_hotel.nomor_transaksi', $nomor_transaksi)
            ->first();

            return $hotel;
        }

        if ($type == 'hotel-mekkah') {
            $hotel = DB::table('transaksi_hotel_mekkah')
            ->join('dat_hotel_seat', 'transaksi_hotel_mekkah.kode_kamar', 'dat_hotel_seat.kode_kamar')
            ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
            ->select('dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.lantai', 'dat_hotel.nama_hotel', 'dat_hotel.lokasi')
            ->where('transaksi_hotel_mekkah.nomor_transaksi', $nomor_transaksi)
            ->first();

            return $hotel;
        }
    }

    /**
    * Data Jamaah Hotel
    */

    public function indexHotelPeserta(Request $request)
    {
        /**
        * Hotel dengan distinc untuk menampilkan room hotel yang telah di pilih oleh jamaah
        */
        $hotel = DB::table('transaksi')
        ->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
        ->join('transaksi_hotel_mekkah', 'transaksi.nomor_transaksi', 'transaksi_hotel_mekkah.nomor_transaksi')
        ->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
        ->join('dat_hotel_seat', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat.kode_kamar')
        ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
        ->where('transaksi_hotel.status', 'approved')
        ->select('transaksi_hotel.kode_kamar', 'transaksi_hotel.check_status', 'transaksi_hotel.kode_kamar as kode_kamar_madinah', 'transaksi_hotel_mekkah.kode_kamar as kode_kamar_mekkah', 'produk.kode_produk', 'produk.durasi_hotel_madinah', 'produk.durasi_hotel_mekkah', 'dat_hotel.nama_hotel', 'dat_hotel.lokasi', 'dat_hotel_seat.lantai', 'dat_hotel_seat.nomor_kamar')
        ->distinct()
        ->get();

        return view('page.peserta.hotel-peserta')
        ->with('hotel', $hotel);
    }

    public function detailHotelPeserta($kode_produk, $kode_kamar_madinah, $kode_kamar_mekkah)
    {
        $jamaah_hotel = DB::table('transaksi')
        ->join('peserta', 'transaksi.nomor_peserta', 'peserta.nomor_peserta')
        ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
        ->join('transaksi_hotel', 'transaksi.nomor_transaksi', 'transaksi_hotel.nomor_transaksi')
        ->join('transaksi_hotel_mekkah', 'transaksi.nomor_transaksi', 'transaksi_hotel_mekkah.nomor_transaksi')
        ->join('dat_hotel_seat', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat.kode_kamar')
        ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
        ->where('transaksi_hotel.kode_produk', $kode_produk)
        ->where('transaksi_hotel.kode_kamar', $kode_kamar_madinah)
        ->where('transaksi_hotel_mekkah.kode_kamar', $kode_kamar_mekkah)
        ->where('transaksi_hotel.status', 'approved')
        ->select('pendaftar.nama', 'pendaftar.nip', 'pendaftar.nik', 'pendaftar.jk', 'pendaftar.telephone', 'pendaftar.hubungan_keluarga', 'dat_hotel.lokasi', 'transaksi_hotel.nomor_transaksi', 'transaksi_hotel.check_status', 'transaksi_hotel.kode_produk', 'transaksi_hotel.kode_kamar as kode_kamar_madinah', 'transaksi_hotel_mekkah.kode_kamar as kode_kamar_mekkah')
        ->get();

        // return $jamaah_hotel;
        return view('page.peserta.hotel-peserta-detail')
        ->with('jamaah_hotel', $jamaah_hotel);
    }

    public function hapusHotelPeserta($lokasi, $nomor_transaksi)
    {
        if ($lokasi == 'madinah') {
            $peserta = TransaksiHotel::where('nomor_transaksi', $nomor_transaksi)->delete();
            if ($peserta) {
                $durasi_hotel = DurasiHotel::where('nomor_transaksi', $nomor_transaksi)
                ->where('kode_kamar', $peserta->kode_kamar)
                ->where('lokasi', $lokasi)
                ->delete();
            }
        }

        if ($lokasi == 'mekkah') {
            $peserta = TransaksiHotelMekkah::where('nomor_transaksi', $nomor_transaksi)->delete();
            if ($peserta) {
                $durasi_hotel = DurasiHotel::where('nomor_transaksi', $nomor_transaksi)
                ->where('kode_kamar', $peserta->kode_kamar)
                ->where('lokasi', $lokasi)
                ->delete();
            }
        }
    }

    public function checkHotelPeserta($kode_produk, $lokasi, $kode_kamar_madinah, $kode_kamar_mekkah)
    {
        /**
        * mengubah status menjadi check
        */

        if ($lokasi == 'madinah') {
            $madinah = TransaksiHotel::where('kode_produk', $kode_produk)
            ->where('kode_kamar', $kode_kamar_madinah)
            ->update([
                'check_status' => true
            ]);

            $mekkah = TransaksiHotelMekkah::where('kode_produk', $kode_produk)
            ->where('kode_kamar', $kode_kamar_mekkah)
            ->update([
                'check_status' => true
            ]);

            if ($madinah > 0 && $mekkah > 0) {
                return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Data peserta berhasil di approve');
            } else {
                return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', 'Data peserta gagal untuk di approved');
            }
        }

    }

    public function hapusPeserta($id)
    {
        $pendaftar = DB::table('pendaftar')
        ->join('peserta', 'pendaftar.nomor_pendaftar', '=', 'peserta.nomor_pendaftar')
        ->select('peserta.status', 'pendaftar.nomor_pendaftar')
        ->where('peserta.status', '=', 'pending')
        ->where('peserta.nomor_peserta', $id)
        ->first();

        if ($pendaftar) {
            Pendaftar::where('nomor_pendaftar', $pendaftar->nomor_pendaftar)->delete();
            Peserta::where('nomor_pendaftar', $pendaftar->nomor_pendaftar)->delete();
            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Data peserta berhasil dihapus');
        } else {
            return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', 'Data peserta gagal dihapus');
        }
    }
}
