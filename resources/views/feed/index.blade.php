@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @foreach($posts as $post)
                @include('feed.post', $post)
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection