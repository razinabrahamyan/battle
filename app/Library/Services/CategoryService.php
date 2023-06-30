<?php

namespace App\Library\Services;

use App\Category;
use App\Library\Services\Contracts\CategoryContract;
use Carbon\Carbon;

class CategoryService implements CategoryContract
{

    /**
     * @param $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($page)
    {
        $categories = Category::get();
        return view($page, ['categories' => $categories]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($data)
    {
        $category = new Category();
        $category->title = ['en' => $data->title];
        $category->description = ['en' => $data->description] ;
        $category->base_id = isset($data->base_id) ? $data->base_id : null ;
        $category->style = isset($data->style) ? $data->style : null ;
        $category->svg = $data->svg;
        $category->start_date =  Carbon::parse($data->start_date);
        $category->end_date = isset($data->end_date) ?Carbon::parse($data->end_date) : null;
        $category->save();
        return redirect()->route('category.index')->with(['success' => 'Category was successfully created!']);
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
     */
    public function show($page, $id)
    {
        // TODO: Implement show() method.
    }

    /**
     * @param $page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($page, $id)
    {
        $category = Category::findOrFail($id);
        return view($page, ['category' => $category]);
    }

    /**
     * @param $data
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( $data, $id)
    {

        Category::findOrFail($id)->update([
            'svg' => $data->svg,
            'title' => ['en' => $data->title],
            'description' => ['en' => $data->description],
            'base_id' => isset($data->base_id) ? $data->base_id : null,
            'style' => isset($data->style) ? $data->style : null,
            'start_date' => Carbon::parse($data->start_date),
            'end_date' => isset($data->end_date) ?Carbon::parse($data->end_date) : null

        ]);

        return redirect()->route('category.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back();
    }
}
