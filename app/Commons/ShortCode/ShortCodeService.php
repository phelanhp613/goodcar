<?php

namespace App\Commons\ShortCode;

use Illuminate\Support\Str;

class ShortCodeService extends ShortCodeProvider
{
	/**
	 * @param $data
	 * @param $isCached
	 *
	 * @return array|mixed|string|string[]
	 */
	public function handle($data, $isCached = true)
	{
		$contentShortCode = $this->getShortCode($data);
		foreach($contentShortCode as $shortCode) {
			$explodeShortCode = explode(' / ', Str::replace('&nbsp;', ' ', $shortCode));
			$shortCodeBase    = trim(reset($explodeShortCode));
			$params           = [];
			foreach($explodeShortCode as $item) {
				$item = trim($item);
				if($item !== $shortCodeBase) {
					$params[] = $item;
				}
			}

			$shortCodeBase = trim($shortCodeBase);
			if(in_array($shortCodeBase, array_keys($this->registers))) {
				$shortCodeClass = new $this->registers[$shortCodeBase]();
				$data           = str_replace("[$shortCode]",
					$shortCodeClass->params($params)->init($isCached), $data);
			}
		}

		return $data;
	}

	/**
	 * @param $string
	 *
	 * @return mixed
	 */
	protected function getShortCode($string)
	{
		preg_match_all('#\[(.*?)\]#', $string, $fields);

		return $fields[1];
	}
}