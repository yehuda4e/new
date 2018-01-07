<div class="ui modal" id="a{{ $article->id }}">
    <div class="ui segments">
        <div class="ui segment">
            <h3 class="header">Edit {{ $article->title }} article</h3>
        </div>
        <div class="ui segment">
            <form action="/{{ $article->slug }}" method="post" class="ui form">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="required field{{ $errors->has('title') ? ' error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="title" value="{{ old('title') ?? $article->title ?? '' }}">
                    @if ($errors->has('title'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="required field{{ $errors->has('slug') ? ' error' : '' }}">
                    <div class="inline required field">
                        <label for="slug">Slug</label> 
                        <span data-tooltip="The slug must contain only letters and numbers. Spaces will be replaced to hyphens." data-inverted="">
                            <i class="help circle outline icon"></i> 
                        </span>
                    </div>
                    <input type="text" name="slug" id="slug" placeholder="slug" value="{{ old('slug') ?? $article->slug ?? '' }}">
                    @if ($errors->has('slug'))
                   <span class="ui visible error message">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                    @endif                    
                </div>
                <div class="required field{{ $errors->has('category') ? ' error' : '' }}">
                    <label for="category">Category</label>
                    <select name="category">
                        @foreach (App\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ ((old('category') ?? $article->category->id ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif                    
                </div>
                <div class="required field{{ $errors->has('body') ? ' error' : '' }}">
                    <label for="body">Body</label>
                    <textarea name="body" rows="10">{{ old('body') ?? $article->edits()->lastEdit()->body ?? $article->body }}</textarea>
                    @if ($errors->has('body'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                    @endif                    
                </div>
                <div class="field">
                    <button class="ui button primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>