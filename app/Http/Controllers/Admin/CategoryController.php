<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::pluck('name', 'id')->toArray();

        return view('admin.categories.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $slug = toSlug($request->name);

        if ($request->parent_id == null) {
            $level = 1;
        } else {
            $parentCat = Category::findOrFail($request->parent_id);
            $level = ($parentCat->level) + 1;
        }

        $arr = [
            'slug' => $slug,
            'level' => $level,
        ];

        $category = new Category;

        if ($category->create($request->all() + $arr)) {
            return back()->with('notice', trans('messages.category_add_success'));
        } else {
            return back()->with('notice_error', trans('messages.category_add_error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = Category::pluck('name', 'id')->toArray();

        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('notice_error', trans('messages.no_result'));
        }
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $slug = toSlug($request->name);

        if ($request->parent_id == null) {
            $level = 1;
        } else {
            $parentCat = Category::findOrFail($request->parent_id);
            $level = ($parentCat->level) + 1;
        }

        $arr = [
            'slug' => $slug,
            'level' => $level,
        ];

        $category = Category::findOrFail($id);

        if ($category->update($request->all() + $arr)) {
            return redirect()->route('category.edit', [$id])->with('notice', trans('messages.category_edit_success'));
        } else {
            return redirect()->route('category.edit', [$id])->with('notice_error', trans('messages.category_edit_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $children = Category::where('parent_id', $id)->first();

        if ($children == null) {
            $category->delete();

            return redirect()->route('category.index')->with('notice', trans('messages.category_delete_success'));
        } else {
            return redirect()->route('category.index')->with('notice_error', trans('messages.category_delete_error'));
        }
    }
}
