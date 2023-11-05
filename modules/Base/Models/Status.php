<?php

namespace Modules\Base\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

/**
 * Class Status
 * @package Modules\Base\Model
 */
class Status {

	const STATUS_PENDING  = 2;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;

    /**
     * @param $status
     * @return array|Application|Translator|string
     */
    public static function getStatus($status){
        $name = '';
        switch($status){
            case self::STATUS_ACTIVE:
                $name = trans('Active');
                break;
            case self::STATUS_INACTIVE:
                $name = trans('Inactive');
                break;
            case self::STATUS_PENDING:
                $name = trans('Pending');
                break;
        }

        return $name;
    }

    /**
     * @return array
     */
    public static function getStatuses(){
        return [
            self::STATUS_ACTIVE   => trans('Active'),
            self::STATUS_INACTIVE => trans('Inactive')
        ];
    }
}
