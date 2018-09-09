<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Sms;
use App\Model\HistorySms;
use App\Helper\AuthManager;
use App\Helper\Response;
class SMSController extends Controller
{
	public function index()
	{
		$saldo = Sms::saldo();
		$history = Sms::historySms();
		return view('page.sms.sms', ['saldo' => $saldo, 'history' => $history]);
	}

	public static function send($data)
	{
		try {

			/**
			* Data untuk kirim sms
			* - Nomor peserta
			* @return Array
			*/

			$sms = Sms::send($data);
			if ($sms['status'] == 402) {
				return Response::json('', $sms['msg'], 'failed', $sms['status']);
			}

			$data['url_referrer'] = url()->full();
            $data['sender_id'] = AuthManager::users()->user_id;
            $data['sender_by'] = AuthManager::users()->nama;
            $data['sending_id'] = $sms['data']['sending_id'];
            $data['sending_status'] = $sms['data']['status'];
            $data['cost'] = $sms['data']['harga'];

			$history = HistorySms::simpan($data);

			return Response::json($history['data'], $history['msg'], $history['response'], $history['status']);
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

    public function testing()
    {
    	$data = [];
    	$data['number'] = '628159510969';
    	$data['text'] = 'Pesan text for testing api ucari.id/pembayaran';

    	return Sms::send($data);
    }

}
