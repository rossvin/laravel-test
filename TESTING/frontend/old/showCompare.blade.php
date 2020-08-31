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
				
				<table class="compare">
					<tr>
						@foreach( $products as $p )
							<td class="heading" colspan="">
								<img src="@if( $img = unserialize($p->imgs)[0] )/uploads/products/sm/{{ $img }} @else /frontend/img/def_sm.png @endif" alt="{{ $p->name }}">
								<span>{{ $p->name }}</span>
								<form action="remove_from_compare" method="POST">
									{!! csrf_field() !!}
									<input type="hidden" name="product_id" value="{{ $p->id }}">
									<input type="hidden" name="type" value="1">
									<input type="image" src="/frontend/img/icons/close_big.png" alt="close">
								</form>
							</td>
						@endforeach
					</tr>
					<tr>
						@foreach($products as $p)
							<td colspan="">Категория {{ $p->cat_name }}</td>
						@endforeach
						
					</tr>
					<tr>
						@foreach($products as $p)
							<td>Цена {{ $p->price  }}</td>
							
						@endforeach
					</tr>
				</table>
				<div class="compare_parameters">
					@foreach($products as $p)
					<div class="block">{!! $p->parameters !!}</div>
					@endforeach
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
<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
</script>
@endsection
@section('styles')
	<link href="/frontend/css/jquery.jscrollpane.css" rel="stylesheet">
	<!-- <link href="/frontend/css/social-likes_flat.css" rel="stylesheet"> -->
@endsection