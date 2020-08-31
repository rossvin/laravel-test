@extends('frontend.layout')

@section('main')

<div class="content brands_wr">
	<p class="p_title">{{ $page->name }}</p>

	<ul class="brands">
		<li>
			<span class="btn brands_btn">Бренды</span>
			<ul>
				@foreach( $brands['all_brands'] as $brand )
					<li><a href="/brand/{{ $brand->slug }}">{{ $brand->name }}</a></li>
				@endforeach
			</ul>
		</li>
		@foreach( $brands['letters'] as $k =>  $bl )
			<li>
				<span>{{ $k }}</span>
				<ul>
					@foreach($bl as $v)
						<li><a href="/brand/{{ $v['slug'] }}">{{ $v['name'] }}</a></li>
					@endforeach
				</ul>
			</li>
		@endforeach
	</ul>
	<!-- brands end -->

	{!! $page->body !!}

	<div class="prod_blocks">
		<ul>
			@foreach( $products as $pr )
				<li class="clearfix product{{ $pr->id }}">
					<a href="/product/{{ $pr->slug }}">
						<span class="prod_blocks_img">
							<img src="@if( $img = unserialize($pr->imgs)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/def_img.png @endif" alt="{{ $pr->code }}">
						</span>
					</a>
					<img src="/frontend/img/icons/stars{{ $pr->votes != 0 ? round($pr->rating_sum/$pr->votes) : 0 }}.png" alt="{{ $pr->code }}">
					<a href="/product/{{ $pr->slug }}">{{ $pr->name }}</a>
					<div class="quantity">
						<select name="quantity" class="pack_quantity">
							@foreach( $pr->packings as $k => $pack )
								<option value="{{ $pack->size }}" data-pack-id="#pack{{ $pr->id }}{{ $k }}">{{ $pack->size }} {{ $units[$pr->units] }}</option>
							@endforeach
						</select>
						@foreach( $pr->packings as $k => $pack )
							<div class="prices" id="pack{{ $pr->id }}{{ $k }}">
								<span class="price @if( $pack->discount != 0) old_price @endif">{{ $pack->price }} грн.</span>
								@if( $pack->discount != 0)
									<br> <span class="discount">{{ $pack->price - $pack->price * $pack->discount/100 }} грн.</span>
								@endif
							</div>
						@endforeach
					</div>
					<form class="fleft">
						<input type="submit" data-product-id="{{ $pr->id }}" class="btn tocart" value="В корзину">
					</form>
					<form class="fright">
						<input type="submit" class="btn" value="Быстрый заказ">
					</form>
					@if( $pr->hit == 1 )
						<span class="promo">хит продаж</span>
					@elseif( $pr->newest == 1 )
						<span class="promo">новинка</span>
					@elseif( $pr->recommend == 1 )
						<span class="promo double">мы рекомендуем</span>
					@elseif( $pr->promo == 1 )
						<span class="promo double">эксклюзивное предложение</span>
					@elseif( $pr->bonus  == 1 )
						<span class="bonus"></span>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
	<!-- product blocks end -->
</div>
<!-- brands wrapper end  -->

@endsection


@section('scripts')
<script>
	// изменение цены при изменении порции
	$('.pack_quantity').change(function(){
		var id = $(this).find('option:selected').data('packId');
		$(this).siblings('.prices').hide();
		$(id).css('display', 'inline-block');
	});
	// добавить в корзину
	$('.tocart').click(function(){

		var product_id = $(this).data('productId');

		$.post('/tocart', {_token: '{{ csrf_token() }}', product_id: product_id, size: $('.product' + product_id).find('.pack_quantity').val() },
		function(data){
			console.log(data);
			$('.overlay').show();
			$('.popup').fadeIn(500);
		});
		return false;
	});
	// закрыть уведомление
	$('#close_popup').click(function(){
		$('.popup').fadeOut(500);
		$('.overlay').delay(500).hide();
		return false;
	});
</script>
@endsection