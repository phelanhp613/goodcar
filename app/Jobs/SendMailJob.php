<?php

namespace App\Jobs;

use App\Commons\Email\EmailServiceInterface;
use Exception;

class SendMailJob extends BaseJob
{
	public $fileName = 'email-worker';

	protected $email;

	protected $subject;

	protected $title;

	protected $body;

	protected $template;

	protected $emailServiceInterface;

	public function __construct(
		EmailServiceInterface $emailServiceInterface,
	) {
		$this->emailServiceInterface = $emailServiceInterface;
	}

	/**
	 * @param $email
	 *
	 * @return $this
	 */
	public function email($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @param $subject
	 *
	 * @return $this
	 */
	public function subject($subject)
	{
		$this->subject = $subject;

		return $this;
	}

	/**
	 * @param $title
	 *
	 * @return $this
	 */
	public function title($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * @param $body
	 *
	 * @return $this
	 */
	public function body($body)
	{
		$this->body = $body;

		return $this;
	}

	/**
	 * @param $template
	 *
	 * @return $this
	 */
	public function template($template)
	{
		$this->template = $template;

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
			$this->success("Sending email with $this->subject");
			$data     = [
				'subject' => $this->subject ?? null,
				'header'  => $this->title ?? null,
				'body'    => $this->body ?? null,
			];
			$template = !empty($this->template) ? $this->template : null;
			$this->emailServiceInterface->send($this->email, $data, $template);
			$this->success("Done");
		} catch(Exception $exception) {
			$this->success("Fail: " . $exception->getMessage());
		}
	}
}
