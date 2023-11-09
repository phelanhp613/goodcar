<?php

namespace Modules\Product\Models;

use Modules\Base\Models\BaseModel;

class ProductAttribute extends BaseModel
{
	public $timestamps = true;

	protected $table = "product_attributes";

	protected $primaryKey = "id";

	protected $guarded = [];

	protected static function boot()
	{
		parent::boot();

		static::deleting(function($data) {
			$data->children->each->delete();
		});
	}

	public function parent()
	{
		return $this->belongsTo(self::class, 'parent_id');
	}

	public function children()
	{
		return $this->hasMany(self::class, 'parent_id');
	}

	public function products()
	{
		return $this->belongsToMany(ProductVariant::class, 'product_values', 'attribute_id',
			'product_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function attributePivots()
	{
		return $this->hasMany(ProductValue::class, 'attribute_id');
	}
}
