<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


use App\Model\Produk;
use App\Model\Transaksi;
use App\Model\TransaksiHotel;
use App\Model\TransaksiHotelMekkah;
use App\Model\DurasiHotel;
class HotelAutomationController extends Controller
{
    public static function run()
    {
    	// try {
    	/**
    	 * Set Variable
    	 */

    	$time = Carbon::now('Asia/Jakarta');
    	// $time = Carbon::create(2018, 07, 03, 0);
    	$time->addDays(10);
    	$time_format = $time->format('Y-m-d');
    	
    	$autoRunMadinah = self::runMadinah($time_format);
    	$autoRunMekkah = self::runMekkah($time_format);

    	return ['status' => 200, 'madinah' => $autoRunMadinah, 'mekkah' => $autoRunMekkah];
    	// } catch (\Exception $e) {
    	// 	return 'Error '.$e->getMessage();
    	// }
    	
    }

    public static function runMadinah($time_format)
    {
        $var_madinah_counter_dump = [];
    	$madinah_counter_l = 0;
        $var_madinah_counter_l = 0;

        $madinah_counter_p = 0;
    	$var_madinah_counter_p = 0;
    	
    	$returning = [];

    	// mengambil data produk
    	$produk = Produk::where('tanggal_keberangkatan', $time_format)->get();

    	if (collect($produk)->isEmpty()) {
    		return "tidak ada pemberangkatan";
    	}

    	// Mengambil data transaksi peserta sesuai dengan produk dan push ke @var peserta_produk
    	foreach ($produk as $item) {
    		$transaksi = Transaksi::where('kode_produk', $item->kode_produk)->get();
    		$peserta_produk[] = $transaksi;
    	}
    	$peserta = array_collapse($peserta_produk);

    	/*=====================================
    	=            HoTEL MADINAH            =
    	=====================================*/
    	
    	// Memfilter user transaksi hotel madinah untuk menampilkan peserta laki laki dan perempuan

    	foreach ($peserta as $item) {

    		$hotel_madinah = TransaksiHotel::where('nomor_transaksi', $item->nomor_transaksi)->first();
    		$info_peserta = DB::table('peserta')
            ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
            ->where('peserta.nomor_peserta', $item->nomor_peserta)
            ->select('pendaftar.jk')
            ->first();

    		if (!$hotel_madinah) {
                if ($info_peserta->jk == 'L') {
        			$peserta_madinah = [
        				'nomor_transaksi' => $item->nomor_transaksi,
        				'nomor_peserta' => $item->nomor_peserta,
        				'kode_produk' => $item->kode_produk,
                        'jk' => $info_peserta->jk
    				];
    				$peserta_hotel_madinah_l[] = $peserta_madinah;
                }
                if ($info_peserta->jk == 'P') {
                    $peserta_madinah = [
                        'nomor_transaksi' => $item->nomor_transaksi,
                        'nomor_peserta' => $item->nomor_peserta,
                        'kode_produk' => $item->kode_produk,
                        'jk' => $info_peserta->jk
                    ];
                    $peserta_hotel_madinah_p[] = $peserta_madinah;
                }
    			
    		}
    	}
        $peserta_hotel_madinah_array = [
            'l' => $peserta_hotel_madinah_l,
            'p' => $peserta_hotel_madinah_p
        ];

        $peserta_hotel_madinah = array_collapse($peserta_hotel_madinah_array);

        // return $peserta_hotel_madinah;

    	// Get Availabel Hotel

    	$all_hotel = DB::table('dat_hotel')
    	->join('dat_hotel_seat', 'dat_hotel.kode_hotel', 'dat_hotel_seat.kode_hotel')
    	->where('dat_hotel.lokasi', 'madinah')
    	->select('dat_hotel_seat.kode_kamar')
        ->take(400)
    	->get();

    	// Loop 1 kali untuk penambahan hari di madinah
    	for ($i=0; $i <= 1; $i++) {
    		// membuat tanggal madinah dari tanggal keberangkatan
    		$tgl_madinah = Carbon::createFromFormat('Y-m-d H:i:s', $time_format.' 00:00:00')->addDays(2);
    		$date = Carbon::createFromFormat('Y-m-d H:i:s', $tgl_madinah)->addDays($i);

    		// mengecek hotel dan tanggal keberangakatan yang availabel dengan parameter kode kamar dan tanggal
	    	foreach ($all_hotel as $item) {
	    		$durasi_hotel = DurasiHotel::where('kode_kamar', $item->kode_kamar)
	    		->where('tanggal', $date->format('Y-m-d'))
	    		->first();
	    		
	    		if (!$durasi_hotel) {
	    			$filter_hotel = DB::table('dat_hotel')
			    	->join('dat_hotel_seat', 'dat_hotel.kode_hotel', 'dat_hotel_seat.kode_hotel')
			    	->where('dat_hotel.lokasi', 'madinah')
			    	->where('kode_kamar', $item->kode_kamar)
			    	->select('dat_hotel_seat.kode_kamar')
			    	->first();
			    	$hotel_madinah_availabel[] = $filter_hotel;
	    		}
	    	}
    	}

    	$array_pluck = array_pluck($hotel_madinah_availabel, 'kode_kamar');
    	$array_unique = array_unique($array_pluck);


        // Insert transaksi ke table
    	foreach ($peserta_hotel_madinah as $item) {
            if ($item['jk'] == 'L') {
                $var_madinah_counter_dump[] = $var_madinah_counter_l;
                $madinah_counter_l += 1;

                // Insert Transaksi
                $req['nomor_transaksi'] = $item['nomor_transaksi'];
                $req['kode_produk'] = $item['kode_produk'];
                $req['kode_kamar'] = $array_unique[$var_madinah_counter_l];
                $transaksi_hotel = TransaksiHotel::simpan($req);

                // Insert DurasiHotel
                $req['lokasi'] = 'madinah';
                $req['room'] = $array_unique[$var_madinah_counter_l];
                $durasi_hotel = DurasiHotel::simpan( (object) $req);

                $returning[] = ['transaksi_hotel' => $transaksi_hotel, 'durasi_hotel' => $durasi_hotel];
                if ($madinah_counter_l == 4) {
                    $var_madinah_counter_l += 1;
                    $var_madinah_counter_p = $var_madinah_counter_l + 1;
                    $madinah_counter_l = 0;
                }
            }

            if ($item['jk'] == 'P') {
    		  $madinah_counter_p += 1;

                // Insert Transaksi
                $req['nomor_transaksi'] = $item['nomor_transaksi'];
                $req['kode_produk'] = $item['kode_produk'];
                $req['kode_kamar'] = $array_unique[$var_madinah_counter_p];
                $transaksi_hotel = TransaksiHotel::simpan($req);

                // Insert DurasiHotel
                $req['lokasi'] = 'madinah';
                $req['room'] = $array_unique[$var_madinah_counter_p];
                $durasi_hotel = DurasiHotel::simpan( (object) $req);

                $returning[] = ['transaksi_hotel' => $transaksi_hotel, 'durasi_hotel' => $durasi_hotel];
                if ($madinah_counter_p == 4) {
                    $var_madinah_counter_p += 1;
                    $madinah_counter_p = 0;
                }
            }
    		
    	}
    	
    	// return ['L' => $var_madinah_counter_l, 'P' => $var_madinah_counter_p];
    	return $returning;
    	/*=====  End of HoTEL MADINAH  ======*/
    }

