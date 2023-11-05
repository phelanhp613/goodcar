<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class SortIcon extends Component
{
	public $column;

	public $direction;

	public $route;

	public function __construct($route, $column, $direction)
	{
		$this->column    = $column;
		$this->direction = $direction;
		$this->route = $route;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.ui.sort_icon');
	}
}
