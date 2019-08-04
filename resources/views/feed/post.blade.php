<div class="border border-primary my-2">
	<div class="row p-3">

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
			<votes post-id={{ $post->id }} votes={{ $post->postsVoteCount($post) }}
				user-signed-in={{ (int) $user_signed_in }} users-vote={{ json_encode($users_vote) }}></votes>
		</div>

		<div class="col-10  my-auto">
			<div class="small">
				<a class="h6" href="{{ url("r/" . $post->subReddit->name) }}">r/{{ $post->subReddit->name }}</a>
				posted by {{ $post->user->username }}
			</div>

			<div class="h5"><a href="{{ url("post/" . $post->id) }}">{{ $post->title }}</a></div>
			<div class="small text-secondary">{{ $created_at }}</div>
		</div>
	</div>
</div>