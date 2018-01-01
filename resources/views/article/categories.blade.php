<div class="ui segment">
    <h3 class="header">Categories</h3>
</div>
@foreach(\App\category::all() as $category)
    <div class="ui segment">
        <a href="/category/{{ $category->slug }}">{{ $category->name }}</a>
    </div>
@endforeach

