<?php

namespace Modules\Base\Models;

class Slug extends BaseModel
{
    public $timestamps = true;

    protected $table = 'slugs';

    protected $primaryKey = "id";

    protected $guarded = [];

    public function sluggable()
    {
        return $this->morphTo();
    }
}
