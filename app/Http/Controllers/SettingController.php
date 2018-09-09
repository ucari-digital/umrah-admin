<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function tahunHijriah(Request $request)
    {
    	$myfile = fopen("setting.json", "w") or die("Unable to open file!");
    	$json = [
    		'tahun_hijriah' => $request->tahun_hijriah
    	];
		fwrite($myfile, json_encode($json));
		fclose($myfile);
    }

    public function load()
    {
    	$json = file_get_contents(url('setting.json'));
		$setting = (object) json_decode($json);
		return $setting;
    }
}
