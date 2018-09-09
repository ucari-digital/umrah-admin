<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helper\Guzzle;
use App\Model\Produk;
use App\Model\DatPesawat;
use App\Model\DatHotel;
use App\Model\Transaksi;
use App\Model\Embarkasi;
use App\Model\TransaksiPesawat;
use App\Model\TransaksiHotel;
use App\Model\TransaksiHotelMekkah;
use App\Model\DurasiHotel;
class BookController extends Controller
{
    public function seatIndex(Request $request)
    {
    	$embarkasi = Embarkasi::all();
    	$produk = Produk::whereDate('tanggal_keberangkatan', '>=', date('Y-m-d'))
    	->where('kode_embarkasi', $request->embk)
    	->get();
    	$pesawat = DatPesawat::find(1);
    	$seat = self::seat();
    	return view('page.book-seat.seat')
    	->with('pesawat', $pesawat)
        ->with('embarkasi', $embarkasi)
        ->with('seat', $seat)
        ->with('produk', $produk);
    }

    public function saveIndex(Request $request)
    {
    	try {
	    	$transaksi = Transaksi::simpan($request);
	    	if ($transaksi['status'] == 200) {
	    		TransaksiPesawat::simpan($request, $transaksi['data']['nomor_transaksi']);
	    		return redirect()
				->back()
				->with('status', 'success')
				->with('message', 'Data berhasil disimpan');
	    	} else {
	    		return redirect()
				->back()
				->with('status', 'failed')
				->with('message', 'Gagal menyimpan data');
	    	}
    	} catch (\Exception $e) {
    		return redirect()
			->back()
			->with('status', 'failed')
			->with('message', 'Terjadi kesalahan');
    	}
    }

    public function seatIndexPeserta(Request $request)
    {
        $embarkasi = Embarkasi::all();
        $produk = Produk::whereDate('tanggal_keberangkatan', '>=', date('Y-m-d'))
        ->where('kode_embarkasi', $request->embk)
        ->get();
        $pesawat = DatPesawat::find(1);
        return view('page.book-seat.peserta-book-seat')
        ->with('embarkasi', $embarkasi)
        ->with('produk', $produk)
        ->with('pesawat', $pesawat);
    }

    public function saveIndexPeserta(Request $request)
    {
        try {
            // return $request->input();
            $transaksi_finder = DB::table('transaksi')
            ->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
            ->where('transaksi.kode_embarkasi', $request->kode_embarkasi)
            ->where('transaksi.kode_produk', $request->tanggal_keberangkatan)
            ->where('transaksi_pesawat.kode_kursi', $request->seat)
            ->select('transaksi.nomor_transaksi')
            ->first();

            /**
            * mengambil data informasi user dan mencocockan data dengan table transaksi dan transaksi_pesawat
            */
            $validasi_seat = DB::table('transaksi')
            ->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
            ->where('transaksi.nomor_peserta', $request->nomor_peserta)
            ->where('transaksi.kode_produk', $request->tanggal_keberangkatan)
            ->first();

            if ($validasi_seat) {
                return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', 'Peserta telah memiliki seat');
            }

            /**
            * Menghapus data fiktif transaksi
            */
            $transaksi =Transaksi::where('nomor_transaksi', $transaksi_finder->nomor_transaksi)->delete();

            /**
            * Mengupdate data fiktif transaksi menjadi real data user transaksi
            */
            $transaksi_pesawat = TransaksiPesawat::where('nomor_transaksi', $transaksi_finder->nomor_transaksi)
            ->update([
                'nomor_transaksi' => $request->nomor_transaksi,
                'status' => 'approved'
            ]);

            return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()
            ->back()
            ->with('status', 'failed')
            ->with('message', 'Terjadi kesalahan');
        }
    }

