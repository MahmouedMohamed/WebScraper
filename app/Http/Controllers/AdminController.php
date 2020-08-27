<?php

namespace App\Http\Controllers;

use App\Article;
use App\Website;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', [
            'webSitesCount' => Website::count(),
            'articlesCount' => Article::count(),
            'websites' => Website::latest()->paginate(2),
            'latestArticles' => Article::inRandomOrder()->limit(3)->get()
        ]);
    }

    public function redirect()
    {
        return redirect('/')->with([
            'webSitesCount' => Website::count(),
            'articlesCount' => Article::count(),
            'websites' => Website::latest()->paginate(2),
            'latestArticles' => Article::inRandomOrder()->limit(3)->get()
        ]);
    }
}
