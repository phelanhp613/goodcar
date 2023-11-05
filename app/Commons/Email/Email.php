<?php

namespace App\Commons\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
	use Queueable, SerializesModels;

	public $header;

	public $body;

	public $footer;

	public $details;

	public function header($header)
	{
		$this->header = $header;

		return $this;
	}

	public function body($body)
	{
		$this->body = $body;

		return $this;
	}

	public function footer($footer)
	{
		$this->footer = $footer;

		return $this;
	}

	public function details($details)
	{
		$this->details = $details;

		return $this;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this;
	}
}
