<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Response;
class DatPesawatSeat extends Model
{
    protected $table = 'dat_pesawat_seat';

    public static function simpan($kode_pesawat, $seat)
    {
    	try {
	    	$table = new self;
	    	$table->kode_pesawat = $kode_pesawat;
	    	$table->kode_kursi = $kode_pesawat.$seat;
	    	$table->kursi = $seat;
	    	$table->created_by = 'SYSTEM';
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}
