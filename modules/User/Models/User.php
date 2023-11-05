<?php

namespace Modules\User\Models;

use App\Models\User as BaseUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Role\Models\Role;

class User extends BaseUser {

    use SoftDeletes;

    protected $primaryKey = "id";

    protected $guarded = [];

    protected $dates = ["deleted_at"];

    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
