<?php

namespace Modules\Setting\Controllers;

use Barryvdh\Elfinder\ElfinderController as BaseElfinderController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ElfinderController extends BaseElfinderController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('Setting::file-management.file-management');
    }

    /**
     * @return Application|Factory|View
     */
    public function CKEditorIndex()
    {
        return view('Setting::file-management.ckeditor4');
    }
}
