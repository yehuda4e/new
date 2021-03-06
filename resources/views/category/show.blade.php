@extends('layouts.app')

@section('content')
<div class="ui two column stackable grid">
    <div class="twelve wide column">
        @if ($category->articles_count)
            @foreach($articles = $category->articles()->with(['category', 'user'])->withCount(['comments', 'edits'])->paginate() as $article)
                @include('article.article')
            @endforeach
            {{ $articles->links() }}
        @endif
    </div>
    <div class="four wide column">
        <div class="ui stacked segments">
            @include('article.categories')
        </div>
    </div>    
</div>
@endsection