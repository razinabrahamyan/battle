<?php


namespace App\Library\Services;


use App\Battle;
use App\Category;
use App\Library\Services\Contracts\BattlesContract;
use App\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class BattleService implements BattlesContract
{
    /**
     * @param $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($page)
    {
        $entries = Session::get('battles-entries');
        $filter = Session::get('filter');

        if ($filter == ''){
            $data =  Battle::with('category')->with(['request'=>function($query){
                $query->with('creator');
            }]);
        }elseif ($filter == 'latest'){
            $data = Battle::with('category')->with(['request'=>function($query){
                $query->with('creator');
            }])->orderBy('created_at', 'desc');
        }elseif ($filter = 'upcoming'){
            $data = Battle::where('start_date', '<=', Carbon::now())->with('category')->with(['request'=>function($query){
                $query->with('creator');
            }])->orderBy('start_date', 'desc');
        }else{
            abort(404);
        }

        $battles = $data->paginate( $entries ? $entries : 10);
        return view($page, ['battles' => $battles, 'filter' => $filter]);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($page, $id)
    {
        $battle = Battle::with('category')->with(['request'=>function($query){
            $query->with('creator', 'joiner');
        }])->findOrFail($id);

        return view($page, ['battle' => $battle]);
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($page, $id)
    {
        $categories = Category::get();
        $battle = Battle::with('category')->findOrFail($id);
        return view($page, ['battle' => $battle, 'categories' => $categories]);
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($data, $id)
    {

        $battle = Battle::findOrFail($id);
        $battle->update([
            'title' => $data->title,
            'description' => $data->description,
            'gap' => $data->gap,
            'rounds' => $data->rounds,
            'category_id' =>$data->category_id,
            'verified' => $data->verified ? '1' : '0',
        ]);
        return redirect()->route('battles.index');
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function destroy($id)
    {
        $battle = Battle::with('creatorPlayer')->findORFail($id);
        $battle->creatorPlayer()->detach();
        $battle->delete();
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeVerify($request)
    {
        $battle = Battle::findOrFail($request->id);
        if ($request->verify == 0 || $request->verify == 1) {

            $battle->verified = $request->verify;
            $battle->save();
        }  else {
            abort(404);
        }
        return response()->json(['success' => 'VERIFIED change successfully.'], 200);
    }
}
