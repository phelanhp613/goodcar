<?php

namespace Modules\Frontend\Repositories;

use App\Commons\CacheData\CacheDataService;
use Modules\Base\Models\Status;
use Modules\Product\Repositories\ProductRepository;

class FrontendService
{

	protected FrontendRepository $moduleRepository;

	protected CacheDataService $cacheService;

	protected ProductRepository $productRepository;

	public function __construct(
		FrontendRepository $frontendRepository,
		ProductRepository $productRepository,
		CacheDataService $cacheDataService,
	) {
		$this->moduleRepository  = $frontendRepository;
		$this->cacheService      = $cacheDataService;
		$this->productRepository = $productRepository;
	}

	public function getData($dataSlug)
	{
		return $dataSlug->model->getData($dataSlug);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function searchProduct($data)
	{
		$data['status'] = Status::STATUS_ACTIVE;

		return $this->productRepository->paginate($data);
	}
}
