<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Helper\Response;
class DurasiHotel extends Model
{
    protected $table = 'durasi_hotel';

    public static function simpan($req)
    {
    	// try {
            
    		$durasi = DB::table('transaksi')
            ->join('produk', 'transaksi.kode_produk', 'produk.kode_produk')
            ->select('transaksi.nomor_transaksi', 'produk.kode_produk', 'produk.durasi_hotel_madinah', 'produk.durasi_hotel_mekkah')
            ->where('transaksi.nomor_transaksi', $req->nomor_transaksi)
            ->first();
    		if($req->lokasi == 'madinah'){
                for ($i=0; $i <= 1; $i++) { 
                    $table = new self;
                    $table->nomor_transaksi = $durasi->nomor_transaksi;
                    $table->kode_produk = $durasi->kode_produk;
                    $table->kode_kamar = $req->room;
                    $table->lokasi = 'madinah';
                    $table->tanggal = Carbon::createFromFormat('Y-m-d H:i:s', $durasi->durasi_hotel_madinah.' 00:00:00')->addDays($i);
                    $table->save();
                }
            }
            
            if($req->lokasi == 'mekkah'){
                for ($i=0; $i <= 4; $i++) { 
                    $table = new self;
                    $table->nomor_transaksi = $durasi->nomor_transaksi;
                    $table->kode_produk = $durasi->kode_produk;
                    $table->kode_kamar = $req->room;
                    $table->lokasi = 'mekkah';
                    $table->tanggal = Carbon::createFromFormat('Y-m-d H:i:s', $durasi->durasi_hotel_mekkah.' 00:00:00')->addDays($i);
                    $table->save();
                }
            }

    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	// } catch (\Exception $e) {
    	// 	return 'error : '.$e->getMessage();
    	// }
    }
}
