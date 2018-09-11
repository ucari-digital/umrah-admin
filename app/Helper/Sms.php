<?php
namespace App\Helper;

use App\Helper\Guzzle;
use App\Helper\OperatorSimCard;
/**
 * SMS Helper untuk ADSMEDIA
 */
class Sms
{
    public static function key()
    {
        return 'gibbfdyx4szugaayy1bbm7wt2jj1fmrw';
    }

	public static function send($data)
	{
        $validasi_operator = OperatorSimCard::info($data['number']);
        if ($validasi_operator) {
            $from = "";
        } else {
            $from = 'Umrah+Uzbek';
        }

		$param = [
            'full_url' => true,
            'method' => 'POST',
            'url' => env('API_SMS_URL', '').'/restapi/sms/1/text/single',
            'request' => [
                'allow_redirects' => true,
                'auth' => [
                    'dimas10',
                    '@Dimas123'
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'from' => $from,
                    'to' => $data['number'],
                    'text' => $data['text']
                ]
            ]
        ];
		return Guzzle::request($param);
		// return $param;
	}
}