<?php

namespace Modules\Base\Consoles;

use Illuminate\Console\Command;

class TestSMSCommand extends Command
{

	protected $list_permission = [];

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sms:test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'The systems will setup Role Module';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{

		$smsService = new \App\Commons\SMS\Services\CMCSMSService();
		$smsService->to('0364669813')
		           ->message('Test')
		           ->messageID('ctybasics2_test')
		           ->sendNormal();

		$this->info('done');
	}
}
