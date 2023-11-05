<?php

namespace App\Jobs;

use App\Commons\Notifications\Zalo\ZaloNotificationService;
use Exception;

class ZaloNotifyJob extends BaseJob
{
	public $fileName = 'zalo-notify-worker';

	protected $phone;

	protected $data;

	protected $templateID;

	protected $zaloNotificationService;

	public function __construct(
		ZaloNotificationService $zaloNotificationService,
	) {
		$this->zaloNotificationService = $zaloNotificationService;
	}

	/**
	 * @param $email
	 *
	 * @return $this
	 */
	public function template($templateID)
	{
		$this->templateID = $templateID;

		return $this;
	}

	/**
	 * @param $email
	 *
	 * @return $this
	 */
	public function data($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		try {
			$this->success("Send Zalo Notify to $this->phone");
			$this->zaloNotificationService->to($this->phone)
			                              ->templateID($this->templateID)
			                              ->templateData($this->data)
			                              ->handle();
			$this->success("Done");
		} catch(Exception $exception) {
			$this->success("Fail: " . $exception->getMessage());
		}
	}

	/**
	 * @param $email
	 *
	 * @return $this
	 */
	public function phone($phone)
	{
		$this->phone = $phone;

		return $this;
	}
}
