@extends('layouts.app')

@section('content')
<div class="ui breadcrumb">
    <a class="section" href="/forum/category/{{ $topic->forum->category->slug }}">{{ $topic->forum->category->name }}</a>
    <div class="divider"> / </div>
    <a class="section" href="/forum/{{ $topic->forum->slug }}">{{ $topic->forum->name }}</a>
    <div class="divider"> / </div>
    <div class="active section">{{ $topic->title }}</div>    
</div>

<table class="table celled ui">
    <thead>
        <tr>
            <th colspan="2">{{ $topic->title }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="{{ $topic->id }}">
                <i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans() }}
                @if ($topic->user->id === auth()->id())
                    <a class="ui mini yellow button right floated" onClick="editFormModal('topic')"><i class="fa fa-pencil"></i> Edit</a>
                @endif
            </td>
            <td class="center aligned" rowspan="2" valign="top">
                <img src="{{ $topic->user->getAvatar() }}" alt="{{ $topic->user->username }}" class="ui small image" style="margin: auto;padding:3px;border: 3px solid #ddd;border-radius: 7px">
                <h3 style="margin-top:5px"><a href="/user/{{ $topic->user->username }}">{{ $topic->user->username }}</a></h3>
            </td>
        </tr>
        <tr>
            <td style="height: 250px;width:80%;vertical-align:top">
                <div class="ui topic modal">
                    <div class="ui segments">
                        <div class="ui segment">
                            <h3 class="header">Edit Comment</h3>
                        </div>
                        <div class="ui segment">
                            <form action="/topic/{{ $topic->slug }}" method="post" class="ui form">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}                
                                <div class="field{{ $errors->has('edit') ? ' error': '' }}">
                                    <textarea name="edit" id="edit" cols="30" rows="10" required>{{ old('edit') ?? $topic->edits->last()->body ?? $topic->body }}</textarea>
                                    @if ($errors->has('edit'))
                                        <span class="ui visible error message">
                                            {{ $errors->first('edit') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="field">
                                    <button class="ui primaty button">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                

                <p id="t{{ $topic->id }}">{{ $topic->edits->last()->body ?? $topic->body }}</p>

                @if ($topic->edits->count())
                    <i>The topic edited by {{ $topic->edits->last()->user->username }} at {{ $topic->edits->last()->created_at->diffForHumans() }}</i>
                @endif                
            </td>
        </tr>
        @foreach ($topic->comments as $comment)
        {{--  {{ dd($comment)}}  --}}
        <tr>
            <td id="{{ $comment->id }}">
                <i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}
                @if ($comment->user->id === auth()->id())
                    <a class="ui mini yellow button right floated" onClick="editFormModal('', {{ $comment->id }})"><i class="fa fa-pencil"></i> Edit</a>
                @endif                
            </td>
            <td class="center aligned" rowspan="2" valign="top">
                <img src="{{ $comment->user->getAvatar() }}" alt="{{ $comment->user->username }}" class="ui small image" style="margin: auto;padding:3px;border: 3px solid #ddd;border-radius: 7px">
                <h3 style="margin-top:5px"><a href="/user/{{ $comment->user->username }}">{{ $comment->user->username }}</a></h3>
            </td>
        </tr>
        <tr>
            <td style="height: 250px;width:80%;vertical-align:top">
                <div class="ui modal" id="c{{ $comment->id }}">
                    <div class="ui segments">
                        <div class="ui segment">
                            <h3 class="header">Edit Comment</h3>
                        </div>
                        <div class="ui segment">
                            <form action="/topic/{{ $topic->slug }}/comment/{{ $comment->id }}" method="post" class="ui form">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}                
                                <div class="field{{ $errors->has('edit') ? ' error': '' }}">
                                    <textarea name="edit" id="edit" cols="30" rows="10" required>{{ old('edit') ?? $comment->edits->last()->body ?? $comment->body }}</textarea>
                                    @if ($errors->has('edit'))
                                        <span class="ui visible error message">
                                            {{ $errors->first('edit') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="field">
                                    <button class="ui primaty button">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  
                <p id="t{{ $comment->id }}">{{ $comment->edits->last()->body ?? $comment->body }}</p>

                @if ($comment->edits->count())
                    <i>The comment edited by {{ $comment->edits->last()->user->username }} at {{ $comment->edits->last()->created_at->diffForHumans() }}</i>
                @endif
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

@push('js')
<script>
    function editFormModal(model = null,id = null) {

        if (model === 'topic') {
            $('.ui.topic.modal').modal({
                blurring: true
            }).modal('show');    
        } else {
            $(`#c${id}`).modal({
                blurring: true
            }).modal('show');             
        }
    }
 </script>
@endpush