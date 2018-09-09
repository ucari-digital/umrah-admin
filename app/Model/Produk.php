<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Response;
use App\Helper\TimeFormat;
use Carbon\Carbon;
use App\Model\Embarkasi;
class Produk extends Model
{
    protected $table = 'produk';

    public static function simpan($req)
    {
    	try {

    		$embarkasi = Embarkasi::where('kode_embarkasi', $req->kode_embarkasi)->first();

    		$carbon = TimeFormat::formatCarbon($req->tanggal_keberangkatan, 'sys');
    		$tanggal_keberangkatan = substr(Carbon::create($carbon->tahun, $carbon->bulan, $carbon->tanggal, 0, 0, 0), 0, 10);

	    	$table = new self;
	    	$table->kode_produk = 'U'.$embarkasi->prefix_embarkasi.rand(100,999);
	    	$table->nama_produk = 'Umrah - '.TimeFormat::timeId($tanggal_keberangkatan);
	    	$table->kode_embarkasi = $req->kode_embarkasi;
	    	$table->tanggal_keberangkatan = $tanggal_keberangkatan;
	    	$table->tanggal_kepulangan = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal_keberangkatan.' 00:00:00')->addDays(11);
	    	$table->durasi_hotel_madinah = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal_keberangkatan.' 00:00:00')->addDays(2);
	    	$table->durasi_hotel_mekkah = Carbon::createFromFormat('Y-m-d H:i:s', $tanggal_keberangkatan.' 00:00:00')->addDays(4);
	    	$table->harga = str_replace(['.',',','Rp'],'',$req->harga);
	    	$table->seat = $req->seat;
	    	$table->status = $req->status;
	    	$table->save();

	    	return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
			return 'error : '.$e->getMessage();    		
    	}
    }
}