<?php

namespace App\Commons\ShortCode;

abstract class ShortCodeAbstract
{
	public string $cacheKey = '';

	public string $url;

	public array $params = [];

	/**
	 * @param $params
	 *
	 * @return $this
	 */
	public function params($params)
	{
		$this->params = $params;

		return $this;
	}

	/**
	 * @return false|mixed
	 */
	public function getData($isCached = true)
	{
		$this->params = $this->handleParams();

		return $this->handle($isCached);
	}

	public function handleParams()
	{
		$params = [];
		if(!empty($this->params)) {
			foreach($this->params as $param) {
				$explode = explode('=', trim($param));
				if(!empty($explode[1])) {
					$params[$explode[0]] = html_entity_decode($explode[1]);
				}
			}
		}

		return $params;
	}

	abstract public function handle($isCached = true);
}