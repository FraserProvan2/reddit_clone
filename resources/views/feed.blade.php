@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            {{-- Post Tempalte--}}
            @foreach($posts as $post)
            <div class="border border-primary my-2">
                <div class="row p-2">
            
                    {{-- Votes --}}
                    <div class="col-2">
                        @php
                            $user_signed_in = false;
                            if(Auth::user()) {
                                $user_signed_in = true;
                                $users_vote = $post->getUsersVote($post);
                            } else {
                                $users_vote = null;
                            }
                        @endphp
                        <votes 
                            post-id={{ $post->id }} 
                            votes={{ $post->postsVoteCount($post) }}
                            user-signed-in={{ (int) $user_signed_in }} 
                            users-vote={{ json_encode($users_vote) }}
                        ></votes>
                    </div>
            
                    {{-- Postd details --}}
                    <div class="col-10 my-auto">
                        <div class="small">
                            {{-- SubReddit Name --}}
                            <a class="h6" href="{{ url("r/" . $post->subReddit->name) }}">r/{{ $post->subReddit->name }}</a>
                            {{-- Post authors username --}}
                            <span>posted by {{ $post->user->username }}</span> 
                        </div>
            
                        {{-- Title --}}
                        <div class="h5">
                            <a href="{{ url("post/" . $post->id) }}">{{ $post->title }}</a>
                        </div>
                        {{-- Created_at --}}
                        <div class="small text-secondary">{{ $post->created_at }}</div>
                    </div>
                    
                </div>
            </div>
            @endforeach

            {{-- Pagination links --}}
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection