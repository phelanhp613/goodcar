<?php

namespace Modules\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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


		return view("Dashboard::index");
	}
}
