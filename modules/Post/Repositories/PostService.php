<?php

namespace Modules\Post\Repositories;

use Modules\Base\Repositories\BaseServiceInterface;
use Modules\Base\Components\TextareaContentTab;
use Exception;

class PostService implements BaseServiceInterface
{
    private $moduleRepository;

    public function __construct(PostRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function getArray()
    {
        return $this->moduleRepository->getArray();
    }

    public function list($data)
    {
        return $this->moduleRepository->paginate($data);
    }

    public function create($data)
    {

        try {
            $data['content']                    = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
            $data['content']                    = replaceOldUrl($data['content']);
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
            $data['content']                    = json_encode(TextareaContentTab::setContent($data['content'] ?? []));
            $data['content']                    = replaceOldUrl($data['content']);
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
