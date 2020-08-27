<?php

namespace App\Http\Controllers;

use App\Article;

class ArticlesController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    public function index()
    {
        return view('articles.index')->withArticles(Article::paginate(5))
//        [
//            'articles' => Article::paginate(5)
//        ])
        ;
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }


    public function store($website,$title,$description,$link,$date)
    {
        $website->articles()->create([
            'title' => $title,
            'description' => $description,
            'link' => $link,
            'created_at' => $date
        ]);
    }


    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('articles.index'));
    }
}
