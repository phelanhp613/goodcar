<?php

namespace Modules\Base\Components;

use Illuminate\View\Component;

class PostContent extends Component
{
	public $content;

	public function __construct($content)
	{
		$this->content = !empty($content) ? $content : [];
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Base::components.ui.post_content');
	}
}
