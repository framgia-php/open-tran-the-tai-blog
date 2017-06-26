<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::pluck('name', 'id')->toArray();

        return view('admin.news.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        if ($request->hasFile('fileImage')) {
            $file = $request->file('fileImage');

            $getName = $file->getClientOriginalName();
            $nameImage = str_random(3) . '_' . $getName;
            while (file_exists('upload/news' . $nameImage)) {
                $nameImage = str_random(3) . '_' . $getName;
            }
            $file->move('upload/news', $nameImage);
        } else {
            $nameImage = '';
        }

        $slug = toSlug($request->title);
        $views = 0;

        $arr = [
            'slug' => $slug,
            'views' => $views,
            'image' => $nameImage,
        ];

        $news = new News;

        if ($news->create($request->all() + $arr)) {
            return back()->with('notice', trans('messages.news_add_success'));
        } else {
            return back()->with('message', trans('messages.create_failed'));
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
        $category = Category::pluck('name', 'id')->toArray();

        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('category', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $arr = [];
        if ($request->hasFile('fileImage')) {
            $file = $request->file('fileImage');

            $getName = $file->getClientOriginalName();
            $nameImage = str_random(3) . '_' . $getName;
            while (file_exists('upload/news' . $nameImage)) {
                $nameImage = str_random(3) . '_' . $getName;
            }
            $file->move('upload/news', $nameImage);
            $arr += ['image' => $nameImage];
        }
        if ($request->title != $news->title) {
            $slug = toSlug($request->title);
            $arr += ['slug' => $slug];
        }

        if ($news->update($request->all() + $arr)) {
            return back()->with('notice', trans('messages.news_update_success'));
        } else {
            return back()->with('message', trans('messages.update_failed'));
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
        $news = News::findOrFail($id);

        $news->delete();

        return redirect()->route('news.index')->with('notice', trans('messages.news_delete_success'));
    }
}
