@extends('frontend.layout_main')

@section('main')

	<div class="wrapper">
		<div class="news">

			<div class="title"><h1>Наши новости</h1></div>
			                     
			@foreach( $news as $n )
				<div class="news_item clearfix">
					<div class="n_image fleft">
						<a href="/news/{{ $n->slug }}">
							<img src="@if( $n->image ) /uploads/news/thumbs/{{ $n->image }} @else /frontend/img/news_def.png @endif" alt="{{ $n->name }}">
						</a>
						<div class="networks">
							<script type="text/javascript">(function() {
							  if (window.pluso)if (typeof window.pluso.start == "function") return;
							  if (window.ifpluso==undefined) { window.ifpluso = 1;
							    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
							    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
							    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
							    var h=d[g]('body')[0];
							    h.appendChild(s);
							  }})();</script>
							<div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook" data-url="http://{{Request::getHttpHost()}}/news/{{ $n->slug }}" data-title="{{ $n->name }}" data-description="{{ $n->descr }}"></div>
						</div>
					</div>
					<div class="n_descr fright">
						<a href="/news/{{ $n->slug }}">{{ $n->name }}</a>
						<p class="date">@if($n->published_at != ''){{ $n->published_at }}@else{{ $n->created_at->format('d-m-Y') }}@endif</p>
						{!! $n->descr !!}
					</div>
				</div>
			@endforeach

			<div class="pagination_plain">{!! $news->render() !!}</div>
		</div>
		<!-- news end -->
	</div>
	<!-- wrapper end -->
@endsection

@section('news_subscription')
	@include('frontend._news_subscription')
@endsection