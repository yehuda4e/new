@extends('layouts.app')

@section('content')
<div class="ui two column grid">
    <div class="twelve wide column">
        @foreach($articles = \App\Article::latest()->paginate() as $article)
            @include('article.article')
        @endforeach
        {{ $articles->links() }}
    </div>
    <div class="four wide column">
        <div class="ui stacked segments">
            @include('article.categories')
        </div>
    </div>    
</div>
@endsection