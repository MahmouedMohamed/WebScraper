@extends('layouts.app')
@section('head')
    <style>
        .card {
            direction: unset;
            text-align: right;
            margin-left: 20px;
            margin-right: 20px;
        }
        .row{
            align-items: baseline;
            margin-left: auto;
            margin-right: auto;
        }
        .form{
            width: max-content;
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center" dir="auto">{{$article->title}}</div>
            <div class="mr-1 pt-3" dir="auto">
                <h3>{{$article->description}}</h3>
            </div>
            <div class="mt-2 mr-auto">
                <h5>Time : {{$article->created_at}}</h5>
            </div>
            @auth
                <div class="row pb-2">
                    <a href="{{$article->link}}" class="text-success mr-5">LINK!</a>
                    <form action="/articles/{{$article->id}}/" method="POST" class="form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        >Delete
                        </button>
                    </form>
                </div>
            @endauth
    </div>
@endsection