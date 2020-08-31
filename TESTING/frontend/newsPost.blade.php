@extends('frontend.layout')

@section('main')
@if($_SERVER['REQUEST_URI'] != "/news/novye-linzy-dlya-raboty-za-kompyuterom")
<div class="page_title">
	<h1 style="margin-top: -10%;">{!! $page->name !!}</h1>
</div>
@endif

@if ($_SERVER['REQUEST_URI'] == "/news/novye-linzy-dlya-raboty-za-kompyuterom")
<h1>Линзы Zeiss в Херсоне и Николаеве – линзы для работы за компьютером</h1>
@endif

{!! $page->body !!}

<div class="suggested_news">
	@if( $prev_news )
		<a href="{{ $prev_news->slug }}" class="prev_news">&lArr; Предыдущая новость</a>
	@endif
	@if( $next_news )
		<a href="{{ $next_news->slug }}" class="next_news">Следующая новость &rArr;</a>
	@endif
</div>

@endsection

@section('news_subscription')
	@include('frontend._news_subscription')
@endsection