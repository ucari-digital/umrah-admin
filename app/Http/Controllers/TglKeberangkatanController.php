<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;
use App\Model\Embarkasi;
use App\Helper\TimeFormat;
use Carbon\Carbon;
class TglKeberangkatanController extends Controller
{
    public function index(Request $request)
    {
        $embarkasi = Embarkasi::all();
        return view('page.tgl-berangkat.tgl-berangkat')
        ->with('embarkasi', $embarkasi);
    }

    public function data(Request $request)
    {
        $produk = Produk::orderBy('created_at', 'desc')->get();
        return view('page.tgl-berangkat.tgl-berangkat-table')
    	->with('produk', $produk);
    }

    public function save(Request $request)
    {
    	try {
    		$response = Produk::simpan($request);
    		if ($response['status'] == 200) {
    			return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Data berhasil disimpan');
    		}
    	} catch (\Exception $e) {
    		return $e;
    	}

    }

    public function pubOrNo($status, $kode_produk)
    {
    	try {
    		if($status == 'publish'){
		    	$produk = Produk::where('kode_produk', $kode_produk)
		    	->update([
		    		'status' => 'Y'
		    	]);
	    	} elseif ($status == 'draft') {
	    		$produk = Produk::where('kode_produk', $kode_produk)
		    	->update([
		    		'status' => 'N'
		    	]);
	    	}
	    	return redirect()->back();
    	} catch (\Exception $e) {
    		
    	}
    }

    public function drop($kode_produk)
    {
        try {
            return Produk::where('kode_produk', $kode_produk)->update([
                'status' => 'drop'
            ]);
            return redirect()
            ->back()
            ->with('status', 'failed')
            ->with('message', 'Data Embarkasi berhasil dihapus');
        } catch (\Exception $e) {
            
        }
    }
}
