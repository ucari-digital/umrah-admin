<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Helper\AuthManager;
use App\Helper\Response;
class TransaksiPesawat extends Model
{
    protected $table = 'transaksi_pesawat';

    public static function simpan($req, $nomor_transaksi)
    {
    	try {
    		$tgl_sekarang = Carbon::now()->toDateString();

    		// PRODUK
    		$produk = Produk::where('kode_produk', $req->kode_produk)->first();

	    	$table = new self;
	    	$table->nomor_transaksi = $nomor_transaksi;
	    	$table->kode_kursi = $req->seat;
	    	$table->status = 'fiktif';
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
