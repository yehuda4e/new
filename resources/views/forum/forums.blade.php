<table class="ui celled striped table stacked segments">
    <thead>
        <tr>
            <th colspan="4"><a href="/forum/category/{{ $category->slug }}"><strong>{{ $category->name }}</strong></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($category->forums as $forum)
        <tr>
            <td class="collapsing"><i class="fa fa-3x fa-envelope"></i></td>
            <td style="width: 60%">
                <strong><a href="/forum/{{ $forum->slug }}">{{ $forum->name }}</a></strong>
                @if ($forum->description)
                <p>{{ $forum->description }}</p>
                @endif
            </td>
            <td class="center aligned collapsing">
                <p>{{ $forum->topics_count }}<br> <strong>{{ str_plural('Topic', $forum->topics_count) }}</strong></p>
                <p>{{ $forum->comments_count }}<br> <strong>{{ str_plural('comment', $forum->comments_count) }}</strong></p>
            </td>
            <td>
                <div class="ui comments">
                    @if ($forum->lastActivity())
                    <div class="comment">
                        <a class="avatar">
                            <img src="{{ $forum->lastActivity()->user->getAvatar() }}" alt="{{ $forum->lastActivity()->user->username }}">
                        </a>
                        <div class="content">
                            <div class="single line">
                                <a href="/user/{{ $forum->lastActivity()->user->username }}" class="author">{{ $forum->lastActivity()->user->username }}</a>
                                <div class="metadata">
                                    <time class="date">{{ $forum->lastActivity()->created_at->diffForHumans() }}</time>
                                </div>
                            </div>
                            <div class="text">
                                <a href="/topic/{{ $forum->lastActivityUrl()->slug }}#{{ $forum->lastActivity()->id }}">{{ $forum->lastActivityUrl()->title }}</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>--</p>
                    @endif
                </div> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>