<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class CountDownTimer extends Component
{
	public $date;

	/**
	 * @param $date
	 */
	public function __construct($date)
	{
		$this->date = $date;
	}

	/**
	 * @return \Closure|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Htmlable|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
	 */
	public function render()
	{
		return view('Base::components.ui.count_down_timer');
	}
}
