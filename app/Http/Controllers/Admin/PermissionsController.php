<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\ExtraModels\Permissions;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    /**
     * PermissionsController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.permissions.index');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getPermissions(Request $request)
    {
        $role = Role::find($request->id)->permissions()->select('name', 'method')->get();
        $grouped = $role->groupBy('name');
        $count = [];
        foreach ($grouped as $key => $item)
        {
            $count[$key] = count($item);
        }
        return [$role, $count];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPermissions(Request $request)
    {
        Validator::make($request->all(),[
            'role' => 'required|gt:0',
        ],[
            'role.gt' => 'This field is required'
        ])->validate();
        $role = Role::find($request->role);
        $role->permissions()->detach();
        $permissions = new Permissions;
        if(isset($request->permissions))
        {
            $permissions_array = [];
            foreach ($request['permissions'] as $name => $item)
            {
                foreach ($item as $index => $value)
                {
                    $permission = $permissions->where('name', $name)->where('method', $index)->first();
                    array_push($permissions_array, $permission);
                }
            }
            $role->permissions()->saveMany($permissions_array);
        }

        return back()->with('current_role', $role->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setRole(Request $request)
    {
        Validator::make($request->all(),[
            'id' => 'required',
            'admin' => 'required',
        ])->validate();
        $admin = Admin::find($request->admin);
        if ($admin->roles()->sync($request->id, $request->admin))
        {
            return response()->json('success', 201);
        }
        return response()->json('error', 422);
    }
}
