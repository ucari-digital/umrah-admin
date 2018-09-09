<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\AuthManager;
use App\Helper\Response;
class Embarkasi extends Model
{
    protected $table = 'embarkasi';

    public static function simpan($req)
    {
    	try {
	    	$table = new self;
	    	$table->prefix_embarkasi = strtoupper($req->prefix_embarkasi);
	    	$table->kode_embarkasi = strtoupper($req->embarkasi);
	    	$table->kota = $req->embarkasi;
	    	$table->status = 'Y';
	    	$table->created_by = AuthManager::users()->nama;
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
