<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class ImageInput extends Component
{

	public $id;

	public $name;

	public $value;

	public function __construct($id, $name, $value)
	{
		$this->id    = $id;
		$this->name  = $name;
		$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.input_image');
	}
}
