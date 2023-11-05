<?php

namespace App\Commons\Notifications\Zalo;

use App\Commons\Notifications\NotificationService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Modules\Setting\Models\Setting;

class ZaloNotificationService extends NotificationService
{
	protected $zaloSetting;

	protected $phone;

	protected $templateID;

	protected $templateData;

	public function to($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	public function templateID($templateID)
	{
		$this->templateID = $templateID;

		return $this;
	}

	public function templateData($templateData)
	{
		$this->templateData = $templateData;

		return $this;
	}

	/**
	 * @return void
	 */
	public function init()
	{
		$setting           = Setting::query()->where('key', 'ZALO_SETTING')->first();
		$this->zaloSetting = json_decode($setting->value ?? '[]');
		$this->appID       = env('ZALO_APP_ID', $this->zaloSetting->app_id);
		$this->secretKey   = env('ZALO_SECRECT_KEY', $this->zaloSetting->app_secret_key);

		$this->getToken();
	}

	/**
	 * @return void
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getToken()
	{
		if(!empty($this->zaloSetting)) {
			if(($this->zaloSetting->date ?? '') === formatDate(Carbon::now(), 'd-m-Y')) {
				$this->accessToken = $this->zaloSetting->access_token ?? '';
			} else {
				$client   = new Client();
				$response = $client->post('https://oauth.zaloapp.com/v4/oa/access_token', [
					'headers'     => [
						'secret_key'   => $this->secretKey,
						'Content-Type' => 'application/x-www-form-urlencoded',
					],
					'form_params' => [
						'refresh_token' => $this->zaloSetting->refresh_token ?? $this->refreshToken,
						'app_id'        => $this->appID,
						'grant_type'    => 'refresh_token',
					],
				]);

				$response = $response->getBody()->getContents();
				$response = json_decode($response);

				$setting  = Setting::query()->where('key', 'ZALO_SETTING')->first();
				if(empty($setting)) {
					$setting                = new Setting();
					$setting->key           = 'ZALO_SETTING';
					$value                  = [];
					$value['date']          = formatDate(Carbon::now(), 'd-m-Y');
					$value['access_token']  = $response->access_token;
					$value['refresh_token'] = $response->refresh_token;
				} else {
					$value                = json_decode($setting->value ?? '[]');
					$value->date          = formatDate(Carbon::now(), 'd-m-Y');
					$value->access_token  = $response->access_token;
					$value->refresh_token = $response->refresh_token;
				}
				$setting->value = json_encode($value);
				$setting->save();

				$this->accessToken = $response->access_token ?? '';
			}
		}
	}

	/**
	 * @return mixed
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function handle()
	{
		return $this->notify();
	}

	/**
	 * @return bool|void
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function notify()
	{
		if(empty($this->phone || $this->zaloSetting->template_id || $this->templateID)) {
			return true;
		}

		$client = new Client();

		$response = $client->post('https://business.openapi.zalo.me/message/template', [
			'headers' => [
				'access_token' => $this->accessToken,
				'Content-Type' => 'application/json',
			],
			'json'    => [
				"mode"          => (env('APP_ENV') === 'local') ? "development" : false,
				"phone"         => $this->phone,
				"template_id"   => $this->templateID,
				"template_data" => $this->templateData,
				"tracking_id"   => "tracking_id",
			],
		]);

		Log::channel('zalo-notify-worker')->info($response->getBody()->getContents());
	}
}