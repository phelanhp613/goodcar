<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

abstract class BaseJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $fileName = 'single';

	public $tries = 5;

	public $timeout = 120;

	/**
	 * @param $exception
	 * @param $status
	 *
	 * @return void
	 */
	public function log($exception, $status = 'info')
	{
		if ($status == 'error') {
			Log::channel($this->fileName)->error($exception);
		} else {
			Log::channel($this->fileName)->info($exception);
		}
	}

	/**
	 * @param \Exception $exception
	 *
	 * @return void
	 */
	public function failed($msg)
	{
		$this->log('Fail: ' . $msg, 'error');
	}

	/**
	 * @param $msg
	 *
	 * @return void
	 */
	public function success($msg)
	{
		$this->log('Success: ' . $msg);
	}
}
