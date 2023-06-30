<?php

namespace App\Http\Controllers\Users;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * validates updating profile info
     * @param array $data
     */
    protected function profileValidate(array $data)
    {
        Validator::make($data, [
            'nickname' => ['required', 'string', 'max:50'],
            'first_name'=>['string', 'max:50'],
            'last_name'=>['string', 'max:50'],
        ]);
    }

    /**
     * redirects to users own profile page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $subscriptions = $user->subscriptions;
        return view('user_dashboard.profile',
            [
                'page'=>'public_profile',
                'user' => $user ,
                'followers' => $followers,
                'followings' => $followings,
                'subscriptions' => $subscriptions
            ]);
    }

    /**
     * user dashboard page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(){
        $user = Auth::user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $subscriptions = $user->subscriptions;
        return view('user_dashboard.dashboard',
            [
                'page'=>'dashboard',
                'followers' => $followers,
                'followings' => $followings,
                'subscriptions' => $subscriptions
            ]);
    }

    /**
     * redirects to profile edit page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $countries = Country::all();
        $user = User::where('id',auth()->id())->with('city','country','state')->first();
        $states = null;
        if($user->country_id){
            $states = State::where('country_id',$user->country_id)->get();
        }
        $cities = null;
        if($user->state_id){
            $cities = City::where('state_id',$user->state_id)->get();
        }

        return view('user_dashboard.basic_info',['page' => 'basic','user' => $user,'countries' => $countries,'states' => $states,'cities' => $cities]);
    }

    /**
     * updates users profile info
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        dd($request->all());
        $this->profileValidate($request->all());
        $destinationPath = storage_path('/app/public/user/images/avatar');
        $image_name = Auth::user()->avatar;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move($destinationPath, $image_name);
        }
        User::where('id',auth()->id())->update([
            'avatar'=>$image_name,
            'full_name'=>['first_name'=>$request->first_name, 'last_name'=>$request->last_name],
            'nickname'=>$request->nickname,
            'country_id'=>$request->country ?$request->country: null,
            'state_id'=>$request->state ?$request->state : null,
            'city_id'=>$request->city ?$request->city : null,
            'additional'=>['about' => $request->about]
        ]);
        return back()->with('success','profile info updated successfully');
    }

    /**
     * returns states by country id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStates(Request $request){
        $states = State::where('country_id',$request->country_id)->get();
        return response()->json([
            'request' =>$request->country_id,
            'success' => 'success',
            'states' => $states
        ]);


    }

    /**
     * returns users by nickname part
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersByNickname(Request $request){
        $nickname = $request->nickname;
        $users = User::where('nickname', 'like', $nickname.'%')->where('id','!=',auth()->id())->limit(10)->get();

        return response()->json([
            'success'=>'success',
            'users'=>$users
        ]);
    }
    /**
     * returns cities by state id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities(Request $request){
        $cities = City::where('state_id',$request->state_id)->get();
        return response()->json([
            'request' =>$request->state_id,
            'success' => 'success',
            'cities' => $cities
        ]);
    }

    /**
     * checks users new nickname availability
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkNickname(Request $request){
        $nickname = $request->nickname;
        if(User::where('nickname',$nickname)->where('id','!=',auth()->id())->exists()){
            return response()->json([
                'success'=>'success',
                'availability'=>false
            ]);
        }
        return response()->json([
            'success'=>'success',
            'availability'=>true
        ]);
    }

    public function getNotifications(){
        $notifications = auth()->user()->unreadNotifications;
        return response()->json([
            'success'=>'success',
            'notifications'=>$notifications
        ]);
    }

    /**
     * marks users notification as read
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json([
            'success'=>'success',
        ]);
    }



}
