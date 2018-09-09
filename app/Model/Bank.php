<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Helper\Response;
use App\Helper\AuthManager;
class Bank extends Model
{
	protected $table = 'bank';

    public static function simpan($req)
    {
    	try {
    		$table = new self;
	    	$table->kode_bank = $req->kode_bank;
	    	$table->nama_bank = $req->nama_bank;
	    	$table->no_rek = $req->no_rek;
	    	$table->status = true;
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();
    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }

    public static function drop($kode_bank)
    {
    	try {
    		$table = self::where('kode_bank', $kode_bank)->update([
    			'status' => 'false'
    		]);
    		return Response::json($table, 'Berhasil drop data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }
}
