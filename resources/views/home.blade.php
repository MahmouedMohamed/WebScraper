@extends('layouts.app')
@section('head')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $("div.alert").remove();
            }, 5000 ); // 5 secs

        });
    </script>
    <style>
        .card {
            word-wrap: normal;
            margin: 5px;
        }

        .main {
            width: 100%;
            text-align: center;
            display:block;
        }

        .main .card {
            width: fit-content;
            display: inline-flex;
        }
        .main .row {
            justify-content: space-between;
            justify-items: center;
            text-align: center;
            margin-left: 0;
            margin-right: 0;
        }
        .alert{
            position: absolute;
            top: 0;
            width: 100%;
            padding: 0;
        }
    </style>
@endsection
@section('content')
    <div class="main">
        <div class="card">
            <div class="card-header text-center">Achievement Center</div>
            <div class="row">
                <div class="mr-5">
                    <h3>{{$webSitesCount}}</h3>
                    <p>Website Scrapped</p>
                </div>
                <div class="">
                    <h3>{{$articlesCount}}</h3>
                    <p>Article Collected</p>
                </div>
            </div>
        </div>
        <div class="alert">
            @if(Session::has('newArticlesCount'))
                <div class="alert alert-success">{{ session('newArticlesCount') }} new Articles</div>
            @endif
        </div>
        <div class="card">
            <div class="card-header text-center">Top Sites</div>
                  @foreach($websites as $website)
                    <div class="row mt-1 mx-5 border-bottom pb-1">
                        <div class="column1">
                            <h3 class="mr-5">Name: {{$website->name}}</h3>
                            <h4 class="mr-5">Link: {{$website->link}}</h4>
                            <h5 class="mr-5">Last time scrapped: {{$website->last_scraped_at}}</h5>
                        </div>
                        <button value="Scrap Now!" name="Scrap Now!" onclick="window.location.href='/scrap/{{$website->id}}'">Scarp Now!</button>
                    </div>
                  @endforeach
        </div>
        <div class="card">
            <div class="card-header">Random Selected Articles</div>
            @forelse($latestArticles as $article)
                <div class="row mt-1 justify-content-center">
                    <a class="text-center" href="{{$article->path()}}"  target="_blank">{{$article->title}}</a>
                </div>
            @empty
                <p>No Articles</p>
            @endforelse
        </div>
    </div>
@endsection
