@extends('layouts.app')

@section('content')
<div class="ui two column stackable grid">
    <div class="twelve wide column">
        @foreach($articles as $article)
            @include('article.article')
        @endforeach
        {{ $articles->links() }}
    </div>
    <div class="four wide column">
        <div class="ui stacked segments">
            @include('article.categories')
        </div>
    </div>    
</div>
@endsection

@push('js')
<script>
    function deleteArticle(e, form) {
        e.preventDefault();

        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
            return false;
        });
    }
</script>
@endpush