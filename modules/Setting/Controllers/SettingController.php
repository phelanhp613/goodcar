<?php

namespace Modules\Setting\Controllers;

use App\AppHelpers\Helper;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Controllers\BaseController;
use Modules\Setting\Models\MailConfig;
use Modules\Setting\Models\PaymentConfig;
use Modules\Setting\Models\Setting;
use Modules\Setting\Models\Website;
use Modules\Setting\Repositories\MenuService;

class SettingController extends BaseController
{
	protected $menuService;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(MenuService $menuService)
	{
		$this->menuService = $menuService;
	}

	/**
	 * @param Request $request
	 *
	 * @return Factory|View
	 */
	public function index(Request $request)
	{
		return view("Setting::index");
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function menu(Request $request)
	{
		if($request->post()) {
			return back();
		}

		return view('Setting::menu');
	}

	/**
	 * @param Request $request
	 *
	 * @return Factory|View|RedirectResponse
	 */
	public function emailConfig(Request $request)
	{
		$post        = $request->post();
		$mail_config = MailConfig::getMailConfig();
		if($post) {
			unset($post['_token']);
			foreach($post as $key => $value) {
				$mail_config = MailConfig::query()->where('key', $key)->first();
				if(!empty($mail_config)) {
					$mail_config->update(['value' => $value]);
				} else {
					$mail_config        = new MailConfig();
					$mail_config->key   = $key;
					$mail_config->value = $value;
					$mail_config->save();
				}
			}

			$request->session()->flash('success', 'Updated successfully.');

			return redirect()->back();
		}

		return view("Setting::setting.email", compact('mail_config'));
	}

	/**
	 * @return RedirectResponse
	 */
	public function testSendMail(Request $request)
	{
		$mail_to    = MailConfig::getValueByKey(MailConfig::MAIL_ADDRESS);
		$subject    = 'Test email';
		$title      = 'Test email function';
		$body       = 'We are testing email!';
		$send       = sendMail($mail_to, $subject, $title, $body);
		$dispatcher = app(Dispatcher::class);
		$job        = app(SendMailJob::class)->subject($subject)
		                                     ->title($title)
		                                     ->body($body)
		                                     ->email($mail_to)
		                                     ->onQueue(config('queue.connections.database_send_mail.queue'));
		$dispatcher->dispatch($job);
		if($send) {
			$request->session()->flash('success', 'Mail send successfully');
		} else {
			$request->session()
			        ->flash('danger', trans('Can not send email. Please check your Email config.'));
		}

		return redirect()->back();
	}

	/**
	 * @param Request $request
	 *
	 * @return Application|Factory|View|RedirectResponse
	 */
	public function websiteConfig(Request $request)
	{
		$post = $request->post();

		$website_config = Website::getWebsiteConfig();
		$menus          = $this->menuService->getArray();
		if($post) {
			unset($post['_token']);
			foreach($post as $key => $value) {
				$data           = [
					'key'   => $key,
					'value' => $value,
				];
				$website_config = Website::query()->where('key', $key)->first();
				if(in_array($key, ['MENU_HEADER', 'MENU_FOOTER'])) {
					$menu            = $this->menuService->detail($value);
					$data['content'] = $menu->content;
				}
				if(!empty($website_config)) {
					$website_config->update($data);
				} else {
					$website_config = new Website($data);
					$website_config->save();
				}
			}

			$request->session()->flash('success', 'Updated successfully.');

			return redirect()->back();
		}

		return view("Setting::setting.website", compact('website_config', 'menus'));
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function paymentConfig(Request $request)
	{
		$post = $request->post();
		if($post) {
			unset($post['_token']);
			foreach($post as $key => $value) {
				$data           = [
					'key'   => $key,
					'value' => $value,
				];
				$website_config = PaymentConfig::query()->where('key', $key)->first();
				if(!empty($website_config)) {
					$website_config->update($data);
				} else {
					$website_config = new PaymentConfig($data);
					$website_config->save();
				}
			}

			$request->session()->flash('success', 'Updated successfully.');

			return redirect()->back();
		}
		$config = PaymentConfig::getPaymentConfig();

		return view("Setting::setting.payment", compact('config'));
	}


	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function zaloNotifyConfig(Request $request)
	{

		$setting = Setting::query()->where('key', 'ZALO_SETTING')->first();
		$post    = $request->post();
		if($post) {
			unset($post['_token']);
			$post['date'] = formatDate(Carbon::now(), 'd-m-Y');
			if(empty($setting)) {
				$setting      = new Setting();
				$setting->key = 'ZALO_SETTING';
				$request->session()->flash('success', 'Updated successfully.');
			}
			$setting->value = json_encode($post);
			$setting->save();

			return redirect()->back();
		}
		$config = json_decode($setting->value ?? '[]');

		return view("Setting::setting.zalo_notify", compact('config'));
	}
}
