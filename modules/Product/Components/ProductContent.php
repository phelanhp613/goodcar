<?php

namespace Modules\Product\Components;

use Illuminate\View\Component;

class ProductContent extends Component
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
		return view('Product::components.product_content');
	}
}
