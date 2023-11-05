<?php

namespace Modules\Product\Components;

use Illuminate\View\Component;

class ProductCard extends Component
{
	public $product;

	public function __construct($product)
	{
		$this->product = $product;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Product::components.product_card');
	}
}
