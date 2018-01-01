@extends('layouts.app')

@section('content')
    @foreach ($categories as $category)
        @include ('forum.forums')
    @endforeach
@endsection