<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Slide;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $categories = Category::all();
        $slides = Slide::all();
        $parentMin = DB::table('categories')->min('parent_id');
        $level = 1;

        View::share(compact('categories', 'slides', 'parentMin', 'level'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::all();
        $news = News::all();

        return view('pages.home', compact('cats', 'news'));
    }

    public function newsType($id)
    {
        $category = Category::find($id);
        $news = News::where('category_id', $id)->paginate(5);
        return view('pages.newsType', compact('category', 'news'));
    }

    public function news($id)
    {
        $news = News::find($id);
        $hotNews = News::where('hot', 1)->take(4)->get();
        $relatedNews = News::where('category_id', $news->category_id)->take(4)->get();

        return view('pages.news', compact('news', 'hotNews', 'relatedNews'));
    }

    public function getProfile()
    {
        return view('pages.profile');
    }

    public function postProfile(UserRequest $request)
    {
        $addRequest = [];
        if ($request->changePassword == 'on') {
            $password = bcrypt($request->_password);

            $addRequest += [
                'password' => $password,
            ];
        }

        $user = Auth::user();

        if ($user->update($request->all() + $addRequest)) {
            return back()->with('notice', trans('messages.edit.success'));
        } else {
            return back()->with('notice', trans('messages.edit.error'));
        }
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $news = News::where('title', 'like', "%$key%")
            ->orWhere('summary', 'like', "%$key%")
            ->orWhere('content', 'like', "%$key%")
            ->paginate(5);

        return view('pages.search', compact('news', 'key'));
    }
}
