<?php

namespace Modules\User\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\User\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    protected function hookFilterResultCustom($query, $filters, $perPage)
    {
        if (!empty($filters['name'])) {
            $query = $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['role_id'])) {
            $query = $query->where('role_id', $filters['role_id']);
        }
        if (!empty($filters['status'])) {
            $query = $query->where('status', $filters['status']);
        }

        return $query->paginate($perPage);
    }
}
