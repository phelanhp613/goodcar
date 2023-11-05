<?php

namespace Modules\Base\Consoles;

use App\Jobs\UpdatePriceDataJob;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Modules\Setting\Models\Setting;

class UpdateZaloRefreshTokenCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'update:zalo-refresh-token';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update Zalo Refresh Token';

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$setting     = Setting::query()->where('key', 'ZALO_SETTING')->first();
		$zaloSetting = json_decode($setting->value ?? '[]');

		$client      = new Client();
		$response    = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
			'headers'     => [
				'secret_key'   => $zaloSetting->app_secret_key,
				'Content-Type' => 'application/x-www-form-urlencoded',
			],
			'form_params' => [
				'refresh_token' => $zaloSetting->refresh_token,
				'app_id'        => $zaloSetting->app_id,
				'grant_type'    => 'refresh_token',
			],
		]);
		$response = $response->getBody()->getContents();
		$response = json_decode($response);

		if(empty($setting)) {
			$setting                = new Setting();
			$setting->key           = 'ZALO_SETTING';
			$value                  = [];
			$value['date']          = formatDate(Carbon::now(), 'd-m-Y');
			$value['access_token']  = $response->access_token;
			$value['refresh_token'] = $response->refresh_token;
		} else {
			$value                = $zaloSetting;
			$value->date          = formatDate(Carbon::now(), 'd-m-Y');
			$value->access_token  = $response->access_token;
			$value->refresh_token = $response->refresh_token;
		}
		$setting->value = json_encode($value);
		$setting->save();

		$this->info('Update Zalo Refresh Token Successfully');
	}
}
