<?php

namespace Modules\Product\Components;

use Illuminate\View\Component;

class ProductCardFlashSale extends Component
{
	public $product;

	public $isSlider;

	public function __construct($product, $isSlider = false)
	{
		$this->product = $product;
		$this->isSlider  = $isSlider;
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\View\View|string
	 */
	public function render()
	{
		return view('Product::components.product_card_flash_sale');
	}
}
