<?php

namespace Modules\User\Repositories;

use Modules\Base\Repositories\BaseServiceInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService implements BaseServiceInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list($data)
    {
        return $this->userRepository->paginate($data, 20, 'name');
    }

    public function create($data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $this->userRepository->create($data);
            session()->flash('success', trans('Created successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Created error.'));
        }
    }

    public function detail($id)
    {
        return $this->userRepository->detailById($id);
    }

    public function update($id, $data)
    {
        try {
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }
            $this->userRepository->updateById($id, $data);
            session()->flash('success', trans('Updated successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Updated error.'));
        }
    }

    public function delete($id)
    {
        try {
            $this->userRepository->deleteById($id);
            session()->flash('success', trans('Deleted successfully.'));
        } catch (Exception $exception) {
            session()->flash('error', trans('Deleted error.'));
        }
    }
}


