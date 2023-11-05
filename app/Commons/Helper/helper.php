<?php

use App\Commons\Mail\SendMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Base\Models\Status;
use Modules\Setting\Models\Setting;
use Symfony\Component\HttpFoundation\File\File as FileUpload;

include 'cache_data.php';

function getSetting($key)
{
	$data = Setting::where('key', $key)->first();

	return !empty($data) ? $data->value : null;
}

if(!function_exists('get_directories')) {
	/**
	 * @param $path
	 *
	 * @return array
	 */
	function get_directories($path)
	{
		$directories = [];
		$items       = scandir($path);
		foreach($items as $item) {
			if($item == '..' || $item == '.') {
				continue;
			}
			if(is_dir($path . '/' . $item)) {
				$directories[] = $item;
			}
		}

		return $directories;
	}
}
if(!function_exists('config_permission_merge')) {
	/**
	 * @return array
	 */
	function config_permission_merge()
	{
		$modules = get_directories(base_path('modules'));
		$files   = [];
		$i       = 0;
		foreach($modules as $key => $value) {
			$urlPath = $value . '/Configs/permission.php';
			$file    = base_path('modules') . '/' . $urlPath;
			if(file_exists($file)) {
				$files[(int) filemtime($file) + $i] = $file;
				$i ++;
			}
		}
		ksort($files);
		$permissions = [];
		foreach($files as $file) {
			$permissions[] = require($file);
		}

		return $permissions;
	}
}
if(!function_exists('config_menu_merge')) {
	/**
	 * @return array
	 */
	function config_menu_merge()
	{
		$modules    = get_directories(base_path('modules'));
		$activeMenu = [];
		foreach($modules as $key => $value) {
			$urlPath = $value . '/Configs/menu.php';
			if(file_exists(base_path('modules') . '/' . $urlPath)) {
				$activeMenu[] = require(base_path('modules') . '/' . $urlPath);
			}
		}
		$activeMenu = collect($activeMenu)->sortBy('sort')->toArray();

		return $activeMenu;
	}
}
if(!function_exists('isTimestamp')) {
	/**
	 * @param $date
	 *
	 * @return bool
	 */
	function isTimestamp($date)
	{
		try {
			return ((int) $date === $date)
			       && ($date <= PHP_INT_MAX)
			       && ($date >= ~PHP_INT_MAX);
		} catch(Exception $e) {
			return false;
		}
	}
}
if(!function_exists('formatDate')) {
	/**
	 * @param $timestamp
	 * @param null $format
	 *
	 * @return string|null
	 */
	function formatDate($timestamp, $format = null)
	{
		return Carbon::createFromTimestamp((!isTimestamp($timestamp) ? strtotime($timestamp) : $timestamp),
			config('app.timezone'))
		             ->format(!empty($format) ? $format : "d-m-Y");
	}
}
if(!function_exists('getModal')) {
	/**
	 * @param array $array
	 *
	 * @return string
	 */
	function getModal($array = [])
	{
		if(!empty($array)) {
			$class    = $array['class'] ?? null;
			$id       = $array['id'] ?? 'form-modal';
			$tabindex = $array['tabindex'] ?? '-1';
			$size     = $array['size'] ?? null;
			$title    = $array['title'] ?? 'Title';
			if($tabindex !== false) {
				$html = '<div class="modal fade ' . $class . '" id="' . $id . '" tabindex="' . $tabindex
				        . '" role="dialog" aria-hidden="true">';
			} else {
				$html = '<div class="modal fade ' . $class . '" id="' . $id . '" role="dialog" aria-hidden="true">';
			}
			$html .= '<div class="modal-dialog ' . $size . ' ">';
			$html .= '<div class="modal-content">';
			$html .= '<div class="modal-header"><h5 class="title">' . $title . '</h5></div>';
			$html .= '<div class="modal-body">';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="datetime-modal position-relative"></div>';
		} else {
			$html = '<div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modal" aria-hidden="true">';
			$html .= '<div class="modal-dialog">';
			$html .= '<div class="modal-content">';
			$html .= '<div class="modal-header">';
			$html .= '<h5 class="title">Create</h5>';
			$html .= '</div>';
			$html .= '<div class="modal-body">';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="datetime-modal position-relative"></div>';
		}

		return $html;
	}
}
if(!function_exists('segmentUrl')) {
	/**
	 * @param $index
	 *
	 * @return mixed
	 */
	function segmentUrl($index)
	{
		return request()->segments()[$index] ?? '/';
	}
}
if(!function_exists('summaryListing')) {
	/**
	 * @param $data
	 *
	 * @return string|null
	 */
	function summaryListing($data)
	{
		$html = '';
		$html .= '<span class="listing-information">';
		$html .= trans('Showing');
		$html .= '<b> ';
		$html .= (count($data) > 0) ? ($data->currentpage() - 1) * $data->perpage() + 1 : 0;
		$html .= '</b> ';
		$html .= trans(' to ');
		$html .= '<b> ';
		$html .= ($data->currentpage() - 1) * $data->perpage() + $data->count();
		$html .= ' </b>';
		$html .= trans(' of ');
		$html .= '<b>' . $data->total() . '</b> ' . trans('entries') . '</span>';

		return $html;
	}
}
if(!function_exists('sendMail')) {
	/**
	 * @param $mail_to
	 * @param $subject
	 * @param $title
	 * @param $body
	 * @param null $template
	 *
	 * @return bool
	 */
	function sendMail($mail_to, $subject, $title, $body, $template = null)
	{
		/** Send email */
		if(empty($template)) {
			$template = 'Base::email.send_test_mail';
		}
		$mail = new SendMail;
		$mail->to($mail_to)->subject($subject)->title($title)->body($body)->view($template);
		try {
			Mail::send($mail);
		} catch(Exception $e) {
			return false;
		}

		return true;
	}
}
if(!function_exists('getRecursiveProductCategoryOptions')) {
	/**
	 * @param $data
	 * @param $selections
	 * @param $owner_id
	 * @param $parent_id
	 * @param $tab
	 *
	 * @return string
	 */
	function getRecursiveProductCategoryOptions($data = null, $selections = null, $owner_id = null, $parent_id = null, $tab = null, $levelSetting = null)
	{
		$html = "";

		foreach($data as $val) {
			if($levelSetting !== null && (int) $val['level'] > (int) $levelSetting) {
				continue;
			}
			$selected = is_array($selections)
				? in_array($val['id'], $selections)
				: ($val['id'] == $selections);
			if($val['parent_id'] == $parent_id && $val['id'] !== $owner_id) {
				if($selected) {
					$html .= "<option value='" . $val['id'] . "' selected>" . $tab . "&nbsp" . $val['name'] . "</option>";
				} else {
					$html .= "<option value='" . $val['id'] . "'>" . $tab . "&nbsp" . $val['name'] . "</option>";
				}
				if(!empty($val['children'])) {
					$html .= getRecursiveProductCategoryOptions($val['children'], $selections,
						$owner_id,
						$val['id'], $tab . "&nbsp-", $levelSetting);
				}
			}
		}

		return $html;
	}
}
if(!function_exists('getRecursiveProductCategoryOptionsWithSlug')) {
	/**
	 * @param $data
	 * @param $selections
	 * @param $owner_id
	 * @param $parent_id
	 * @param $tab
	 *
	 * @return string
	 */
	function getRecursiveProductCategoryOptionsWithSlug($data = null, $selections = null, $owner_id = null, $parent_id = null, $tab = null, $levelSetting = null)
	{
		$html = "";

		foreach($data as $val) {
			if($levelSetting !== null && (int) $val['level'] > (int) $levelSetting) {
				continue;
			}
			$selected = is_array($selections)
				? in_array($val['id'], $selections)
				: ($val['id'] == $selections);
			if($val['parent_id'] == $parent_id && $val['id'] !== $owner_id) {
				if($selected) {
					$html .= "<option value='" . $val['slug'] . "' selected>" . $tab . "&nbsp" . $val['name'] . "</option>";
				} else {
					$html .= "<option value='" . $val['slug'] . "'>" . $tab . "&nbsp" . $val['name'] . "</option>";
				}
				if(!empty($val['children'])) {
					$html .= getRecursiveProductCategoryOptionsWithSlug($val['children'],
						$selections,
						$owner_id,
						$val['id'], $tab . "&nbsp-", $levelSetting);
				}
			}
		}

		return $html;
	}
}
if(!function_exists('getStatus')) {
	/**
	 * @param $status
	 *
	 * @return string
	 */
	function getStatus($status)
	{
		return Status::getStatus($status);
	}
}
if(!function_exists('getMainImage')) {
	/**
	 * @param $data_images
	 *
	 * @return mixed
	 */
	function getMainImage($data_images)
	{
		$image = '';
		if(!empty($data_images)) {
			$images = json_decode($data_images ?? "[]");
			$image  = $images->main ?? '';
		}

		return $image;
	}
}

if(!function_exists('currency_format')) {
	/**
	 * @param $number
	 * @param $suffix
	 *
	 * @return string|void
	 */
	function currency_format($number, $suffix = 'đ')
	{
		if(!empty($number)) {
			return number_format($number, 0, ',', '.') . "{$suffix}";
		}

		return 0 . "{$suffix}";
	}
}

if(!function_exists('storageFile')) {
	/**
	 * @param $file
	 * @param $file_name
	 * @param $upload_address
	 *
	 * @return string
	 */
	function storageFile($file, $file_name, $upload_address)
	{
		$file->storeAs('public/upload/' . $upload_address, $file_name);

		return 'storage/upload/' . $upload_address . '/' . $file_name;
	}
}

if(!function_exists('storageBase64File')) {
	/**
	 * @param $base64
	 * @param $file_name
	 * @param $upload_address
	 *
	 * @return string
	 */
	function storageBase64File($base64, $upload_address)
	{
		$imageCode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
		$extension = explode('/', mime_content_type($base64))[1];
		if(!file_exists($upload_address)) {
			File::makeDirectory(public_path() . '/' . $upload_address, 0777, true);
		}
		$fileName = $upload_address . '/' . Str::uuid() . '.' . $extension;
		file_put_contents($fileName, $imageCode);
		$file = new FileUpload($fileName);

		return '/' . $file->getPathname();
	}
}

if(!function_exists('pageSEO')) {
	/**
	 * @param $meta_title
	 * @param $meta_description
	 * @param $meta_keyword
	 * @param $canonical
	 *
	 * @return void
	 */
	function pageSEO($meta_title = null, $meta_description = null, $meta_keyword = null, $meta_image = null, $canonical = null)
	{
		session()->put([
			'meta_title'       => $meta_title,
			'meta_description' => $meta_description,
			'meta_keyword'     => $meta_keyword,
			'meta_image'       => $meta_image,
			'canonical'        => $canonical,
		]);
	}
}

if(!function_exists('replaceOldUrl')) {
	function replaceOldUrl($data)
	{
		$urlOldStr = str_replace('"', '',
			json_encode(env('APP_URL_OLD', 'https://basics.nexttop.org')));
		if(Str::contains($data, $urlOldStr)) {
			$data = str_replace($urlOldStr, '', $data);
		}
		$urlStr = str_replace('"', '', json_encode(env('APP_URL')));
		if(Str::contains($data, $urlStr)) {
			$data = str_replace($urlStr, '', $data);
		}

		return $data;
	}
}