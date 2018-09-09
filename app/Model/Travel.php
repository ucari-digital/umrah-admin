<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Helper\Response;
use App\Helper\AuthManager;
class Travel extends Model
{
    protected $table = 'travel';

    public static function simpan($req)
    {
    	try {
    		$table = new self;
	    	$table->nama_travel = $req->nama;
	    	$table->kode_travel = $req->kode_travel;
	    	$table->logo_travel = $req->logo_travel;
	    	$table->website = $req->website;
	    	$table->status = true;
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();
    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }

    public static function drop($kode_travel)
    {
    	try {
    		$table = self::where('kode_travel', $kode_travel)->update([
    			'status' => 'false'
    		]);
    		return Response::json($table, 'Berhasil drop data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }
}
