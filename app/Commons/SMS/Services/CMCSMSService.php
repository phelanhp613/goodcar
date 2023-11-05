<?php

namespace App\Commons\SMS\Services;

use App\Commons\SMS\SMSService;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CMCSMSService extends SMSService
{
	public function sendNormal()
	{
		$client = new Client();
		$body   = [
			"brandName"   => $this->brandname,
			"message"     => $this->message,
			"phoneNumber" => $this->phone,
			"user"        => $this->username,
			"pass"        => $this->password,
			"messageId"   => $this->messageID . "_" . time(),
		];

		try {
			$response = $client->post($this->apiSendNormal, [
				"json" => $body,
			]);

			Log::channel('sms-notify-worker')->info($response->getBody()->getContents());
		} catch(Exception $exception) {
			Log::channel('sms-notify-worker')->error($exception->getMessage());
		}
	}

	public function sendUnicode()
	{
		$client = new Client();
		$body   = [
			"brandName"   => $this->brandname,
			"message"     => $this->message,
			"phoneNumber" => $this->phone,
			"sendTime"    => formatDate(Carbon::now(), 'Y-m-d H:i:s'),
			"user"        => $this->username,
			"pass"        => $this->password,
			"messageId"   => $this->messageID . "_" . time(),
		];

		try {
			$response = $client->post($this->apiSendUnicode, [
				"json" => $body,
			]);

			Log::channel('sms-notify-worker')->info($response->getBody()->getContents());
		} catch(Exception $exception) {
			Log::channel('sms-notify-worker')->error($exception->getMessage());
		}
	}

	public function getStatusSMS($msgID)
	{
		$client = new Client();
		$body   = [
			"user"      => $this->username,
			"pass"      => $this->password,
			"messageId" => $msgID,
		];

		try {
			$response = $client->post($this->apiGetStatus, [
				"json" => $body,
			]);

			Log::channel('sms-notify-worker')->info($response->getBody()->getContents());
		} catch(Exception $exception) {
			Log::channel('sms-notify-worker')->error($exception->getMessage());
		}
	}

	protected function setApiSendNormal()
	{
		$this->apiSendNormal = env('SMS_CMC_SEND_NORMAL_API',
			'https://sms1.cmctelecom.vn/MT_CMCTelecom/api/sms/send');
	}

	protected function setApiSendUnicode()
	{
		$this->apiSendUnicode = env('SMS_CMC_SEND_UNICODE_API',
			'https://sms1.cmctelecom.vn/MT_CMCTelecom/api/sms/sendutf');
	}

	protected function setApiGetStatus()
	{
		$this->apiGetStatus = env('SMS_CMC_GET_STATUS_API',
			'https://sms1.cmctelecom.vn/MT_CMCTelecom/api/sms/reconcile');
	}

	protected function setAccount()
	{
		$this->username  = env('SMS_CMC_USERNAME', 'ctybasics2');
		$this->password  = env('SMS_CMC_PASSWORD',
			'$2a$10$HssZdDOiA0QSSjag/vxxQesPrBYE773.UuOTfUADTOaUhE3HmFhXm');
		$this->brandname = env('SMS_CMC_BRANDNAME', 'BASICS');
	}
}