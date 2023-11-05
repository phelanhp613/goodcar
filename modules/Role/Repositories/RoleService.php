<?php

namespace Modules\Role\Repositories;

use Modules\Base\Repositories\BaseServiceInterface;
use Exception;

class RoleService implements BaseServiceInterface
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getArray() {
        return $this->roleRepository->getArray();
    }

    public function list($data)
    {
        return $this->roleRepository->paginate($data);
    }

    public function create($data)
    {
        try {
            $this->roleRepository->create($data);
            session()->flash('success', trans('Created successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Created error.'));
        }
    }

    public function detail($id)
    {
        return $this->roleRepository->detailById($id);
    }

    public function update($id, $data)
    {
        try {
            $this->roleRepository->updateById($id, $data);
            session()->flash('success', trans('Updated successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Updated error.'));
        }
    }

    public function delete($id)
    {
        try {
            $this->roleRepository->deleteById($id);
            session()->flash('success', trans('Deleted successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Deleted error.'));
        }
    }
}
