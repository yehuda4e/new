<article class="ui stacked segments">
    <div class="ui segment">

        <h3 class="header" style="display: flex">
            <a href="/{{ $article->slug }}" style="flex: 1">{{ $article->title }}</a>
            @if ($article->user->id === auth()->id())
            <a class="ui tiny yellow button" href="{{ $article->slug }}/edit"><i class="fa fa-pencil"></i> Edit</a>&nbsp;
            <form action="/{{ $article->slug }}" method="post" onclick="deleteArticle(event, this)">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <button type="submit" class="ui tiny red button"><i class="fa fa-trash"></i> Delete</button>
            </form>
            @endif
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
            <i class="fa fa-user" title="created by"></i> <a href="/user/{{ $article->user->username }}">{{ $article->user->username }}</a>
            &#x1F550; <time>{{ $article->created_at->diffForHumans() }}</time> 
            &#x1F4AC; <a href="/{{ $article->slug }}#comments">{{ $article->comments_count }} {{ str_plural('comment', $article->comments_count) }}</a>
            &#128065; {{ $article->views }} {{ str_plural('view', $article->views) }}
        </div>
        Category:&nbsp;<a href="/category/{{ $article->category->slug }}" title="Category">{{ $article->category->name }}</a>
    </div>
</article>