    public function checkAvailabelSeat(Request $request, $status = null)
    {
        if ($status == 'fiktif') {
            $produk = DB::table('transaksi')
            ->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
            ->join('dat_pesawat_seat', 'transaksi_pesawat.kode_kursi', 'dat_pesawat_seat.kode_kursi')
            ->where('transaksi.kode_produk', $request->kode_produk)
            ->where('transaksi_pesawat.status', 'fiktif')
            ->select('dat_pesawat_seat.kursi')
            ->get();
            $kursi = [];
            foreach ($produk as $index) {
                array_push($kursi, $index->kursi) ;
            }
            return $kursi;
        } else {
            $produk = DB::table('transaksi')
            ->join('transaksi_pesawat', 'transaksi.nomor_transaksi', 'transaksi_pesawat.nomor_transaksi')
            ->join('dat_pesawat_seat', 'transaksi_pesawat.kode_kursi', 'dat_pesawat_seat.kode_kursi')
            ->where('transaksi.kode_produk', $request->kode_produk)
            ->select('dat_pesawat_seat.kursi')
            ->get();

            $seat = self::seat();
            $kursi = [];
            foreach ($produk as $index) {
                array_push($kursi, array_search($index->kursi, $seat)) ;
            }
            return array_except($seat, $kursi);
        }
        
    }

    /**
    * HOTEL
    */

    public function hotelIndex(Request $request)
    {
        $embarkasi = Embarkasi::all();
        $produk = Produk::whereDate('tanggal_keberangkatan', '>=', date('Y-m-d'))
        ->where('kode_embarkasi', $request->embk)
        ->get();
        $hotel = DatHotel::where('lokasi', $request->lokasi)->get();

        $param = [
            'method' => 'POST',
            'url' => 'hotel/get-kamar-availabel',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => ''
                ],
                'form_params' => [
                    'kode_hotel' => $request->hotel,
                    'lantai' => $request->lantai,
                    'kode_produk' => $request->tgl_berangkat,
                    'hotel' => $request->lokasi
                ]
            ]
        ];

        if(!empty($request->lantai)){
            $response = Guzzle::requestAsync($param);
        }

        if (empty($response)) {
            $response = [];
        }

        // return $response;

        return view('page.book-hotel.seat')
        ->with('embarkasi', $embarkasi)
        ->with('produk',$produk)
        ->with('hotel', $hotel)
        ->with('room', $response);
    }

    public function saveHotelIndex(Request $request)
    {
        $transaksi = Transaksi::simpan($request);
        if ($transaksi['status'] == 200) {
            $request['nomor_transaksi'] = $transaksi['data']['nomor_transaksi'];
            if ($request->lokasi == 'madinah') {
                $transaksi_hotel = TransaksiHotel::fiktif($request);
            }
            if ($request->lokasi == 'mekkah') {
                $transaksi_hotel = TransaksiHotelMekkah::fiktif($request);
            }
            if ($transaksi_hotel['status'] == 200) {
                $durasi_hotel = DurasiHotel::simpan($request);
                return redirect()->back();
            }
        }
    }

    public function hotelIndexPeserta(Request $request)
    {
        $hotel = DatHotel::where('lokasi', $request->lokasi)->get();
        return view('page.book-hotel.peserta-book-seat')
        ->with('hotel', $hotel);
    }

    public function saveHotelIndexPeserta(Request $request)
    {
       
        if ($request->lokasi == 'madinah') {
            $cek_transaksi_hotel = TransaksiHotel::where('nomor_transaksi', $request->nomor_transaksi)->first();
            $transaksi_hotel_fiktif = TransaksiHotel::where('nomor_transaksi', $request->room)->first();
            $req['nomor_transaksi'] = $request->nomor_transaksi;
            $req['kode_produk'] = $transaksi_hotel_fiktif->kode_produk;
            $req['kode_kamar'] = $transaksi_hotel_fiktif->kode_kamar;
            $transaksi_hotel = TransaksiHotel::simpan($req);

            return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', 'Data berhasil disimpan');
        }
        if ($request->lokasi == 'mekkah') {
            $cek_transaksi_hotel = TransaksiHotelMekkah::where('nomor_transaksi', $request->nomor_transaksi)->first();
            $transaksi_hotel_fiktif = TransaksiHotelMekkah::where('nomor_transaksi', $request->room)->first();
            $req['nomor_transaksi'] = $request->nomor_transaksi;
            $req['kode_produk'] = $transaksi_hotel_fiktif->kode_produk;
            $req['kode_kamar'] = $transaksi_hotel_fiktif->kode_kamar;
            $transaksi_hotel = TransaksiHotelMekkah::simpan($req);

            return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', 'Data berhasil disimpan');
        }

        /**
        * Pengecekan apakah user telah book hotel atau belum
        * 
        */
        if ($cek_transaksi_hotel) {
            return redirect()
            ->back()
            ->with('status', 'failed')
            ->with('message', 'Peserta telah memiliki seat');
        }
    }

    public function checkAvailabelHotel(Request $request)
    {
        if ($request->lokasi == 'madinah') {
            $room = DB::table('transaksi_hotel')
            ->join('transaksi', 'transaksi_hotel.nomor_transaksi', 'transaksi.nomor_transaksi')
            ->join('dat_hotel_seat', 'transaksi_hotel.kode_kamar', 'dat_hotel_seat.kode_kamar')
            ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
            ->where(function ($query){
                $query->where('transaksi_hotel.status', '=', 'fiktif')
                      ->orWhere('transaksi_hotel.status', '=', 'approved');
            })
            // ->Where('transaksi_hotel.status', 'approved')
            ->where('transaksi.kode_produk', $request->kode_produk)
            ->where('dat_hotel_seat.lantai', $request->lantai)
            ->where('dat_hotel_seat.kode_hotel', $request->hotel)
            ->select('dat_hotel_seat.lantai', 'dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.kode_kamar', 'transaksi.nomor_transaksi', 'dat_hotel.lokasi')
            ->get();

            $jumlah_orang = [];
            foreach ($room as $item) {
                $data['lantai'] = $item->lantai;
                $data['nomor_kamar'] = $item->nomor_kamar;
                $data['kode_kamar'] = $item->kode_kamar;
                $data['nomor_transaksi'] = $item->nomor_transaksi;
                $data['lokasi'] = $item->lokasi;
                $data['jumlah_orang'] = self::orangRoom($item->nomor_transaksi, $item->lokasi);
                array_push($jumlah_orang, $data);
            }

            // Menghapus duplicate array
            $duplicate = [];
            foreach ($jumlah_orang as $item) {
                if (isset($duplicate[$item['kode_kamar']])) {
                    continue;
                }
                $duplicate[$item['kode_kamar']] = $item;
            }

            return $duplicate;
        }

        if ($request->lokasi == 'mekkah') {
            $room = DB::table('transaksi_hotel_mekkah')
            ->join('transaksi', 'transaksi_hotel_mekkah.nomor_transaksi', 'transaksi.nomor_transaksi')
            ->join('dat_hotel_seat', 'transaksi_hotel_mekkah.kode_kamar', 'dat_hotel_seat.kode_kamar')
            ->join('dat_hotel', 'dat_hotel_seat.kode_hotel', 'dat_hotel.kode_hotel')
            ->where(function ($query){
                $query->where('transaksi_hotel.status', '=', 'fiktif')
                      ->orWhere('transaksi_hotel.status', '=', 'approved');
            })
            ->where('transaksi.kode_produk', $request->kode_produk)
            ->where('dat_hotel_seat.lantai', $request->lantai)
            ->where('dat_hotel_seat.kode_hotel', $request->hotel)
            ->select('dat_hotel_seat.lantai', 'dat_hotel_seat.nomor_kamar', 'dat_hotel_seat.kode_kamar', 'transaksi.nomor_transaksi', 'dat_hotel.lokasi')
            ->get();

            $jumlah_orang = [];
            foreach ($room as $item) {
                $data['lantai'] = $item->lantai;
                $data['nomor_kamar'] = $item->nomor_kamar;
                $data['kode_kamar'] = $item->kode_kamar;
                $data['nomor_transaksi'] = $item->nomor_transaksi;
                $data['lokasi'] = $item->lokasi;
                $data['jumlah_orang'] = self::orangRoom($item->nomor_transaksi, $item->lokasi);
                array_push($jumlah_orang, $data);
            }
            return $jumlah_orang;
        }
        
    }

    /**
    * Helper
    */

    static function seat()
    {
        $seat = [
            '4A', '4B', '4C', '4H', '4J', '4K',
            '5A', '5B', '5C', '5D', '5F', '5G', '5H', '5J', '5K',
            '6A', '6B', '6C', '6D', '6F', '6G', '6H', '6J', '6K',
            '7A', '7B', '7C', '7D', '7F', '7G', '7H', '7J', '7K',
            '8D', '8F', '8G',
            '9D', '9F', '9G',
            '10D', '10F', '10G',
            '14A', '14B', '14C', '14D', '14F', '14G', '14H', '14J', '14K',
            '15A', '15B', '15C', '15D', '15F', '15G', '15H', '15J', '15K',
            '16A', '16B', '16C', '16D', '16F', '16G', '16H', '16J', '16K',
            '17A', '17B', '17C', '17D', '17F', '17G', '17H', '17J', '17K',
            '18A', '18B', '18C', '18D', '18F', '18G', '18H', '18J', '18K',
            '19A', '19B', '19C', '19D', '19F', '19G', '19H', '19J', '19K',
            '20A', '20B', '20C', '20D', '20F', '20G', '20H', '20J', '20K',
            '21A', '21B', '21C', '21D', '21F', '21G', '21H', '21J', '21K',
            '22A', '22B', '22C', '22D', '22F', '22G', '22H', '22J', '22K',
            '23A', '23B', '23C', '23D', '23F', '23G', '23H', '23J', '23K',
            '24A', '24B', '24C', '24D', '24F', '24G', '24H', '24J', '24K',
            '25A', '25B', '25C', '25D', '25F', '25G', '25H', '25J', '25K',
            '26A', '26B', '26C', '26D', '26F', '26G', '26H', '26J', '26K',
            '27A', '27B', '27C', '27D', '27F', '27G', '27H', '27J', '27K',
            '28A', '28B', '28C', '28D', '28F', '28G', '28H', '28J', '28K',
            '29A', '29B', '29C', '29D', '29F', '29G', '29H', '29J', '29K',
            '30A', '30B', '30C', '30D', '30F', '30G', '30H', '30J', '30K',
            '31A', '31B', '31C', '31D', '31F', '31G', '31H', '31J', '31K',
            '32A', '32B', '32C', '32D', '32F', '32G', '32H', '32J', '32K',
            '33D', '33F', '33G',
            '36A', '36B', '36C', '36D', '36F', '36G', '36H', '36J', '36K',
            '37A', '37B', '37C', '37D', '37F', '37G', '37H', '37J', '37K',
            '38A', '38B', '38C', '38D', '38F', '38G', '38H', '38J', '38K',
            '39A', '39B', '39C', '39D', '39F', '39G', '39H', '39J', '39K',
            '40A', '40B', '40C', '40D', '40F', '40G', '40H', '40J', '40K',
            '41A', '41B', '41C', '41D', '41F', '41G', '41H', '41J', '41K',
            '42A', '42B', '42C', '42D', '42F', '42G', '42H', '42J', '42K',
            '43A', '43B', '43C', '43D', '43F', '43G', '43H', '43J', '43K',
            '44A', '44B', '44C', '44D', '44F', '44G', '44H', '44J', '44K',
            '45A', '45B', '45D', '45F', '45G', '45J', '45K',
            '46A', '46B', '46D', '46F', '46G', '46J', '46K',
            '47A', '47B', '47D', '47F', '47G', '47J', '47K',
            '48A', '48B', '48D', '48F', '48G', '48J', '48K',
            '49A', '49B', '49D', '49F', '49G', '49J', '49K',
            '50A', '50B', '50D', '50F', '50G', '50J', '50K',
        ];
        return $seat;
    }

    /**
    * Menghitung jumlah orang dalam satu ruangan hotel
    */
    static function orangRoom($nomor_transaksi, $lokasi)
    {
        if ($lokasi == 'madinah') {
            $transaksi_hotel = TransaksiHotel::where('nomor_transaksi', $nomor_transaksi)->first();
            $hotel = TransaksiHotel::where('kode_produk', $transaksi_hotel->kode_produk)
            ->where('kode_kamar', $transaksi_hotel->kode_kamar)
            ->where('status', '<>', 'fiktif')
            ->get();

            return count($hotel);
        }

        if ($lokasi == 'mekkah') {
            $transaksi_hotel = TransaksiHotelMekkah::where('nomor_transaksi', $nomor_transaksi)->first();
            $hotel = TransaksiHotelMekkah::where('kode_produk', $transaksi_hotel->kode_produk)
            ->where('kode_kamar', $transaksi_hotel->kode_kamar)
            ->where('status', '<>', 'fiktif')
            ->get();

            return count($hotel);
        }
    }

}
