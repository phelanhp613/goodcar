<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class Gallery extends Component
{
	public $images;

	public $action;

	public function __construct($images, $action)
	{
		$this->action = $action;
		$this->images = json_decode($images ?? '[]', 1) ?? [];
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.gallery.gallery');
	}
}
