<?php

namespace Modules\Customer\Repositories;

use Modules\Base\Repositories\BaseServiceInterface;
use Exception;

class CustomerService implements BaseServiceInterface
{
    private $moduleRepository;

    public function __construct(CustomerRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function getArray() {
        return $this->moduleRepository->getArray();
    }

    public function list($data)
    {
        return $this->moduleRepository->paginate($data);
    }

    public function create($data)
    {
        try {
            $this->moduleRepository->create($data);
            session()->flash('success', trans('Created successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Created error.'));
        }
    }

    public function detail($id)
    {
        return $this->moduleRepository->detailById($id);
    }

    public function update($id, $data)
    {
        try {
            $this->moduleRepository->updateById($id, $data);
            session()->flash('success', trans('Updated successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Updated error.'));
        }
    }

    public function delete($id)
    {
        try {
            $this->moduleRepository->deleteById($id);
            session()->flash('success', trans('Deleted successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Deleted error.'));
        }
    }
}
