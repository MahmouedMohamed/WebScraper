<?php

namespace App\Http\Controllers;

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
        $this->update($website, Carbon::now()->toDateTimeString());
        $crawler->filter($website->DOM->article_main_DOM)->each(function ($article) use ($website, $articlesController) {
            $exists = $this->hasArticle($website, $article->filter($website->DOM->article_title_DOM)->text());
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
        \Session::flash('newArticlesCount', $this->newArticlesCount);
        $adminController = new AdminController();
        return $adminController->redirect();
    }

    public function hasArticle($website, $title)
    {
        return $website->articles()->where(
            'title',
            $title)
            ->exists();
    }

    public function index()
    {
        return view('websites.index')->withWebsites(Website::paginate(5));
    }

    public function update($website, String $time)
    {
        $website->update([
            'last_scraped_at' => $time
        ]);
    }

    public function destroy(Website $website)
    {
        $website->delete();
        return redirect(route('websites.index'));
    }
}
