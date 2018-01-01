@extends('layouts.app')

@section('content')
<table class="table celled ui">
    <thead>
        <tr>
            <th colspan="2">{{ $topic->title }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="{{ $topic->id }}"><i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans() }}</td>
            <td class="center aligned" rowspan="2" valign="top">
                <img src="{{ $topic->user->getAvatar() }}" alt="{{ $topic->user->username }}" class="ui small image" style="margin: auto;padding:3px;border: 3px solid #ddd;border-radius: 7px">
                <h3 style="margin-top:5px"><a href="/user/{{ $topic->user->username }}">{{ $topic->user->username }}</a></h3>
            </td>
        </tr>
        <tr>
            <td style="height: 250px;width:80%;vertical-align:top">
                {{ $topic->body }}
            </td>
        </tr>
        @foreach ($topic->comments as $comment)
        <tr>
            <td id="{{ $comment->id }}"><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}</td>
            <td class="center aligned" rowspan="2" valign="top">
                <img src="{{ $comment->user->getAvatar() }}" alt="{{ $comment->user->username }}" class="ui small image" style="margin: auto;padding:3px;border: 3px solid #ddd;border-radius: 7px">
                <h3 style="margin-top:5px"><a href="/user/{{ $comment->user->username }}">{{ $comment->user->username }}</a></h3>
            </td>
        </tr>
        <tr>
            <td style="height: 250px;width:80%;vertical-align:top">
                {{ $comment->body }}
            </td>
        </tr>      
        @endforeach
    </tbody>
</table>
<div class="ui segments">
    <div class="ui segment">
        <h3 class="header">Replay</h3>
    </div>
    <div class="ui segment">
        @auth
        <form action="/topic/{{ $topic->slug }}/comment" method="post" class="ui form">
            {{ csrf_field() }}
            <div class="field{{ $errors->has('body') ? ' error' : '' }}">
                <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Say something..">{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif                
            </div>
            <div class="field">
                <button class="ui primary button">Comment</button>
            </div>
        </form>
        @else
        <p>Please <a href="/login">log in</a> in order to comment.</p>
        @endauth
    </div>
</div>
@endsection