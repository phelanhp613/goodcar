<?php

namespace Modules\Post\Models;

use App\Commons\CacheData\CacheDataService;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Models\BaseModel;
use Modules\Base\Models\Slug;
use Modules\Base\Models\Status;

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

    /**
     * @param $slug
     *
     * @return array
     */
    public function frontendData($slug)
    {
        $cacheService = new CacheDataService();
        $data         = $cacheService->get('post_' . $slug);
        if (!$data) {
            $data = self::query()
                ->where('slug', $slug)
                ->where('status', Status::STATUS_ACTIVE)
                ->first()
                ->withShortCode();

            $cacheService->cache('post_' . $slug, $data);
        }
        $view = 'Frontend::post.post_page';
        return compact('data', 'view');
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function getData($data)
    {
        $post     = $data->data;
        $cacheService = new CacheDataService();
        return [
            'data'               => $data->data,
        ];
    }
}
