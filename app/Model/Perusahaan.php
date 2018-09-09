<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\AuthManager;
use App\Helper\Response;
class Perusahaan extends Model
{
    protected $table = 'perusahaan';

    public static function simpan($req)
    {
    	try {
	    	$table = new self;
	    	$table->kode_perusahaan = $req->kode_perusahaan;
	    	$table->nama = $req->nama_perusahaan;
	    	$table->domain = $req->domain;
	    	$table->email = $req->email;
	    	$table->telephone = $req->telepon;
	    	$table->website =$req->website;
	    	$table->alamat = $req->alamat;
	    	$table->logo = $req->src_logo;
	    	$table->slogan = $req->src_tagline;
	    	$table->created_by = AuthManager::users()->user_id;
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
