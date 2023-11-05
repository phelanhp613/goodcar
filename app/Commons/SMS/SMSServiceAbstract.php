<?php

namespace App\Commons\SMS;

abstract class SMSServiceAbstract implements SMSServiceInterface
{
	protected $brandname;

	protected $username;

	protected $password;

	protected $apiSendNormal;

	protected $apiSendUnicode;

	protected $apiGetStatus;

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		$this->setApiSendNormal();
		$this->setApiSendUnicode();
		$this->setApiGetStatus();
		$this->setAccount();
	}

	abstract protected function setApiSendNormal();

	abstract protected function setApiSendUnicode();

	abstract protected function setApiGetStatus();

	abstract protected function setAccount();
}