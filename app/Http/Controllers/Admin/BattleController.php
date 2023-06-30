<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BattleRequest;
use Illuminate\Http\Request;
use App\Library\Services\BattleService;
use Illuminate\Support\Facades\Session;

class BattleController extends Controller
{
    /**
     * BattleController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param BattleService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(BattleService $service)
    {
        return $service->index('dashboard.battles.index');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    /**
     * @param BattleService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(BattleService $service, $id)
    {
        return $service->show('dashboard.battles.show', $id);
    }

    /**
     * @param BattleService $service
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(BattleService $service, $id)
    {
        return $service->edit('dashboard.battles.edit', $id);
    }

    /**
     * @param BattleService $service
     * @param BattleRequest $request
     * @param $id
     */
    public function update(BattleService $service, BattleRequest $request, $id)
    {
        return $service->update($request, $id);

    }

    /**
     * @param BattleService $service
     * @param $id
     * @throws \Exception
     */
    public function destroy(BattleService $service, $id)
    {
        return $service->destroy($id);
    }

    /**
     * @param Request $request
     */
    public function filter(Request $request){
        Session::put('filter', $request->filter);
    }

    /**
     * @param BattleService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeVerify(BattleService $service, Request $request){
        return $service->changeVerify($request);
    }
}
