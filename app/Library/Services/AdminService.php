<?php


namespace App\Library\Services;


use App\Admin;
use App\Library\Services\Contracts\AdminsContract;
use App\Notifications\AdminsNotification;
use App\Role;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AdminService implements AdminsContract
{
    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($page, $id)
    {
        $role = Role::whereNotIn('id', [1])->where('id', $id)->with('admins');
        $admins = $role->first();
        return view($page, ['administrators' => $admins->admins]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($data)
    {
        $pass = str_shuffle(rand(1000, 10000).Str::random(8));
        $full_name = [
          'first_name'  => $data->first_name,
          'last_name'   => $data->last_name,
          'middle_name' => isset($data->middle_name) ? $data->middle_name : null
        ];

        if($data->avatar) {
            $fileAvatar = $data->avatar;
            $avatar = time() . '_' . $fileAvatar->getClientOriginalName();
            $avatarPath = storage_path('app/public/admin/admin_avatars');
            $fileAvatar->move($avatarPath, $avatar);
        }
        else $avatar = 'avatar.png';
        $admin = new Admin();
        $admin->full_name = $full_name;
        $admin->role_id = $data->role_id;
        $admin->email = $data->email;
        $admin->additional = isset($data->additional) ? [ 'en' => $data->additional] : null ;
        $admin->country_id = $data->country;
        $admin->state_id = $data->state;
        $admin->city_id = $data->city;
        $admin->password = bcrypt($pass);
        $admin->avatar = $avatar;
        $admin->save();

        $event_data = 'test data';
        Notification::send(Admin::find(1), new AdminsNotification($event_data));
        event(new \App\Events\AdminNotification(['username' => 'superadmin', 'data' => $event_data]));
        return redirect()->route('admins.view', ['id' => $data->role_id])->with(['success' => 'Administrator was successfully created!']);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($page, $id)
    {
        $role = Role::whereNotIn('id', [1])->findOrFail($id);
        return view($page, ['role' => $role]);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page, $id)
    {
        return view($page, ['admin' => Admin::findOrFail($id)]);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($page, $id)
    {
        $admin = Admin::findOrFail($id);
        return view($page, ['admin' => $admin]);
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($data, $id)
    {
        $admin = Admin::findOrFail($id);
        $full_name = [
            'first_name'  => $data->first_name,
            'last_name'   => $data->last_name,
            'middle_name' => isset($data->middle_name) ? $data->middle_name : null
        ];

        if($data->avatar) {
            $fileAvatar = $data->avatar;
            $avatar = time() . '_' . $fileAvatar->getClientOriginalName();
            $avatarPath = storage_path('app/public/admin/admin_avatars');
            $fileAvatar->move($avatarPath, $avatar);
            if ($data->old_avatar != 'avatar.png') {
                unlink('storage/admin/admin_avatars/'. $data->old_avatar);
            }
        }
        else $avatar = $data->old_avatar;

        $admin->update([
            'full_name'  => $full_name,
            'role_id'    => $admin->role_id,
            'email'      => $data->email,
            'additional' => isset($data->additional) ? [ 'en' => $data->additional] : null,
            'avatar'     => $avatar
        ]);

        return redirect()->route('admins.view', $admin->role_id)->with(['success' => 'Data successfully updated!']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->avatar != 'avatar.png') {
            unlink('storage/admin/admin_avatars/'. $admin->avatar);
        }
        $admin->delete();
        return redirect()->back();
    }
}
