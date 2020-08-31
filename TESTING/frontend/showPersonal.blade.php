@extends('frontend.layout')

@section('main')

	<div class="wrapper">
		<div class="personal">
			<h1 class="title">{{ $page->name }}</h1>
			<ul class="personal_wr">
				@foreach( $personal as $pers )
					<li>
						<a class="pers_img" href="/personal/{{ $pers->slug }}">
							<img src="@if( $pers->image ) /uploads/personal/thumbs/{{ $pers->image }} @else /frontend/img/rev_def.png @endif" alt="{{ $pers->name }}">
						</a>
						<div class="fio">{{ $pers->name }}</div>
						<p>{{ $pers->job }}</p>
						<a href="/personal/{{ $pers->slug }}" class="details">Подробнее</a>
				@endforeach
			</ul>
		</div>
		<!-- personal end -->
	</div>
	<!-- wrapper end -->
@endsection