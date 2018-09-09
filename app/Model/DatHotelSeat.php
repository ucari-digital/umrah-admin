<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Response;

class DatHotelSeat extends Model
{
    protected $table = 'dat_hotel_seat';

    public static function simpan($req)
    {
    	try {
	    	$table = new self;
	    	$table->kode_kamar = 'ROOM'.$req['kode_hotel'].$req['lantai'].$req['nomor_kamar'];
	    	$table->kode_hotel = $req['kode_hotel'];
	    	$table->nomor_kamar = $req['nomor_kamar'];
	    	$table->lantai = $req['lantai'];
	    	$table->tipe_kamar = '4';
	    	$table->created_by = 'SYSTEM';
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();  		
    	}
    }
}
