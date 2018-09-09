<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helper\Response;
use App\Helper\AuthManager;
use App\Model\Bank;
use App\Model\Pendaftar;
class BankController extends Controller
{
        public function index()
    {
    	return view('page.bank.bank');
    }

    public function data()
    {
    	$bank = Bank::where('status', 'true')->get();
    	return view('page.bank.bank-data')
    	->with('bank', $bank);
    }

    public function save(Request $request)
    {
    	try {
    		DB::beginTransaction();
    		$request['kode_bank'] = 'BANK'.rand(000, 999);
    		Bank::simpan($request);
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

    public function drop($kode_bank)
    {
    	try {
    		DB::beginTransaction();
    		Bank::drop($kode_bank);
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
        $bank = Bank::where('status', 'true')->get();
        return view('page.report-bank.bank', ['bank' => $bank]);
    }

    public function reportIndexDetail($kode_bank)
    {
        $peserta = Pendaftar::where('kode_bank', $kode_bank)->get();
        $bank = Bank::where('kode_bank', $kode_bank)->first();
        return view('page.report-bank.bank-detail', ['peserta' => $peserta, 'bank' => $bank]);
    }

    // Report Helper

    public static function countOrang($kode_bank)
    {
        $bank = Pendaftar::where('kode_bank', $kode_bank)->first();
        return count($bank);
    }
}
