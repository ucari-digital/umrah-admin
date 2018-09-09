<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\AuthManager;
use App\Helper\Response;

class HistorySms extends Model
{
    protected $table = 'history_sms';

    public static function simpan($req)
    {
    	try {
    		$table = new self;
    		$table->nomor_peserta = $req['nomor_peserta'];
    		$table->number = $req['number'];
    		$table->text = $req['text'];
    		$table->url_referrer = $req['url_referrer'];
    		$table->sending_id = $req['sending_id'];
    		$table->sending_status = $req['sending_status'];
    		$table->cost = $req['cost'];
    		$table->sender_by = $req['sender_by'];
    		$table->sender_id = $req['sender_id'];
    		$table->save();

    		return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
    	} catch (\Exception $e) {
    		return 'error : '.$e->getMessage();
    	}
    }
}
