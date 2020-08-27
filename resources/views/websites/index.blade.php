@extends('layouts.app')
@section('content')
    <div id="wrapper">
        <div class="container">
            @if(isset($websites))
                @forelse($websites as $website)
                    <div class="mt-1 mx-5 border-bottom pb-1">
                        <div class="row  justify-content-center text-center align-items-center align-content-center mx-auto">
                            <div class="column1">
                                <h3 class="mr-5">Name: {{$website->name}}</h3>
                                <h4 class="mr-5">Link: <a href="{{$website->link}}">{{$website->link}}</a></h4>
                                <h5 class="mr-5">Last time scrapped: {{$website->last_scraped_at}}</h5>
                            </div>
                        </div>
                        <div class="row  justify-content-center text-center align-items-center align-content-center mx-auto">
                            <button value="Scrap Now!" name="Scrap Now!"
                                    onclick="window.location.href='/scrap/{{$website->id}}'">Scarp Now!
                            </button>
                            @auth
                                <div id="form" class="text-center">
                                    <form action="/websites/{{$website->id}}/" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"

                                        >Delete
                                        </button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                @empty
                    <p>No Websites</p>
                @endforelse
                {!! $websites->render() !!}@endif
        </div>
    </div>
@endsection