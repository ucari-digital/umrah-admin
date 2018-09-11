<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Departemen;
class DepartemenController extends Controller
{
	public function index()
	{
		return view('page.departemen.departemen');
	}

	public function save(Request $request)
	{
		try {
			$field = new Departemen;
			$field->departemen = $request->departemen;
			$field->save();
			return redirect()
			->back()
			->with('status', 'success')
			->with('message', 'Data berhasil disimpan');
		} catch (\Exception $e) {
			return redirect()
			->back()
			->with('status', 'success')
			->with('message', 'Terjadi kesalahan');
		}
	}

	public function data()
	{
		$data = Departemen::all();
		return view('page.departemen.departemen-data', compact('data'));
	}

	public function drop($id)
	{
		Departemen::where('id', $id)->delete();
		return redirect()
		->back()
		->with('status', 'success')
		->with('message', 'Data berhasil dihapus');
	}
}
