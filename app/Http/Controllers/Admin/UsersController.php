<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Library\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        //
    }


    public function index(UserService $service, $name)
    {
        return $service->index('dashboard.users.index', $name);
    }

    /**
     *
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param UserService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(UserService $service, $id)
    {
        return $service->show('dashboard.users.show', $id);
    }

    /**
     * @param UserService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UserService $service, $id)
    {
        return $service->edit('dashboard.users.edit', $id);
    }

    /**
     * @param UserService $service
     * @param UsersRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserService $service, UsersRequest $request, $id)
    {
        return $service->update($request, $id);
    }

    /**
     * @param UserService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(UserService $service, Request $request)
    {
        return $service->changeStatus($request);
    }
}
