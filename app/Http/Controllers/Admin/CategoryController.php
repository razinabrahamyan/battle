<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Library\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param CategoryService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CategoryService $service)
    {
        return $service->index('dashboard.categories.index');

    }

    /**
     * @param CategoryService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CategoryService $service)
    {
        return $service->create('dashboard.categories.create');
    }

    /**
     * @param CategoryService $service
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryService $service, CategoryRequest $request)
    {
        return $service->store($request);
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //TODO
    }

    /**
     * @param CategoryService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoryService $service, $id)
    {
        return $service->edit('dashboard.categories.edit', $id);
    }

    /**
     * @param CategoryService $service
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryService $service, CategoryRequest $request, $id)
    {
        return $service->update($request, $id);
    }

    /**
     * @param CategoryService $service
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CategoryService $service, $id)
    {
        return $service->destroy($id);
    }
}
