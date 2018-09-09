<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Travel;
use App\Model\Pendaftar;
use Illuminate\Support\Facades\Storage;
class TravelController extends Controller
{
    public function index()
    {
    	return view('page.travel.travel');
    }

    public function data()
    {
    	$travel = Travel::where('status', 'true')->get();
    	return view('page.travel.travel-data')
    	->with('travel', $travel);
    }

    public function save(Request $request)
    {
    	try {
    		DB::beginTransaction();
    		$request['kode_travel'] = 'TRV'.rand(000, 999);
    		$request['logo_travel'] = Storage::disk('public')->put('travel/'.$request['kode_travel'], $request->file('logo'));
    		Travel::simpan($request);
			DB::commit();
    		return redirect()
			->back()
			->with('status', 'success')
			->with('message', 'Data berhasil disimpan');
    	} catch (\Exception $e) {
    		DB::rollback();
    		return redirect()
			->back()
			->with('status', 'failed')
			->with('message', 'Terjadi kesalahan');
    	}
    	DB::commit();
    }

    public function drop($kode_travel)
    {
    	try {
    		DB::beginTransaction();
    		Travel::drop($kode_travel);
    		DB::commit();
    		return redirect()
			->back()
			->with('status', 'success')
			->with('message', 'Data berhasil dihapus');
    	} catch (\Exception $e) {
    		DB::rollback();
    		return redirect()
			->back()
			->with('status', 'failed')
			->with('message', 'Terjadi kesalahan');
    	}
    	DB::commit();
    }

    /**
    * Report
    * 
    */

    public function reportIndex()
    {
        $travel = Travel::where('status', 'true')->get();
        return view('page.report-travel.travel', ['travel' => $travel]);
    }

    public function reportIndexDetail($kode_travel)
    {
        $peserta = Pendaftar::where('kode_travel', $kode_travel)->get();
        $travel = Travel::where('kode_travel', $kode_travel)->first();
        return view('page.report-travel.travel-detail', ['peserta' => $peserta, 'travel' => $travel]);
    }

    // Report Helper

    public static function countOrang($kode_travel)
    {
        $travel = Pendaftar::where('kode_travel', $kode_travel)->first();
        return count($travel);
    }
}
