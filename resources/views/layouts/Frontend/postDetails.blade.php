@extends('include.FrontendIncluder')

@section('FrontendContent')



		<div class="container-xl">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('catagory.post.all',$postData->catagory_id) }}">{{ $postData->catagory->catagory_name }}</a></li>
                    <li class="breadcrumb-item"><a href="blog-single.html#">{{ $postData->type }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $postData->title }}</li>
                </ol>
            </nav>

			<div class="row gy-4">

				<div class="col-lg-8">
					<!-- post single -->
                    <div class="post post-single">
						<!-- post header -->
						<div class="post-header">
							<h1 class="title mt-0 mb-3">{{ $postData->title }}</h1>
							<ul class="meta list-inline mb-0">
								<li class="list-inline-item"><a href="{{ route('user.post.all',$postData->user_id) }}"><img style="width: 32px;height:32px;border-radius:50%"  src="{{ asset('storage/users/'.$postData->user->profile_img) }}" class="author" alt="author"/>{{ $postData->user->name }}</a></li>
								<li class="list-inline-item"><a href="blog-single.html#">Trending</a></li>
								<li class="list-inline-item">{{ Carbon\Carbon::parse($postData->created_at)->format('d M Y') }}</li>
								<li class="list-inline-item">views:{{ $postData->views }}</li>
							</ul>
						</div>
						<!-- featured image -->
						<div class="featured-image">
							<img class="w-100" style="object-fit: cover" src="{{ $postData->featured_img_url }}" alt="post-title" />
						</div>
						<!-- post content -->
						<div class="post-content clearfix">
							{!! $postData->details !!}
						</div>
						<!-- post bottom section -->
						<div class="post-bottom">
							<div class="row d-flex align-items-center">
								<div class="col-md-6 col-12 text-center text-md-start">
									<!-- tags -->
									<a href="blog-single.html#" class="tag">#Trending</a>
									<a href="blog-single.html#" class="tag">#Video</a>
									<a href="blog-single.html#" class="tag">#Featured</a>
								</div>
								<div class="col-md-6 col-12">
									<!-- social icons -->
									<ul class="social-icons list-unstyled list-inline mb-0 float-md-end">
										<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-facebook-f"></i></a></li>
										<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-twitter"></i></a></li>
										<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-linkedin-in"></i></a></li>
										<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-pinterest"></i></a></li>
										<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-telegram-plane"></i></a></li>
										<li class="list-inline-item"><a href="blog-single.html#"><i class="far fa-envelope"></i></a></li>
									</ul>
								</div>
							</div>
						</div>

                    </div>

					<div class="spacer" data-height="50"></div>

					<div class="about-author padding-30 rounded">
						<div class="thumb">
							<img src="{{ asset('storage/users/'.$postData->user->profile_img) }}" alt="Katen Doe" />
						</div>
						<div class="details">
							<h4 class="name"><a href="{{ route('user.post.all',$postData->user_id) }}">{{ $postData->user->name }}</a></h4>
							<p>Hello, I’m a content writer who is fascinated by content fashion, celebrity and lifestyle. She helps clients bring the right content to the right people.</p>
							<!-- social icons -->
							<ul class="social-icons list-unstyled list-inline mb-0">
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-facebook-f"></i></a></li>
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-twitter"></i></a></li>
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-instagram"></i></a></li>
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-pinterest"></i></a></li>
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-medium"></i></a></li>
								<li class="list-inline-item"><a href="blog-single.html#"><i class="fab fa-youtube"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="spacer" data-height="50"></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Comments ({{ count($postData->parentComments) }})</h3>
					</div>
					<!-- post comments -->
					<div class="comments bordered padding-30 rounded">

						<ul class="comments">
							@forelse ($postData->parentComments as $comment )
								<!-- comment item -->
								<li class="comment rounded">
									<div class="thumb">
										<img src="{{ isset($comment->user->profile_img)? asset('storage/	users/'.$comment->user->profile_img): env('AVATER').	$comment->user->name }}" alt="John Doe" style="border-radius: 	50%" width="70px" height="70px" />
									</div>
									<div class="details">
										<h4 class="name"><a href="blog-single.html#">{{ 	$comment->user->name }}</a></h4>
										<span class="date">
											{{ dateCreate($comment->created_at,'M d, Y') }}
											{{  timeCreate($comment->created_at,'i:s a') }}
										</span>
										<p>{{ $comment->content }}</p>
										@auth
											<a href="#commentTitle" class="btn btn-default 	btn-sm" 	id="replyComment" data-target-name="{{ 	$comment->user->name }}" data-parent-id="{{ $comment->id }}	">Reply</a>
											@if ($comment->user_id==auth()->user()->id)
											<form action="{{ route('commentDelete') }}" method="POST">
												@csrf
												@method('DELETE')
												<input type="text" hidden name="id" value="{{ $comment->id }}">
												<button class="btn btn-default 	btn-sm">Delete</button>
											</form>
											@endif
											@else
											<a href="{{ route('register') }}">you need to log in 	before 	reply</a>
										@endauth
									</div>
								</li>
								@foreach ($postData->replyComments as $reply )

									@if ($comment->id==$reply->parent_id)
										<li class="comment child rounded">
											<div class="thumb">
												<img src="{{ isset($reply->user->profile_img)? asset('storage/	users/'.$reply->user->profile_img): env('AVATER').	$reply->user->name }}" alt="John Doe" style="border-radius: 	50%" width="70px" height="70px" />
											</div>
											<div class="details">
												<h4 class="name">
													<a href="blog-single.html#">{{ 	$reply->user->name }}
													</a>replied to
													<p id="parent_name" data-parent-id="{{ $reply->parent_id }}"></p>
												</h4>
												<span class="date">
													{{ dateCreate($reply->created_at,'M d, Y') }}
													{{  timeCreate($reply->created_at,'i:s a') }}
												</span>
												<p>{{ $reply->content }}</p>
												@auth
													<a href="#commentTitle" class="btn btn-default 	btn-sm" 	id="replyComment" data-target-name="{{ 	$reply->user->name }}" data-parent-id="	{{$reply->id }}	">Reply</a>
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
							@empty
								<p>Not found any Comment</p>
							@endforelse
						</ul>
					</div>

					<div class="spacer" data-height="50" ></div>

					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title" id="commentTitle">Leave Comment</h3>
					</div>
					<!-- comment form -->
					<div class="comment-form rounded bordered padding-30" >

						<form id="comment-form" class="comment-form" method="post" action="{{ route('comment.store') }}">
							@csrf
							<div class="messages"></div>
							
							@auth	
								<div class="row">

									<div class="column col-md-12">
										<!-- Comment textarea -->
										<input name="post_id" type="text" hidden value="{{ $postData->id }}">
										<input name="parent_id" id="parent_id" type="text" hidden>
										<div class="form-group">
											<textarea name="InputComment" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..." required="required"></textarea>
											@error('InputComment')
												<span class="alert">{{ message }}</span>
											@enderror
										</div>
									</div>
								
						
								</div>
							
								<button type="submit" name="submit" id="submit" value="Submit" 	class="btn btn-default">Submit</button><!-- Submit Button -->

								@else
									<a href="route('register')" style="font-size: 20px">Before Do Comment You need to LOG In</a>
							@endauth
						</form>
					</div>
                </div>

				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">
						<!-- widget about -->
						<div class="widget rounded">
							<div class="widget-about data-bg-image text-center" data-bg-image="{{ asset('Frontend/images/map-bg.png') }}">
								<img src="{{ asset('Frontend/images/logo.svg') }}" alt="logo" class="mb-4" />
								<p class="mb-4">Hello, We’re content writer who is fascinated by content fashion, celebrity and lifestyle. We helps clients bring the right content to the right people.</p>
								<ul class="social-icons list-unstyled list-inline mb-0">
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-facebook-f"></i></a></li>
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-twitter"></i></a></li>
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-instagram"></i></a></li>
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-pinterest"></i></a></li>
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-medium"></i></a></li>
									<li class="list-inline-item"><a href="classic.html#"><i class="fab fa-youtube"></i></a></li>
								</ul>
							</div>
						</div>

						<!-- widget popular posts -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Popular Posts</h3>
								<img src="{{ asset('Frontend/images/wave.svg') }}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<!-- post -->

								@foreach ($popularPosts as $popularPost)	
									<div class="post post-list-sm circle">
									<div class="thumb circle">
										@if ($popularPost->views)
											<span class="number">{{ $popularPost->views }}</span>
										@endif
										<a href="{{ route('postDeatails.all',$popularPost->slug) }}">
											<div class="inner">
												<img src="{{ $popularPost->featured_img_url }}" style="object-fit: cover" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="{{ route('postDeatails.all',$popularPost->slug) }}">{{ $popularPost->title }}</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">{{ Carbon\Carbon::parse($popularPost->created_at)->format('d M Y') }}</li>
										</ul>
									</div>
									</div>
								@endforeach

							</div>		
						</div>

						<!-- widget categories -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Explore Topics</h3>
								<img src="{{ asset('Frontend/images/wave.svg') }}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<ul class="list">
									<li><a href="classic.html#">Lifestyle</a><span>(5)</span></li>
									<li><a href="classic.html#">Inspiration</a><span>(2)</span></li>
									<li><a href="classic.html#">Fashion</a><span>(4)</span></li>
									<li><a href="classic.html#">Politic</a><span>(1)</span></li>
									<li><a href="classic.html#">Trending</a><span>(7)</span></li>
									<li><a href="classic.html#">Culture</a><span>(3)</span></li>
								</ul>
							</div>
							
						</div>

						<!-- widget newsletter -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Newsletter</h3>
								<img src="{{ asset('Frontend/images/wave.svg') }}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
								<form>
									<div class="mb-2">
										<input class="form-control w-100 text-center" placeholder="Email address…" type="email">
									</div>
									<button class="btn btn-default btn-full" type="submit">Sign Up</button>
								</form>
								<span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="classic.html#">Privacy Policy</a></span>
							</div>		
						</div>

						<!-- widget post carousel -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Celebration</h3>
								<img src="{{ asset('Frontend/images/wave.svg') }}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<div class="post-carousel-widget">
									<!-- post -->
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">How to</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="{{ asset('Frontend/images/widgets/widget-carousel-1.jpg') }}" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="classic.html#">Katen Doe</a></li>
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
									<!-- post -->
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">Trending</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="{{ asset('Frontend/images/widgets/widget-carousel-2.jpg') }}" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">Master The Art Of Nature With These 7 Tips</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="classic.html#">Katen Doe</a></li>
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
									<!-- post -->
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">How to</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="{{ asset('Frontend/images/widgets/widget-carousel-1.jpg') }}" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="classic.html#">Katen Doe</a></li>
											<li class="list-inline-item">29 March 2021</li>
										</ul>
									</div>
								</div>
								<!-- carousel arrows -->
								<div class="slick-arrows-bot">
									<button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
									<button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
								</div>
							</div>		
						</div>

						<!-- widget advertisement -->
						<div class="widget no-container rounded text-md-center">
							<span class="ads-title">- Sponsored Ad -</span>
							<a href="classic.html#" class="widget-ads">
								<img src="{{ asset('Frontend/images/ads/ad-360.png') }}" alt="Advertisement" />	
							</a>
						</div>

						<!-- widget tags -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Tag Clouds</h3>
								<img src="{{ asset('Frontend/images/wave.svg') }}" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<a href="classic.html#" class="tag">#Trending</a>
								<a href="classic.html#" class="tag">#Video</a>
								<a href="classic.html#" class="tag">#Featured</a>
								<a href="classic.html#" class="tag">#Gallery</a>
								<a href="classic.html#" class="tag">#Celebrities</a>
							</div>		
						</div>

					</div>

				</div>

			</div>

		</div>

@push('forPost')
	<script>
		document.querySelectorAll('.comments #replyComment').forEach(commentReplybtn => {
			commentReplybtn.addEventListener('click',function(e){
				let targetName=$(this).attr('data-target-name')
				let parent_id=$(this).attr('data-parent-id')
				$('#commentTitle').html(`reply to ${targetName}`)
				$('#InputComment').attr('placeholder',`reply to ${targetName}`)
				$('#submit').html('Reply');
				$('#parent_id').val(parent_id);
			})
		});

		$(document).ready(function(){

			function getParentName(ele){
					$.ajax({
						url:"{{ route('toGetParentName') }}",
						method:'get',
						data:{
							'parent_id':ele.getAttribute('data-parent-id'),
						},
						success:function($data){
							ele.innerHTML=($data[0].user.name)
						}
					})
			}

			document.querySelectorAll('.comments #parent_name').forEach(ele=>{
				getParentName(ele);
			})	
			
		})
	</script>
@endpush

@endsection