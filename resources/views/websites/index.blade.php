@extends('layouts.app')
@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            @if(isset($websites))
                @forelse($websites as $website)
                    <div class="card mb-4 pb-1" dir="auto">
                        <a href="{{$website->link}}">
                            <div class="card-header text-center">{{$website->name}}</div>
                        </a>
                        <div class="mr-1">
                            <h3>{{$article->description}}
                                <a href="{{$article->link}}">for more click here!</a></h3>
                        </div>
                        <div>
                            <h5>{{$article->created_at}}</h5>
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
                    <p>No Websites</p>
                @endforelse
                {!! $websites->render() !!}@endif
        </div>
    </div>
@endsection