<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Response;
use Hash;
class Pendaftar extends Model
{
    protected $table = 'pendaftar';

    public static function simpan($req)
    {
    	try {
    		$table = new self;
    		$table->nomor_pendaftar = random_int(100000000,999999999);
    		$table->nama = $req['nama'];
    		$table->kode_perusahaan = $req['kode_perusahaan'];
    		$table->email = $req['email'];
    		$table->telephone = $req['telephone'];
    		$table->password = Hash::make($req['password']);
    		$table->jk = $req['jk'];
    		$table->nip = $req['nip'];
    		$table->nik = $req['nik'];
    		$table->kode_bank = $req['kode_bank'];
    		$table->kode_travel = $req['kode_travel'];
    		$table->status = 'approved';
    		$table->hubungan_keluarga = $req['hubungan_keluarga'];
    		$table->save();

    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }
}
