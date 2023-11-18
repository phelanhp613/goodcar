<?php

namespace Modules\Post\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Post\Requests\PostRequest;
use Modules\Base\Controllers\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Modules\Post\Repositories\PostService;


class PostController extends BaseController
{
    private $moduleService;


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(PostService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->all();
        $statuses = Status::getStatuses();
        $data = $this->moduleService->list($filter);

        return view("Post::index", compact('data', 'filter', 'statuses'));
    }

    /**
     * @return Factory|View
     */
    public function getCreate()
    {
        $statuses   = Status::getStatuses();
        return view(
            'Post::create',
            compact('statuses')
        );
    }

    /**
     * @param PostRequest $request
     *
     * @return RedirectResponse
     */
    public function postCreate(PostRequest $request)
    {
        $data = $this->moduleService->create($request->all());

        return redirect()->back();
    }



    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function getUpdate(Request $request, $id)
    {
        $statuses = Status::getStatuses();
        $data = $this->moduleService->detail($id);

        return view('Post::update', compact('data', 'statuses'));
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(PostRequest $request, $id)
    {
        $this->moduleService->update($id, $request->all());

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->moduleService->delete($id);

        return back();
    }
}
