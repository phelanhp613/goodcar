<?php

namespace Modules\Product\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Product\Models\Product;

class ProductRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Product();
	}

	public function detailById($id)
	{
		return $this->model->with(['category', 'tags', 'variants' => function($qv) {
			$qv->with('attributes');
		}])->find($id);
	}

	protected function hookFilterResultCustom($query, $filters, $perPage)
	{
		$query = $query->with(['category', 'tags', 'createdBy', 'variants']);
		if(!empty($filters['name'])) {
			$query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
		}
		if(!empty($filters['sku'])) {
			$query = $query->where('sku', 'LIKE', '%' . $filters['sku'] . '%');
		}
		if(!empty($filters['keyword'])) {
			$query = $query->where(function($q) use ($filters) {
				$q->where('name', 'LIKE', '%' . $filters['keyword'] . '%');
				$q->orWhereHas('variants', function($vqq) use ($filters) {
					$vqq->where('sku', 'LIKE', '%' . $filters['keyword'] . '%');
				});
			});
		}
		if(!empty($filters['status'])) {
			$query = $query->where('status', $filters['status']);
		}
		if(!empty($filters['product_category_id'])) {
			$query = $query->orWhere('product_category_id', $filters['product_category_id'])
			               ->orWhereJsonContains('product_category_ids',
				               $filters['product_category_id']);
		}

		$query = $query->orderBy('featured', 'desc');

		return $query->paginate($perPage);
	}
}
