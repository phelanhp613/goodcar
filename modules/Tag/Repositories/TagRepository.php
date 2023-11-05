<?php

namespace Modules\Tag\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Tag\Models\Tag;

class TagRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }

    public function getArray()
    {
        return $this->model->query()->orderBy('name')
                                    ->pluck("name", "name")
                                    ->toArray();
    }

    protected function hookFilterResultCustom($query, $filters, $perPage)
    {
        if (!empty($filters['name'])) {
            $query = $query->where('name', 'LIKE', '%'.$filters['name'].'%');
        }
        return $query->paginate($perPage);
    }

    /**
     * @param $data
     * @return array
     */
    public function getIds($data) {
        $ids = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $tag   = $this->model->query()->firstOrCreate(['name' => $item]);
                $ids[] = $tag->id;
            }
        }

        return $ids;
    }
}
