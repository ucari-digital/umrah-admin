<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Model\Produk;
use App\Helper\Response;
use App\Helper\AuthManager;
class Transaksi extends Model
{
    protected $table = 'transaksi';

    public static function simpan($req)
    {
    	try {
    		$tgl_sekarang = Carbon::now()->toDateString();

    		// PRODUK
    		$produk = Produk::where('kode_produk', $req->kode_produk)->first();

	    	$table = new self;
	    	$table->nomor_transaksi = 'TRUMH'.random_int(10000,99999).str_replace('-','',$tgl_sekarang);
	    	$table->nomor_peserta = 'FKT'.random_int(10000,99999);
	    	$table->kode_produk = $req->kode_produk;
	    	$table->kode_embarkasi = $req->embarkasi;
	    	$table->total_harga = $produk->harga;
	    	$table->status = 'fiktif';
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
