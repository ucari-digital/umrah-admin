<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Perusahaan;
use Illuminate\Support\Facades\Storage;
class PerusahaanController extends Controller
{
    public function index()
    {
    	return view('page.perusahaan.perusahaan');
    }

    public function data()
    {
        $perusahaan = Perusahaan::all();
        return view('page.perusahaan.perusahaan-table')
        ->with('perusahaan', $perusahaan);
    }

    public function save(Request $request)
    {
    	try {
    		$kode_perusahaan = 'CPRT'.rand(0000, 9999);
    		$src_logo = Storage::disk('public')->put('perusahaan/'.$kode_perusahaan, $request->file('logo'));
    		$src_tagline = Storage::disk('public')->put('perusahaan/'.$kode_perusahaan, $request->file('tagline'));

    		$request['kode_perusahaan'] = $kode_perusahaan;
    		$request['src_logo'] = asset('storage/'.$src_logo);
    		$request['src_tagline'] = asset('storage/'.$src_tagline);
    		$perusahaan = Perusahaan::simpan($request);
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

    public function change($kode_perusahaan)
    {
        $perusahaan = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->first();
        return view('page.perusahaan.perusahaan-change')
        ->with('item', $perusahaan);
    }

    public function update(Request $request, $kode_perusahaan)
    {
        try {
            $perusahaan = Perusahaan::where('kode_perusahaan', $kode_perusahaan)->first();
            if ($request->logo) {
                $src_logo = Storage::disk('public')->put('perusahaan/'.$kode_perusahaan, $request->file('logo'));
                $logo = asset('storage/'.$src_logo);
            } else {
                $logo = $perusahaan->logo;
            }

            if ($request->tagline) {
                $src_tagline = Storage::disk('public')->put('perusahaan/'.$kode_perusahaan, $request->file('tagline'));
                $tagline = asset('storage/'.$src_tagline);
            } else {
                $tagline = $perusahaan->slogan;
            }
            Perusahaan::where('kode_perusahaan', $kode_perusahaan)->update([
                'domain' => $request->domain,
                'nama' => $request->nama_perusahaan,
                'telephone' => $request->telepon,
                'website' => $request->website,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'logo' => $logo,
                'slogan' => $tagline

            ]);
            return redirect('perusahaan-data')
            ->with('status', 'success')
            ->with('message', 'Berhasil merubah data');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
