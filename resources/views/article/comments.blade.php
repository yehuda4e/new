<div class="comment">
    <a class="avatar">
        <img src="{{ $comment->user->getAvatar() }}">
    </a>
    <div class="content">
        <a href="/user/{{ $comment->user->username }}" class="author">{{ $comment->user->username }}</a>
        <div class="metadata">
            <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="text" id="{{ $comment->id }}">
            {{ $comment->edits->last()->body ?? $comment->body }}
        </div>
        @if ($comment->edits_count)
        <i>Updated by {{ $comment->edits->last()->user->username }} at {{ $comment->edits->last()->created_at->diffForHumans() }}</i>
        @endif
        <div class="actions">
            <a onclick="replay({{ $comment->id }})" class="reply">Reply</a>
            @if (!$comment->hasLiked())
                <a href="/comment/{{ $comment->id }}/like" title="Like this comment" role="button"><i class="heart icon"></i> {{ $comment->likes_count }} </a>
            @else
                <a href="/comment/{{ $comment->id }}/unlike" title="Unlike this comment" role="button"><i class="red heart icon"></i> {{ $comment->likes_count }} </a>
            @endif
            @can('update', $comment)
            <a onclick="editComment({{ $comment->id }})"><i class="pencil icon"></i> Edit</a>
            @endcan
            @can('delete', $comment)
            <a onclick="event.preventDefault();
                document.getElementById('deleteForm{{ $comment->id }}').submit();"><i class="trash icon"></i> Delete</a>
            <form action="/comment/{{ $comment->id }}" method="post" id="deleteForm{{ $comment->id }}" style="display:none">
                {{ csrf_field() }}
                {{ method_field('delete') }}
            </form>
            @endcan
        </div>
    </div>
    @if ($comment->replies()->count())
    <div class="comments">
        @foreach($comment->replies as $reply)
            <div class="comment">
                <a class="avatar">
                <img src="{{ $reply->user->getAvatar() }}">
                </a>
                <div class="content">
                    <a href="/user/{{ $reply->user->username }}" class="author">{{ $reply->user->username }}</a>
                    <div class="metadata">
                        <span class="date">{{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="text" id="{{ $reply->id }}">
                        {{ $reply->edits->last()->body ?? $reply->body }}
                    </div>
                    @if ($reply->edits_count)
                    <i>Updated by {{ $reply->edits->last()->user->username }} at {{ $reply->edits->last()->created_at->diffForHumans() }}</i>
                    @endif                    
                    <div class="actions">
                        <a class="reply">Reply</a>
                        @if (!$reply->hasLiked())
                            <a href="/comment/{{ $reply->id }}/like" title="Like this comment" role="button"><i class="heart icon"></i> {{ $reply->likes_count }} </a>
                        @else
                            <a href="/comment/{{ $reply->id }}/unlike" title="Unlike this comment" role="button"><i class="red heart icon"></i> {{ $reply->likes_count }} </a>
                        @endif                    
                        @can('update', $reply)
                        <a onclick="editComment({{ $reply->id }})"><i class="pencil icon"></i> Edit</a>
                        @endcan
                        @can('delete', $reply)
                        <a onclick="event.preventDefault();
                            document.getElementById('deleteForm{{ $reply->id }}').submit();"><i class="trash icon"></i> Delete</a>
                        <form action="/comment/{{ $reply->id }}" method="post" id="deleteForm{{ $reply->id }}" style="display:none">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                        </form>
                        @endcan                    
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <div class="comments hide" id="reply{{ $comment->id }}">
        <form action="/comment/{{ $comment->id }}" method="post" class="ui form">
            {{ csrf_field() }}
            <div class="field">
                <textarea name="reply" rows="1"></textarea>
            </div>
            <button class="ui mini button">Reply</button>
        </form>                                
    </div>

</div> 