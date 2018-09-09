<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DatPesawatSeat;
use App\Model\DatHotelSeat;
use App\Model\DatHotel;
use App\Model\Pendaftar;
use App\Model\Peserta;
class GeneratorController extends Controller
{
    public function seat($kode_pesawat)
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

        $result = []; 
        foreach ($seat as $item) {
        	$pesawat = DatPesawatSeat::simpan($kode_pesawat, $item);
        	array_push($result, $pesawat);
        }

        return $result;
    }

    public function hotel()
    {
        try {
            $hotel = DatHotel::select('kode_hotel')->get();
            $response_data = [];
            foreach ($hotel as $item) {
                for ($i=1; $i <= 30; $i++) {
                    for ($a=1; $a <= 34; $a++) {
                        if ($a < 10) {
                            $a = '0'.$a;
                        }
                        $req['kode_hotel'] = $item->kode_hotel;
                        $req['lantai'] = $i;
                        $req['nomor_kamar'] = $a;
                        $data_hotel_seat = DatHotelSeat::simpan($req);
                        array_push($response_data, $data_hotel_seat);
                    }
                }
            }
            
            return $response_data;
        } catch (\Exception $e) {
            return 'Error '.$e->getMessage();
        }
        
    }

    public function user()
    {
        for ($i=1; $i <= 2; $i++) { 
            $name = 'Riki';
            $prefix = '7';
            $req['nama'] = $name.$i;
            $req['kode_perusahaan'] = 'CPRT5854';
            $req['email'] = $name.$i.'@gmail.com';
            $req['telephone'] = '081595109'.$prefix.$i;
            $req['jk'] = 'L';
            $req['nip'] = '123456789'.$prefix.$i;
            $req['nik'] = '12345678901234'.$prefix.$i;
            $req['kode_bank'] = 'BANK517';
            $req['kode_travel'] = 'TRV717';
            $req['hubungan_keluarga'] = '';
            $req['password'] = 'abc';
            $pendaftar = Pendaftar::simpan($req);
            $req['nomor_pendaftar'] = $pendaftar['data']['nomor_pendaftar'];
            $peserta = Peserta::simpan($req);
            $return[] = ['pendaftar' => $pendaftar, 'peserta' => $peserta];
        }
        return $return;
    }
}
