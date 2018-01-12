@extends('layouts.app')

@section('content')
<div class="ui breadcrumb">
    <a class="section" href="/forum/category/{{ $forum->category->slug }}">{{ $forum->category->name }}</a>
    <div class="divider"> / </div>
    <div class="active section">{{ $forum->name }}</div>    
</div>

<table class="ui celled striped table tall stacked segments">
    <thead>
        <tr>
            <th colspan="4">
                <h4 class="header">{{ $forum->name }}</h4>
                <span style="font-weight: normal;font-style:italic">{{ $forum->description }}</span>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topics as $topic)
        <tr>
            <td class="collapsing"><i class="fa fa-2x fa-envelope"></i></td>
            <td>
                <a href="/topic/{{ $topic->slug }}" title="{{ $topic->body }}">{{ $topic->title }}</a><br>
                by <a href="/user/{{ $topic->user->username }}">{{ $topic->user->username }}</a> at {{ $topic->created_at->diffForHumans() }}
            </td> 
            <td class="collapsing center aligned">
                {{ $topic->comments_count }} <strong>{{ str_plural('comment', $topic->comments_count) }}</strong><br>
                {{ $topic->views }} <strong>{{ str_plural('view', $topic->views) }}</strong>
            </td>
            <td>
                <div class="ui comments">
                    <div class="comment">
                        <a class="avatar">
                            <img src="{{ $topic->lastComment()->user->getAvatar() }}" alt="{{ $topic->lastComment()->user->username }}">
                        </a>
                        <div class="content">
                            <a href="/user/{{ $topic->lastComment()->user->username }}" class="author">{{ $topic->lastComment()->user->username }}</a>
                            <div class="text">
                                <time class="date"><i class="fa fa-clock-o"></i> {{ $topic->lastComment()->created_at->diffForHumans() }}</time>
                                <a href="/topic/{{ $topic->slug }}#{{ $topic->lastComment()->id }}"><i class="right arrow icon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">
                {{ $topics->links() }}
                <a href="/topic/create?f={{ $forum->id }}" class="ui primary button right floated" role="button">
                    <i class="icons">
                        <i class="file text outline icon"></i> 
                        <i class="corner red plus icon"></i>
                    </i>
                    New Topic
                </a>
            </th>
        </tr>
    </tfoot>
</table>
@endsection