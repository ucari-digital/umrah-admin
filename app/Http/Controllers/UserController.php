<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
	function __construct()
	{
		
	}

	public function index()
	{
		return view('page.user.user');
	}

	public function save(Request $request)
	{
		try {
			User::simpan($request);
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

	public function data(Request $request)
	{
		$user = User::all();
		return view('page.user.user-table')
		->with('user', $user);
	}

	public function status($status, $kode_user)
	{
		User::where('kode_user', $kode_user)->update([
			'status' => $status
		]);
		return redirect()->back();
	}
}
