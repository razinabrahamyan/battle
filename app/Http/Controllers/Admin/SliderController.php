<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countries = Country::get();
        $sliders = Slider::get();
        return view('dashboard.slider.index', ['sliders' => $sliders, 'countries' => $countries]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::get();
        return view('dashboard.slider.create',['countries'=>$countries]);
    }

    /**
     * @param SliderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SliderRequest $request)
    {
        $destinationPath = storage_path('/app/public/user/images/slider');
        $image = $request->file('image');
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move($destinationPath, $image_name);
        Slider::create([
            'country_id' => $request->country,
            'description' => $request->description,
            'title' => $request->title,
            'image' => $image_name
        ]);
        return redirect()->route('slider.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        $country  = Country::findOrFail($slider->country_id)->country['en'];
        return view('dashboard.slider.show', ['slider' => $slider, 'country' => $country]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $slider = Slider::findOrfail($id);
        $countries = Country::get();
        return view('dashboard.slider.edit',['slider' => $slider,  'countries' => $countries] );
    }

    /**
     * @param SliderRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SliderRequest $request, $id)
    {

        $slider = Slider::findOrFail($id);

        if ($request->image){
            unlink('storage/user/images/slider/'. $slider->image);
            $destinationPath = storage_path('/app/public/user/images/slider');
            $image = $request->file('image');
            $image_name = time().'_'.$image->getClientOriginalName();
            $image->move($destinationPath, $image_name);

        }else{
            $image_name = $slider->image;
        }

        $slider->update([
            'country_id' => $request->country,
            'description' => $request->description,
            'title' => $request->title,
            'image' => $image_name
        ]);

        return redirect()->route('slider.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image != 'avatar.png') {
            unlink('storage/user/images/slider/'. $slider->image);
        }
        $slider->delete();
        return back();
    }
}
