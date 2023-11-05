<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class UploadFileMultiple extends Component
{
	public $name;

	public $acceptSize;

	public function __construct($name = 'images', $acceptSize = 800)
	{
		$this->acceptSize = $acceptSize;
		$this->name       = $name;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.form.upload_file_multiple');
	}
}
