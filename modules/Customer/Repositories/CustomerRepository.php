<?php

namespace Modules\Customer\Repositories;

use Modules\Base\Repositories\BaseRepository;
use Modules\Customer\Models\Customer;

class CustomerRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new Customer();
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
