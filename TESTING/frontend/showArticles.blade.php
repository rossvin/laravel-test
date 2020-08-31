@extends('frontend.layout_main')

@section('main')

<div class="wrapper">

	<div class="news">
	<h1 class="title">{{ $page->name }}</h1>
	
		@foreach( $articles as $a )
			<div class="news_item clearfix">
				<div class="n_image fleft">
					<a href="/articles/{{ $a->slug }}">
						<img src="@if( $a->image ) /uploads/articles/{{ $a->image }} @else /frontend/img/news_def.png @endif" alt="{{ $a->name }}">
					</a>
				</div>

				<div class="n_descr fright">
					<a href="/articles/{{ $a->slug }}">{{ $a->name }}</a>
					<p class="date">{{ $a->created_at->format('d-m-Y') }}</p>
					{!! $a->descr !!}
				</div>
			</div>
		@endforeach
		<div class="pagination_plain">{!! $articles->render() !!}</div>
	</div>
	<!-- news end -->
</div>
<!-- wrapper end -->

@endsection
