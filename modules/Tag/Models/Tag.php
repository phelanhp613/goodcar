<?php

namespace Modules\Tag\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Base\Models\BaseModel;
use Modules\Product\Models\Product;

class Tag extends BaseModel {
    protected $table = "tags";

    protected $primaryKey = "id";

    protected $guarded = [];

    public $timestamps = true;

    /**
     * @param $data
     * @return array
     */
    public static function createTags($data) {
        $ids = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $tag   = self::query()->firstOrCreate($item);
                $ids[] = $tag->id;
            }
        }

        return $ids;
    }

    /**
     * @return MorphToMany
     */
    public function products() {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
