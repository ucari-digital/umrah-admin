<?php

namespace App\Helper;

class OperatorSimCard
{
	static function info($number){

		// Remove +
		$number = str_replace('+', '', $number);
		$number = substr($number, 0,5);

		$telkomsel = ['0811','0812','0813','0821','0822','0823','0852','0851','0853',];
		$xl = ['0',];
		$three = ['0',];
		$operator_code[] = [
			'telkomsel' => [
				'operator' => 'telkomsel',
				'code' => $telkomsel
			],
			'xl' => [
				'operator' => 'xl',
				'code' => $xl
			],
			'three' => [
				'three' => 'three',
				'code' => $three
			]
		];

		$get_code = str_replace('628', '08', $number);

		foreach ($operator_code as $item) {
			foreach ($item as $subitem) {
				foreach ($subitem['code'] as $childitem) {
					if ($childitem == $get_code) {
						return [
							'operator' => $subitem['operator'],
							'code' => $childitem
						];
					}
				}
			}
		}
	}
}