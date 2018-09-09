<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Response;
use App\Model\Embarkasi;
class EmbarkasiController extends Controller
{
    public function index()
    {
    	return view('page.embarkasi.embarkasi');
    }

    public function data()
    {
        $embarkasi = Embarkasi::all();
        return view('page/embarkasi.embarkasi-data')
        ->with('embarkasi', $embarkasi);
    }

    public function save(Request $request)
    {
    	try {
	    	$response = Embarkasi::simpan($request);
			return redirect()
			->back()
			->with('status', 'success')
			->with('message', 'Data berhasil disimpan');   		
    	} catch (\Exception $e) {
    		return redirect()
			->back()
			->with('status', 'failed')
			->with('message', 'Terjadi kesalahan');
    	}
    }

    public function drop($kode_embarkasi)
    {
        try {
            $embarkasi = Embarkasi::where('kode_embarkasi', $kode_embarkasi)->update([
                'status' => 'N'
            ]);
            if ($embarkasi) {
                return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Data Embarkasi berhasil dihapus');
            }
        } catch (\Exception $e) {
            
        }
    }
}
