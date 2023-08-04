<?php	
	$id=$reply->id;
?>
@foreach ($postData->replyComments as $reply )
	@if ($id==$reply->parent_id)	
	    <li class="comment child rounded">
			<div class="thumb">
				<img src="{{ isset($reply->user->profile_img)? asset('storage/users/'.$reply->user->profile_img): env('AVATER').$reply->user->name }}" alt="{{ $reply->user->name }}" style="border-radius: 	50%" width="70px" height="70px" />
			</div>
			<div class="details">
				<h4 class="name">
                    <a href="blog-single.html#">
                        {{ $reply->user->name }}
                    </a>
					replied to
					<p id="parent_name" data-parent-id="{{ $reply->parent_id }}"></p>
                </h4>
				<span class="date">
				{{ dateCreate($reply->created_at,'M d, Y') }}
				{{  timeCreate($reply->created_at,'i:s a') }}
				</span>
				<p>{{ $reply->content }}</p>
				@auth
					<a href="#commentTitle" class="btn btn-default 	btn-sm" 	id="replyComment" 	data-target-name="{{ $reply->user->name }}" data-parent-id="{{ $reply->id }}">Reply</a>
					@if ($reply->user_id==auth()->user()->id)
					<form action="{{ route('commentDelete') }}" method="POST">
						@csrf
						@method('DELETE')
						<input type="text" hidden name="id" value="{{ $reply->id }}">
						<button class="btn btn-default 	btn-sm">Delete</button>
					</form>
					@endif
					@else
					<a href="{{ route('register') }}">you need to log in 	before 	reply</a>
				@endauth
			</div>
	    </li>
        @include('include.helper.CodeForComment')
	@endif
@endforeach

