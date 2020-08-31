@extends('frontend.layout')

@section('main')

	<div class="wrapper">
		<div class="personal clearfix">

			<div class="title">{{ $page->name }}</div>
			<div class="personal_dscr">
				<!--<img src="@if( $page->image )/uploads/personal/{{ $page->image }} @else /frontend/img/news_def.png @endif" alt="{{ $page->name }}" class="fleft">-->
				{!! $page->body !!}
			</div>

			@if( $page->photos )
				<div class="certificates">
					@foreach( $page->photos as $pp )
						<a class="fancybox" rel="group" href="/uploads/personal_photos/{{ $pp->image }}"><img src="/uploads/personal_photos/sm/{{ $pp->image }}" alt="{{ $page->name }}"></a>
					@endforeach
				</div>
			@endif
		</div>
		<!-- personal end -->
	</div>
	<!-- wrapper end -->
@endsection

@section('styles')
	<link href="/frontend/css/jquery.fancybox.css" rel="stylesheet">
@endsection

@section('scripts')
	<script src="/frontend/js/jquery.fancybox.js"></script>
	<script>
		$(".fancybox").fancybox();
	</script>
@endsection