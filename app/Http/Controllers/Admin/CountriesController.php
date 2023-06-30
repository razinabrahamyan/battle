<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * CountriesController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getStates(Request $request)
    {
        return Country::findOrFail($request->id)->states()->select('id', 'state->en as name')->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCities(Request $request)
    {
        return State::findOrFail($request->id)->cities()->select('id', 'city->en as name')->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getState(Request $request)
    {
        return State::where('id', $request->id)->select('id', 'state->en as name')->firstOrFail();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCity(Request $request)
    {
        return City::where('id', $request->id)->select('id', 'city->en as name')->firstOrFail();
    }
}
