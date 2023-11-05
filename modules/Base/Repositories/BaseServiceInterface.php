<?php

namespace Modules\Base\Repositories;

interface BaseServiceInterface
{
    public function list($data);

    public function create($data);

    public function detail($id);

    public function update($id, $data);

    public function delete($id);
}
