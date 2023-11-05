<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;

class Order extends BaseModel
{
	use SoftDeletes;

	const STATUS_UNCONFIRMED = -1;

	const STATUS_PENDING = 2;

	const STATUS_INACTIVE = 0;

	const STATUS_ACTIVE = 1;

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
		$name = '';
		switch($status) {
			case self::STATUS_ACTIVE:
				$name = trans('Accepted');
				break;
			case self::STATUS_INACTIVE:
				$name = trans('Abort');
				break;
			case self::STATUS_PENDING:
				$name = trans('Pending');
				break;
			case self::STATUS_UNCONFIRMED:
				$name = trans('Unconfirmed');
				break;
		}

		return $name;
	}

	/**
	 * @return array
	 */
	public static function getStatuses()
	{
		return [
			self::STATUS_ACTIVE      => trans('Accepted'),
			self::STATUS_INACTIVE    => trans('Abort'),
			self::STATUS_PENDING     => trans('Pending'),
			self::STATUS_UNCONFIRMED => trans('Unconfirmed'),
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
