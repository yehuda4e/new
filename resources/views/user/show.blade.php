@extends('layouts.app')

@section('content')
<div class="ui segments">
    <div class="ui segment">
        <strong>{{ $user->username }}'s profile</strong>
    </div>
    <div class="ui segment">
        <div class="ui stacked segments">
            <div class="ui segment">
                <strong>Articles</strong>
            </div>
            @foreach ($user->articles as $article)
            <div class="ui segment">
                <a href="/{{ $article->slug }}">{{ $article->title }}</a>
            </div>
            @endforeach
        </div>
        
        <div class="ui stacked segments">
            <div class="ui segment">
                <strong>Topics</strong>
            </div>
            @foreach ($user->topics as $topic)
            <div class="ui segment">
                <a href="/topic/{{ $topic->slug }}">{{ $topic->title }}</a>
            </div>
            @endforeach
        </div>
        
        <div class="ui stacked segments">
            <div class="ui segment">
                <strong>Comments</strong>
            </div>
            @foreach ($user->comments as $comment)
            <div class="ui segment">
                <a href="/{{ $comment->commentable->slug }}#{{ $comment->id }}">{{ $comment->body }}</a>
            </div>
            @endforeach
        </div>    
    </div>
</div>
@endsection