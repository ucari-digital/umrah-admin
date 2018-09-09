<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\AuthManager;
use App\Helper\Response;
class TransaksiHotel extends Model
{
    protected $table = 'transaksi_hotel';

    public static function simpan($req)
    {
    	try{
	    	$table = new self;
	    	$table->nomor_transaksi = $req['nomor_transaksi'];
	    	$table->kode_produk = $req['kode_produk'];
	    	$table->kode_kamar = $req['kode_kamar'];
	    	$table->status = 'approved';
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();
    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }

    public static function fiktif($req)
    {
    	try{
	    	$table = new self;
	    	$table->nomor_transaksi = $req->nomor_transaksi;
	    	$table->kode_produk = $req->kode_produk;
	    	$table->kode_kamar = $req->room;
	    	$table->status = 'fiktif';
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();
    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