    public static function runMekkah($time_format)
    {
    	$mekkah_counter_l = 0;
        $var_mekkah_counter_l = 0;

        $mekkah_counter_p = 0;
    	$var_mekkah_counter_p = 0;
    	
    	$peserta_hotel_mekkah = [];
    	$returning = [];

    	// mengambil data produk
    	$produk = Produk::where('tanggal_keberangkatan', $time_format)->get();

    	if (collect($produk)->isEmpty()) {
    		return "tidak ada pemberangkatan";
    	}

    	// Mengambil data transaksi peserta sesuai dengan produk dan push ke @var peserta_produk
    	foreach ($produk as $item) {
    		$transaksi = Transaksi::where('kode_produk', $item->kode_produk)->get();
    		$peserta_produk[] = $transaksi;
    	}
    	$peserta = array_collapse($peserta_produk);

    	/*=====================================
    	=            HoTEL MEKKAH             =
    	=====================================*/
    	
    	// Memfilter user transaksi hotel mekkah

    	foreach ($peserta as $item) {

    		$hotel_mekkah = TransaksiHotelMekkah::where('nomor_transaksi', $item->nomor_transaksi)->first();
    		$info_peserta = DB::table('peserta')
            ->join('pendaftar', 'peserta.nomor_pendaftar', 'pendaftar.nomor_pendaftar')
            ->where('peserta.nomor_peserta', $item->nomor_peserta)
            ->select('pendaftar.jk')
            ->first();

    		if (!$hotel_mekkah) {
                if ($info_peserta->jk == 'L') {
                    $peserta_mekkah = [
                        'nomor_transaksi' => $item->nomor_transaksi,
                        'nomor_peserta' => $item->nomor_peserta,
                        'kode_produk' => $item->kode_produk,
                        'jk' => $info_peserta->jk
                    ];
                    $peserta_hotel_mekkah_l[] = $peserta_mekkah;
                }
                if ($info_peserta->jk == 'P') {
                    $peserta_mekkah = [
                        'nomor_transaksi' => $item->nomor_transaksi,
                        'nomor_peserta' => $item->nomor_peserta,
                        'kode_produk' => $item->kode_produk,
                        'jk' => $info_peserta->jk
                    ];
                    $peserta_hotel_mekkah_p[] = $peserta_mekkah;
                }
                
            }
        }

        $peserta_hotel_mekkah_array = [
            'l' => $peserta_hotel_mekkah_l,
            'p' => $peserta_hotel_mekkah_p
        ];

        $peserta_hotel_mekkah = array_collapse($peserta_hotel_mekkah_array);
        
        // return $peserta_hotel_mekkah;

    	// Get Availabel Hotel

    	$all_hotel = DB::table('dat_hotel')
    	->join('dat_hotel_seat', 'dat_hotel.kode_hotel', 'dat_hotel_seat.kode_hotel')
    	->where('dat_hotel.lokasi', 'mekkah')
    	->select('dat_hotel_seat.kode_kamar')
        ->take(400)
    	->get();

    	// Loop 1 kali untuk penambahan hari di mekkah
    	for ($i=0; $i <= 4; $i++) {
    		// membuat tanggal mekkah dari tanggal keberangkatan
    		$tgl_mekkah = Carbon::createFromFormat('Y-m-d H:i:s', $time_format.' 00:00:00')->addDays(4);
    		$date = Carbon::createFromFormat('Y-m-d H:i:s', $tgl_mekkah)->addDays($i);

    		// mengecek hotel dan tanggal keberangakatan yang availabel dengan parameter kode kamar dan tanggal
	    	foreach ($all_hotel as $item) {
	    		$durasi_hotel = DurasiHotel::where('kode_kamar', $item->kode_kamar)
	    		->where('tanggal', $date->format('Y-m-d'))
	    		->first();
	    		
	    		if (!$durasi_hotel) {
	    			$filter_hotel = DB::table('dat_hotel')
			    	->join('dat_hotel_seat', 'dat_hotel.kode_hotel', 'dat_hotel_seat.kode_hotel')
			    	->where('dat_hotel.lokasi', 'mekkah')
			    	->where('kode_kamar', $item->kode_kamar)
			    	->select('dat_hotel_seat.kode_kamar')
			    	->first();
			    	$hotel_mekkah_availabel[] = $filter_hotel;
	    		}
	    	}
    	}

    	$array_pluck = array_pluck($hotel_mekkah_availabel, 'kode_kamar');
    	$array_unique = array_unique($array_pluck);

    	foreach ($peserta_hotel_mekkah as $item) {
            if ($item['jk'] == 'L') {
              $mekkah_counter_l += 1;
                // Insert Transaksi
                $req['nomor_transaksi'] = $item['nomor_transaksi'];
                $req['kode_produk'] = $item['kode_produk'];
                $req['kode_kamar'] = $array_unique[$var_mekkah_counter_l];
                $transaksi_hotel = TransaksiHotelMekkah::simpan($req);

                // Insert DurasiHotel
                $req['lokasi'] = 'mekkah';
                $req['room'] = $array_unique[$var_mekkah_counter_l];
                $durasi_hotel = DurasiHotel::simpan( (object) $req);

                $returning[] = ['transaksi_hotel' => $transaksi_hotel, 'durasi_hotel' => $durasi_hotel];
                if ($mekkah_counter_l == 4) {
                    $var_mekkah_counter_l += 1;
                    $var_mekkah_counter_p = $var_mekkah_counter_l + 1;
                    $mekkah_counter_l = 0;
                }
            }

            if ($item['jk'] == 'P') {
    		  $mekkah_counter_p += 1;
        		// Insert Transaksi
        		$req['nomor_transaksi'] = $item['nomor_transaksi'];
        		$req['kode_produk'] = $item['kode_produk'];
        		$req['kode_kamar'] = $array_unique[$var_mekkah_counter_p];
        		$transaksi_hotel = TransaksiHotelMekkah::simpan($req);

        		// Insert DurasiHotel
        		$req['lokasi'] = 'mekkah';
        		$req['room'] = $array_unique[$var_mekkah_counter_p];
        		$durasi_hotel = DurasiHotel::simpan( (object) $req);

        		$returning[] = ['transaksi_hotel' => $transaksi_hotel, 'durasi_hotel' => $durasi_hotel];
        		if ($mekkah_counter_p == 4) {
        			$var_mekkah_counter_p += 1;
        			$mekkah_counter_p = 0;
        		}
            }
    	}
    	
    	return $returning;
    	/*=====  End of HoTEL MEKKAH  ======*/
    }
}
