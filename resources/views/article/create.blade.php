@extends('layouts.app')

@section('content')
<div class="ui segments">
    <div class="ui segment">
        <h3 class="header">Create an article</h3>
    </div>
    <div class="ui segment">
        <form action="/article" method="post" class="ui form">
            {{ csrf_field() }}
            <div class="required field{{ $errors->has('title') ? ' error' : '' }}">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="title" value="{{ old('title') ?? '' }}">
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
                <input type="text" name="slug" id="slug" placeholder="slug" value="{{ old('slug') ?? '' }}">
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
                        <option value="{{ $category->id }}" {{ (old('category') == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
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
                <textarea name="body" rows="10">{{ old('body') ?? '' }}</textarea>
                @if ($errors->has('body'))
                   <span class="ui visible error message">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif                    
            </div>
            <div class="field">
                <button class="ui button primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection