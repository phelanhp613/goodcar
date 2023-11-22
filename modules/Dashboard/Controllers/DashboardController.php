<?php

namespace Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Order\Models\Order;


class DashboardController extends Controller
{
	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		# parent::__construct();
	}

	public function index(Request $request)
	{
		// dd($this->smsService->sendNormal());
		$now           = Carbon::now();
		$weekDataOrder = Order::query()->whereBetween('created_at', [
			formatDate($now->startOfWeek()->startOfDay(), 'Y-m-d H:i:s'),
			formatDate($now->endOfWeek()->endOfDay(), 'Y-m-d H:i:s'),
		])->get();
		$weekData      = [];
		for($i = 1; $i <= 6; $i ++) {
			$weekData["Thứ " . $i+1] = 0;
		}
		foreach($weekDataOrder as $item) {
			$key            = "Thứ " . $item->created_at->dayOfWeek+1;
			$weekData[$key] = $weekData[$key] + $item->total_price;
		}

		$monthDataOrder = Order::query()->whereBetween('created_at', [
			formatDate($now->startOfMonth()->startOfDay(), 'Y-m-d H:i:s'),
			formatDate($now->endOfMonth()->endOfDay(), 'Y-m-d H:i:s'),
		])->get();
		$monthData      = [];
		for($i = 1; $i <= $now->daysInMonth; $i ++) {
			$monthData["Ngày $i"] = 0;
		}
		foreach($monthDataOrder as $item) {
			$key             = "Ngày " . $item->created_at->day;
			$monthData[$key] = $monthData[$key] + $item->total_price;
		}

		$yearDataOrder = Order::query()->whereBetween('created_at', [
			formatDate($now->startOfYear()->startOfDay(), 'Y-m-d H:i:s'),
			formatDate($now->endOfYear()->endOfDay(), 'Y-m-d H:i:s'),
		])->get();
		$yearData      = [];
		$year          = $now->year;
		for($month = 1; $month <= 12; $month ++) {
			for($i = 1; $i <= $now->month($month)->daysInMonth; $i ++) {
				$yearData["Ngày $i-$month-$year"] = 0;
			}
		}
		foreach($yearDataOrder as $item) {
			$key            = "Ngày " . formatDate($item->created_at, 'd-m-Y');
			$yearData[$key] = $yearData[$key] + $item->total_price;
		}

		return view("Dashboard::index", [
			'weekData'  => json_encode($weekData),
			'monthData' => json_encode($monthData),
			'yearData'  => json_encode($yearData),
		]);
	}
}
