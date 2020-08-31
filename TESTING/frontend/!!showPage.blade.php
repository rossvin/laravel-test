@extends('frontend.layout')

@section('main')
                  
	{{-- <div class="page_title"> 
		{!! $page->name !!}
	</div> --}}

	@if( $page->map )
		{!! $page->map !!}
	@endif

	{!! $page->body !!}

	@if( $page->slug == 'opticians' )
		{!! $settings[0]->value !!}
	@endif

	@if( isset($photos) && count($photos) > 0 )
		<div class="certificates">
			@foreach( $photos as $pp )
				<a class="fancybox" rel="group" href="/uploads/medcenter_photos/{{ $pp->image }}"><img src="/uploads/medcenter_photos/sm/{{ $pp->image }}" alt="{{ $page->name }}"></a>
			@endforeach
		</div>
	@endif

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