<?php

namespace App\Helper;
use Auth;
class AuthManager
{
	static function users()
	{
		$auth = Auth::user();
		$users = [
			'nama' => $auth->nama_user,
			'user_id' => $auth->kode_user,
			'email' => $auth->email
		];

		return (object) $users;
	}
}