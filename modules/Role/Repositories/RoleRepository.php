<?php

namespace Modules\Role\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Role\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Role();
    }

    public function getArray()
    {
        return $this->model->getArray();
    }

    protected function hookFilterResultCustom($query, $filters, $perPage)
    {
        if (!empty($filters['name'])) {
            $query = $query->where('name', 'LIKE', '%'.$filters['name'].'%');
        }
        return $query->paginate($perPage);
    }
}
