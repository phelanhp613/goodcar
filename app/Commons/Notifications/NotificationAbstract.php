<?php

namespace App\Commons\Notifications;

abstract class NotificationAbstract implements NotificationInterface
{
	protected $api = null;

	protected $appID = null;

	protected $secretKey = null;

	protected $accessToken = null;

	protected $refreshToken = null;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		$this->getToken();
	}

	public function getToken()
	{
		$this->refreshToken = '123';
		$this->accessToken  = '123';
	}
}