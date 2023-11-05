<?php

namespace App\Commons\SMS;

interface SMSServiceInterface {
	public function sendNormal();

	public function sendUnicode();

	public function getStatusSMS($msgID);
}