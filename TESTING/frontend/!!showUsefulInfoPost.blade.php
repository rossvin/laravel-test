@extends('frontend.layout')

@section('main')

<div class="page_title">
	{!! $page->name !!}
</div>

@if( isset($child_cat) && count($child_cat) )
	<div class="us_in_wr">
		@foreach( $child_cat as $cc )
			<div class="us_in_it clearfix">
				<div class="us_in_image fleft">
					<a href="/useful-info/{{ $page->slug }}/{{ $cc->slug }}">
						<img src="@if( $cc->image ) /uploads/usefulInfo/{{ $cc->image }} @else /frontend/img/rev_def.png @endif" alt="{{ $cc->name }}">
					</a>
				</div>
				<div class="us_in_descr fright">
					<a href="/useful-info/{{ $page->slug }}/{{ $cc->slug }}">{{ $cc->name }}</a>
					<p class="date">{{ $cc->created_at->format('d-m-Y') }}</p>
					{!! $cc->descr !!}
				</div>
			</div>
		@endforeach

		<div class="pagination_plain">{!! $child_cat->render() !!}</div>
	</div>
@endif

{!! $page->body !!}

@if( $page->slug == 'dictionary')
	<ul class="dictionary">
		@foreach( $dictionary as $key => $dict )
			<li>
				<p>{{ $key }}</p>
				@foreach( $dict as $k => $d )
					<a href="/dictionary/{{ $d }}">{{ $k }}</a>
				@endforeach
			</li>
		@endforeach
	</ul>
@endif

@endsection

@section('useful_info')
	<ul class="useful_info">
		@foreach( $useful_info as $ui )
			<li>
				<a href="/useful-info/{{ $ui->slug }}">
					<img src="/uploads/usefulInfo/{{ $ui->image }}" alt="{{ $ui->name }}">
					<span>{{ $ui->name }}</span>
				</a>
		@endforeach
	</ul>
@endsection
