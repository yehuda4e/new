@extends('layouts.app')

@section('content')
<div class="ui segments">
    <div class="ui segment">
        <h3 class="header">Create new topic</h3>
    </div>
    <div class="ui segment">
        <form action="/topic" method="post" class="ui form">
            {{ csrf_field() }}
            <div class="required field{{ $errors->has('title') ? '  error' : '' }}">
                <label for="Subject">Subject</label>
                <input type="text" name="title" placeholder="Your topic subject" value="{{ old('title') }}" required>
                @if ($errors->has('title'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif                    
            </div>
            <div class="field{{ $errors->has('title') ? '  error' : '' }}">
                <label for="slug">Slug</label>
                <input type="text" name="slug" placeholder="Your topic slug" value="{{ old('slug') }}">
                @if ($errors->has('slug'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif                    
            </div>            
            <div class="required field{{ $errors->has('forum') ? ' error' : '' }}">
                <label for="forum">Forum</label>
                <select name="forum" id="forum">
                    @foreach (\App\ForumCategory::with('forums')->get() as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach ($category->forums as $forum)
                            <option value="{{ $forum->id }}" {{ ((old('forum') ?? request('f')) == $forum->id) ? 'selected' : '' }}>{{ $forum->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @if ($errors->has('forum'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('forum') }}</strong>
                    </span>
                @endif                    
            </div>
            <div class="required field{{ $errors->has('body') ? ' error' : '' }}">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10" required>{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <span class="ui visible error message">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif                    
            </div>
            <div class="field">
                <button class="ui primary button">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection