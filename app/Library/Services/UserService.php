<?php


namespace App\Library\Services;

use App\Country;
use App\Library\Services\Contracts\UserContract;
use App\User;

class UserService implements UserContract
{

    public function index($page, $param)
    {
        $users = '';
        if ($param == 'players'){
            $users = User::withTrashed()->has('player')->get();
        }elseif ($param == 'viewers'){
            $users = User::withTrashed()->get();
        } else {
            abort(404);
        }
        return view($page, ['users' => $users]);
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($page)
    {
        return view($page);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page, $id)
    {
        $user = User::find($id);
        $full_name_sql = $user->full_name;
        $full_name = array_key_exists('first_name',$full_name_sql)?$full_name_sql['first_name']:'';
        $full_name = array_key_exists('middle_name',$full_name_sql)?$full_name.' '.$full_name_sql['middle_name']:$full_name;
        $full_name = array_key_exists('last_name',$full_name_sql)?$full_name.' '.$full_name_sql['last_name']:$full_name;



        return view($page,['user'=>$user,'full_name'=>$full_name]);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($page, $id)
    {
        $user = User::find($id);
        $countries = Country::all();
        return view($page,['user'=>$user,'countries'=>$countries]);

    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($request, $id)
    {
        User::where('id',$id)->update([
            'full_name' => json_encode([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name
            ]),
            'verified' => $request -> verified ? '1' : '0',
            'additional' => $request -> additional ? json_encode([
                'info'=>$request->additional
            ]) : null
        ]);
        return redirect()->back();
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus($request)
    {
        if ($request->status == 0) {
            $user = User::findOrFail($request->id);
            $user->delete();
        } elseif ($request->status == 1) {
            $user = User::withTrashed()->findOrFail($request->id);
            $user->deleted_at = Null;
            $user->save();
        } else {
            abort(404);
        }
        return response()->json(['success' => 'Status change successfully.'], 200);
    }

}
