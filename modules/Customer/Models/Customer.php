<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;

class Customer extends BaseModel {
    use SoftDeletes;

    protected $table = "customers";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;
}
