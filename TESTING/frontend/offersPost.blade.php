@extends('frontend.layout')

@section('main')

<div class="offers_wr">
	<img src="@if( $page->image ) /uploads/offers/{{ $page->image }} @else /frontend/img/offers_def.png @endif" alt="{{ $page->name }}" class="fleft">

	<div class="page_title">
		{!! $page->name !!}
	</div>

	{!! $page->body !!}

	<div class="suggested_news">
		@if( $prev_offer )
			<a href="{{ $prev_offer->slug }}" class="prev_news">Читать предыдущее предложение</a>
		@endif
		@if( $next_offer )
			<a href="{{ $next_offer->slug }}" class="next_news">Читать следующее предложение</a>
		@endif
	</div>
</div>

@endsection