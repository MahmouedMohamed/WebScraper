@extends('layouts.app')
@section('content')
    <div id="wrapper">
        <div class="container">
            @if(isset($articles))
                @forelse($articles as $article)
                    <div class="card mb-4 pb-1" dir="auto">
                        <a href="{{$article->path()}}">
                            <div class="card-header text-center">{{$article->title}}</div>
                        </a>
                        <div class="mr-1">
                            <h3>{{$article->description}}
                                <a href="{{$article->link}}">for more click here!</a></h3>
                        </div>
                        <div>
                            <h5>{{$article->created_at}}</h5>
                            <h5>{{$article->website->title}}</h5>
                        </div>
                        @auth
                            <div id="form" class="text-center">
                                <form action="/articles/{{$article->id}}/" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"

                                    >Delete
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>

                @empty
                    <p>No Articles</p>
                @endforelse
                {!! $articles->render() !!}@endif
        </div>
    </div>
@endsection