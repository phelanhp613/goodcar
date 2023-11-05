<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class SelectBox extends Component
{
	public $name;

	public $option;

	public $selected;

	public $box_option;

	public function __construct($id, $name, $option, $selected = null, $class = 'form-control select2')
	{
		$this->name       = $name;
		$this->option     = $option;
		$this->selected   = $selected;
		$this->box_option = !empty($id) ? ['class' => $class, 'id' => $id] : ['class' => $class];
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.select_box');
	}
}
