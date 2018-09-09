<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TransaksiHotel;
use App\Model\TransaksiHotelMekkah;
use DB;
class NotificationController extends Controller
{
    public static function notification()
    {
    	$hotel = self::notificationHotel();
    	return [
    		'counter' => $hotel['counter'],
    		'data' => [
    			'hotel' => $hotel
    		]
    	];
    }

    public static function notificationHotel()
    {
    	$hotel = TransaksiHotelMekkah::where('check_status', 'false')
        ->select('kode_kamar')
        ->distinct()
        ->get();

    	return [
    		'counter' => count($hotel),
    		'text' => 'Hotel belum diverifikasi',
    		'keterangan' => 'Varifikasi untuk menentukan',
    		'url' => 'hotel-peserta'
    	];
    }
}
