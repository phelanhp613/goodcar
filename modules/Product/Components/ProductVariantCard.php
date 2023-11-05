<?php

namespace Modules\Product\Components;

use Illuminate\View\Component;

class ProductVariantCard extends Component
{
	public $variant;

	public function __construct($variant)
	{
		$this->variant = $variant;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Product::components.product_variant_card');
	}
}
