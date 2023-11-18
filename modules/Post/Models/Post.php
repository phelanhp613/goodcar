<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Base\Models\Slug;

class Post extends BaseModel
{
    use SoftDeletes;

    protected $table = "post";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;


    /**
     * @return MorphOne
     */
    public function sluggable()
    {
        return $this->morphOne(Slug::class, 'sluggable');
    }
}
