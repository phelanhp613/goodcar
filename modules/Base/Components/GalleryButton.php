<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class GalleryButton extends Component
{
	public function __construct() {}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.gallery.gallery_button');
	}
}
