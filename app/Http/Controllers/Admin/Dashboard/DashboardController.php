<?php

namespace App\Http\Controllers\admin\Dashboard;

use App\Country;
use App\Http\Controllers\Controller;
use App\Role;
use App\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function notifications(){
        return view('dashboard.notifications');
    }

//    public function sliderPage(){
//        $countries = Country::all();
//        return view('dashboard.slider.create',['countries'=>$countries]);
//    }
//
//    public function addSlider(Request $request){
//        $destinationPath = storage_path('/app/public/user/images/slider');
//        $image = $request->file('image');
//        $image_name = time().'_'.$image->getClientOriginalName();
//        $image->move($destinationPath, $image_name);
//        Slider::create([
//            'country_id' => $request->country,
//            'description' => $request->description,
//            'title' => $request->title,
//            'image' => $image_name
//        ]);
//        return back();
//    }
}
