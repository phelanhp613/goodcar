<?php

namespace Modules\Product\Models;

use Modules\Base\Models\BaseModel;

class ProductValue extends BaseModel
{
    protected $table = "product_values";

    protected $primaryKey = "id";

    protected $guarded = [];

	public function variant()
	{
		return $this->belongsTo(ProductVariant::class, 'product_id');
	}

	public function attribute()
	{
		return $this->belongsTo(ProductAttribute::class, 'attribute_id');
	}
}
