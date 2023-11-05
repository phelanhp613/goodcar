<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariant;

class OrderDetail extends BaseModel
{
	use SoftDeletes;

	public $timestamps = TRUE;

	protected $table = "order_details";

	protected $primaryKey = "id";

	protected $guarded = [];

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function productVariant() {
		return $this->belongsTo(ProductVariant::class, 'product_variant_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product() {
		return $this->belongsTo(Product::class, 'product_id');
	}
}
