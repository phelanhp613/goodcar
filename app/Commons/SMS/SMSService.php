<?php

namespace App\Commons\SMS;

class SMSService extends SMSServiceAbstract
{
	protected $phone;

	protected $message;

	protected $messageID;

	public function to($phone)
	{
		$phone = str_split($phone);
		if(count($phone) == 10 && $phone[0] == 0) {
			$phone[0] = 84;
			$phone    = implode('', $phone);
		}

		$this->phone = $phone;

		return $this;
	}

	public function message($message)
	{
		$this->message = $message;

		return $this;
	}

	public function messageID($msgId)
	{
		$this->messageID = $msgId;

		return $this;
	}

	public function sendNormal()
	{
		// TODO: Implement sendNormal() method.
	}

	public function sendUnicode()
	{
		// TODO: Implement sendUnicode() method.
	}

	public function getStatusSMS($msgID)
	{
		// TODO: Implement getStatusSMS() method.
	}

	protected function setApiSendNormal()
	{
		// TODO: Implement setApiSendNormal() method.
	}

	protected function setApiSendUnicode()
	{
		// TODO: Implement setApiSendUnicode() method.
	}

	protected function setApiGetStatus()
	{
		// TODO: Implement setApiGetStatus() method.
	}

	protected function setAccount()
	{
		// TODO: Implement setAccount() method.
	}
}