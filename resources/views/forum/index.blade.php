@extends('layouts.app')

@section('content')
    @foreach ($categories as $category)
        @if ($category->forums_count)
            @include ('forum.forums')
        @endif
    @endforeach
@endsection