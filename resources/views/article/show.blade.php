@extends('layouts.app')

@section('content')
<div class="ui two column grid">
    <div class="twelve wide column">
        @include('article.article')

        <div class="ui stacked segments">

            <div class="ui segment" id="comments">
                <h3 class="header">Comments</h3>
            </div>
            <div class="ui segment">
                <div class="ui comments">
                    @if ($article->comments_count)
                        @foreach ($article->comments as $comment)
                        <div class="comment" id="{{ $comment->id }}">
                            <a class="avatar">
                                <img src="https://gravatar.com/avatar/{{ md5($comment->user->email) }}?d=retro">
                            </a>
                            <div class="content">
                                <a href="/user/{{ $comment->user->username }}" class="author">{{ $comment->user->username }}</a>
                                <div class="metadata">
                                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text">
                                    {{ $comment->body }}
                                </div>
                                <div class="actions">
                                    <a class="reply">Reply</a>
                                </div>
                            </div>
                        </div>         
                        @endforeach
                    @endif
                    <div class="ui dividing header"></div>
                    @auth
                        <form action="{{ $article->slug}}/comment" method="post" class="ui reply form">
                            {{ csrf_field() }}
                            <div class="field{{ $errors->has('body') ? ' error' : '' }}">
                                <textarea name="body" placeholder="Say something..." required>{{ old('body') }}</textarea>
                            </div>
                            @if ($errors->has('body'))
                                <span class="ui visible error message">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif                            
                            <button class="ui blue labeled submit icon button">
                                <i class="icon edit"></i> Add Reply
                            </button>
                        </form>                        
                    @else
                        Please <a href="/login">log in</a> in order to comment.
                    @endauth
                </div>
            </div>
        </div>

    </div>
    <div class="four wide column">
        <div class="ui stacked segments">
            @include('article.categories')
        </div>
    </div>    
</div>
@endsection

@push('js')
<script>
    function deleteArticle(e, form) {
        e.preventDefault();

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
            return false;
        });
    }

    function editArticle(id) {
        $(`#a${id}`).modal({
            blurring: true
        }).modal('show'); 
    }
</script>
@endpush 