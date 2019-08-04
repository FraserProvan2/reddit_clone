
<div class="border border-primary my-2">
	<div class="row p-3">
		
		<div class="col-2">
			<votes></votes>
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


