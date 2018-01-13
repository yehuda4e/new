<article class="ui stacked segments">
    <div class="ui segment">

        <h3 class="header" style="display: flex">
            <a href="/{{ $article->slug }}" style="flex: 1">{{ $article->title }}</a>
            @can ('update', $article)
            <a class="ui yellow label" href="/{{ $article->slug }}/edit" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;
            @endcan

            @can ('delete', $article)
            <form action="/{{ $article->slug }}" method="post" onclick="deleteArticle(event, this)">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="ui red label" title="Delete" style="cursor:pointer"><i class="fa fa-trash"></i></button>
            </form>
            @endcan
        </h3>
    </div>
    <div class="ui segment">
        @if ($article->edits_count)
            <p>{{ $article->edits->last()->body }}</p>
            <i>This article edited by {{ $article->edits->last()->user->username }} at {{ $article->edits->last()->created_at->diffForHumans() }}</i>
        @else
            <p>{{ $article->body }}</p>
        @endif
    </div>
    <div class="ui secondary segment" style="display: flex">
        <div style="flex: 1">
            <a href="/user/{{ $article->user->username }}" class="ui image label" title="Author">
                <img src="{{ $article->user->getAvatar() }}" alt="{{ $article->user->username }}">{{ $article->user->username }}
            </a>
            &#x1F550; <time>{{ $article->created_at->diffForHumans() }}</time> 
            &#x1F4AC; <a href="/{{ $article->slug }}#comments">{{ $article->comments_count }} {{ str_plural('comment', $article->comments_count) }}</a>
            &#128065; {{ $article->views }} {{ str_plural('view', $article->views) }}
        </div>
    </div>
</article>
