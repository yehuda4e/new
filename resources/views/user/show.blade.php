@extends('layouts.app')

@section('content')
<div class="ui segments">
    <div class="ui segment">
        <strong>{{ $user->username }}'s profile</strong>
    </div>
    <div class="ui segment">
        <div class="ui grid">
            <div class="twelve wide stretched column">
                <div class="ui bottom attached tab segment" data-tab="feed">
                Welcome
                </div>      
                <div class="ui bottom attached tab segment" data-tab="topics">
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
                </div>      
                <div class="ui bottom attached tab segment" data-tab="articles">
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
                </div>      
                <div class="ui bottom attached tab segment" data-tab="comments">
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
            <!--  Menu  -->
            <div class="three wide column">
                <img src="{{ $user->getAvatar() }}" alt="Avatar" class="profile-pic">
                <h3 class="ui center aligned header">{{ $user->name }}</h3>
                <div class="ui vertical menu">
                    <a class="active item" data-tab="feed">
                        Feed
                    </a>
                    <a class="item" data-tab="topics">
                        Topics
                        <div class="ui label">{{ $user->topics()->count() }}</div>
                    </a>
                    <a class="item" data-tab="articles">
                        Articles
                        <div class="ui label">{{ $user->articles()->count() }}</div>
                    </a>
                    <a class="item" data-tab="comments">
                        Comments
                        <div class="ui label">{{ $user->comments()->count() }}</div>
                    </a>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
<script>
$(".vertical.menu .item").tab({
    history: true
});
</script>
@endpush