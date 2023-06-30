<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Library\Services\AdminService;
use App\Role;


class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
//        $this->getAction(request()->route()->parameter('id'), request()->route()->getActionMethod());

        $this->middleware(function ($request, $next) {
            $auth_admin = Admin::find(auth()->guard('admin')->id());
            switch (request()->route()->parameter('id')) {
                case 2:
                    $auth_admin->authorizeRoles(['superadmin']) ? true : abort(404);
                    break;
                case 3:
                    $auth_admin->authorizeRoles(['superadmin', 'admin']) ? true : abort(404);
                    break;
                case 4:
                    $auth_admin->authorizeRoles(['superadmin', 'admin', 'moderator']) ? true : abort(404);
                    break;
                case 5:
                    $auth_admin->authorizeRoles(['superadmin', 'admin', 'moderator', 'sponsor']) ? true : abort(404);
            }
            return $next($request);
        });
    }

    /**
     * @param $id
     * @param $method
     */
    private function getAction($id, $method)
    {
       $name = Role::find($id)->name;
       if ($method == 'index') { $method = 'view'; }
       $this->middleware('can:'.$name.'.'.$method);
    }

    /**
     * @param AdminService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AdminService $service, $id)
    {
        return $service->index('dashboard.admins.index', $id);
    }

    /**
     * @param AdminService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(AdminService $service, $id)
    {
        return $service->create('dashboard.admins.create', $id);
    }

    /**
     * @param AdminService $service
     * @param AdminRequest $adminRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminService $service, AdminRequest $adminRequest)
    {
        return $service->store($adminRequest);
    }

    /**
     * @param AdminService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(AdminService $service, $id)
    {
        return $service->show('dashboard.admins.show', $id);
    }

    /**
     * @param AdminService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminService $service, $id)
    {
        return $service->edit('dashboard.admins.edit', $id);
    }

    /**
     * @param AdminService $service
     * @param AdminRequest $adminRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminService $service, AdminRequest $adminRequest, $id)
    {
        return $service->update($adminRequest, $id);
    }

    /**
     * @param AdminService $service
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminService $service, $id)
    {
        return $service->destroy($id);
    }
}
