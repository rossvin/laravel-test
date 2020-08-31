@extends('frontend.layout')

@section('main')

<?php if ($_SERVER['REQUEST_URI'] != "/categories/podbor-nochnyh-kontaktnyh-linz"): ?>
<h1 class="page_title">
	{!! $page->name !!}
</h1>
<?php endif; ?>

<?php if ($_SERVER['REQUEST_URI'] == "/categories/podbor-nochnyh-kontaktnyh-linz") : ?>
<h1 style="text-align: justify;"><span style="font-size: 18pt;">Ночные линзы в Херсоне и Николаеве</span></h1>
<?php endif; ?>

<div class="oculist_slider">
	@if( isset( $slides ) )
		<ul class="oculists_sl">
			@foreach( $slides as $os )
				<li><a href="@if($os->link){{ $os->link }}@else# @endif" target="_blank"><img src="/uploads/{{$image_path}}/{{ $os->image }}" alt="oculist slide"></a></li>
			@endforeach
		</ul>
	@endif
</div>

{!! $page->body !!}

@endsection


@section('master_services')

	@if( count($nested_categories) )
		<div class="master_services">
			<p>@if( $page->id == 7 || $page->parent_id == 7 ) Услуги офтальмолога @else Услуги мастера @endif</p>
			<ul>
				@foreach( $nested_categories as $nc )
					<li @if(Request::segment(2) == $nc->slug) class="active" @endif><a href="/categories/{{ $nc->slug }}">{{ $nc->name }}</a>
				@endforeach
			</ul>
		</div>
	@endif

@endsection

@section('scripts')
	<script>
		$('.oculists_sl').bxSlider({
			controls: false,
			auto: true,
			speed: 700
		});
	</script>
@endsection