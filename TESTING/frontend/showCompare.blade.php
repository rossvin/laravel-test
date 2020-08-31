@extends('frontend.layout_main')

@section('main')
<div class="wrapper_1095">
	<div class="wrapper cart_wr">
		<p class="page_title">{{ $page->name }}</p>
		<p class="compare_info">Всего товаров выбрано: {{ $total_compare }}</p>
		<div id="container">
		<div class="scroll-pane">
				<p class="page_title"></p>

				@if( isset($products) && count( $products ) > 1 )
				
				<div class="compare">
					<ul class="bxslid">
					@foreach( $products as $p )
					<li>
						<div class="compare_block">
							<div class="heading_compare">
								<img src="@if( $img = unserialize($p->imgs)[0] )/uploads/products/sm/{{ $img }} @else /frontend/img/def_sm.png @endif" alt="{{ $p->name }}">
								<span class="name_compare">{{ $p->name }}</span>
								<form action="remove_from_compare" method="POST">
									{!! csrf_field() !!}
									<input type="hidden" name="product_id" value="{{ $p->id }}">
									<input type="hidden" name="type" value="1">
									<input type="image" src="/frontend/img/icons/close_big.png" alt="close">
								</form>
							</div>
							<div class="name_compare">Категория {{ $p->cat_name }}</div>
							<div class="name_compare">Цена {{ $p->price  }}</div>
							<div class="compare_parameters">
								<div class="block">{!! $p->parameters !!}</div>
							</div>
						</div>
					</li>
					@endforeach
					</ul>
				</div>
				
			

				@else
					<p>Вы добавили недостаточно товаров для сравнения</p>
				@endif
			</div>
		</div>
	</div>
	<!-- wrapper end -->
</div>
<!-- wrapper 1095 end -->
@endsection


@section('scripts')
<script type="text/javascript" src="/frontend/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/frontend/js/jquery.jscrollpane.min.js"></script>
<script src="/frontend/js/jquery.bxslider.min.js"></script>
<script>
			$('.bxslid').bxSlider({
			  auto: false,
			  minSlides: 1,
			  maxSlides: 2,
			  slideWidth: 475
			
			});
</script>
@endsection
@section('styles')
<style type="text/css">
.bx-pager{
	height: 20px;
    top: -40px;
    }
</style>
	<link href="/frontend/css/jquery.jscrollpane.css" rel="stylesheet">
	<!-- <link href="/frontend/css/social-likes_flat.css" rel="stylesheet"> -->
@endsection