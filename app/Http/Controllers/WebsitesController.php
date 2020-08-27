<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Website;
use Goutte\Client;
use Illuminate\Support\Carbon;

class WebsitesController extends Controller
{
    private $newArticlesCount = 0;
    public function scrap($id)
    {
        $website = Website::findOrFail($id);
        $client = new Client();
        $articlesController = new ArticlesController();
        $crawler = $client->request('GET', $website->link);
        $website->last_scraped_at = Carbon::now()->toDateTimeString();
        $website->save();
        $crawler->filter($website->DOM->article_main_DOM)->each(function ($article) use ($website,$articlesController) {
            $exists = $website->articles()->where(
                'title',
                $article->filter($website->DOM->article_title_DOM)->text())
                ->exists();
            if (!$exists) {
                $this->newArticlesCount++;
                $articlesController->store(
                    $website,
                    $article->filter($website->DOM->article_title_DOM)->text(),
                    $article->filter($website->DOM->article_description_DOM)->text(),
                    $article->filter($website->DOM->article_link_DOM)->attr('href'),
                    $website->DOM->article_date_DOM ?
                        $article->filter($website->DOM->article_date_DOM)->text()
                        :
                        "Not Available"
                );
            }
        });
        \Session::flash('newArticlesCount',$this->newArticlesCount);
        $adminController = new AdminController();
        return $adminController->redirect();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('websites.index')->withWebsites(Website::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
