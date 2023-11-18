<?php

namespace Modules\Post\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Post\Models\Post;

class PostRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Post();
    }

    public function getArray()
    {
        return $this->model->getArray();
    }

    protected function hookFilterResultCustom($query, $filters, $perPage)
    {
        if (!empty($filters['name'])) {
            $query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }
        return $query->paginate($perPage);
    }
}
