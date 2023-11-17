<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;

class Order extends BaseModel
{
	use SoftDeletes;

	const STATUS_INACTIVE = 0;

	const STATUS_ACTIVE = 1;

	const STATUS_PENDING = 2;

	const STATUS_PREPARE = 3;

	const STATUS_READY = 4;

	const STATUS_DELIVERED = 5;

	const INVOICE_BUSINESS = 'business';

	const INVOICE_PERSONAL = 'personal';

	const INVOICE_TYPES = [
		self::INVOICE_BUSINESS => 'Business',
		self::INVOICE_PERSONAL => 'Personal',
	];

	public $timestamps = true;

	protected $table = "orders";

	protected $primaryKey = "id";

	protected $guarded = [];

	/**
	 * @param $status
	 *
	 * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
	 */
	public static function getStatus($status)
	{
		$statuses = self::getStatuses();

		return $statuses[$status];
	}

	/**
	 * @return array
	 */
	public static function getStatuses()
	{
		return [
			self::STATUS_PENDING   => trans('Pending'),
			self::STATUS_ACTIVE    => trans('Accepted'),
			self::STATUS_PREPARE   => trans('Prepare'),
			self::STATUS_READY     => trans('Ready'),
			self::STATUS_DELIVERED => trans('Delivered'),
			self::STATUS_INACTIVE  => trans('Abort'),
		];
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details()
	{
		return $this->hasMany(OrderDetail::class, 'order_id');
	}
}
