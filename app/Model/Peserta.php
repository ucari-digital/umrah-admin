<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Response;
use App\Http\Controllers\SettingController;
class Peserta extends Model
{
    protected $table = 'peserta';

    public static function simpan($req)
    {
    	try {
    		$setting = new SettingController;

			$table = new self;
			$table->nomor_peserta = '';
			$table->nomor_pendaftar = $req['nomor_pendaftar'];
			$table->pin = rand(1000,9999);
			$table->status = 'approved';
			$table->save();

			return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
		} catch (\Exception $e) {
			return 'error : '.$e->getMessage();
		}
    }
}
