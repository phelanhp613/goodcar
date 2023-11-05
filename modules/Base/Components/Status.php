<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class Status extends Component
{
	public $status;

	public function __construct($status)
	{
		$this->status = $status;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.ui.status');
	}
}
