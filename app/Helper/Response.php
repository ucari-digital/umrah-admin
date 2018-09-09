<?php

namespace App\Helper;

class Response
{
	static function json($data, $message, $status, $code)
	{
		$payload = [
			'status' => $code,
			'response' => $status,
			'msg' => $message,
			'data' => $data
		];

		return $payload;
	}

	static function url()
	{
		$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
		$url = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
		return $url;
	}
}