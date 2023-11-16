<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class RangeTwoPoint extends Component
{
	public $min;

	public $max;

	public $min_name;

	public $max_name;

	public function __construct($minName, $maxName, $min = 0, $max = 10000000000)
	{
		$this->min      = $min;
		$this->max      = $max;
		$this->min_name = $minName;
		$this->max_name = $maxName;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.range_two_point');
	}
}
