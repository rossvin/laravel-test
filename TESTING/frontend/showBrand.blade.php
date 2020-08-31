	@include('frontend._top_section')

	<div class="wrapper_1095">
		<div class="wrapper">

			<div class="page_wr clearfix">
				<div class="page_content fleft">
					<h1 class="page_title">{{ $page->name }}</h1>

					<div class="brand_descr">
						@if( $page->image )
							<img src="/uploads/brands/{{ $page->image }}" class="fleft" alt="{{ $page->name }}">
						@endif
						{!! $page->body !!}
					</div>

					<div class="products_wr">
						@if( count($products) )
							<ul class="products clearfix">
								@foreach( $products as $pr )
									<li>
										<div class="prod_item">
											<a href="@if( $pr->type == 1 )/product/@elseif( $pr->type == 2 )/accessory/@elseif( $pr->type == 3 )/lens/@elseif( $pr->type == 4 )/len-facility/@endif{{ $pr->slug }}" class="main_link">
												<div class="img">
													<img src="@if( $img = unserialize($pr->imgs)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/rev_def.png @endif" alt="{{ $pr->name }}">
												</div>
												<div class="pr_name">
													<span>{{ $pr->name }}</span>
												</div>
											</a>
											<div class="price">
												@if( $pr->category_id == 5 && $pr->only_packages == 0 || $pr->category_id != 5 && $pr->discount != 0 )
													<span class="old_pr">{{ $pr->price }} грн</span>
												@elseif( $pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount != 0)
													<span class="old_pr">{{ $pr->package_price }} грн</span>
												@endif
												<span class="@if( ($pr->category_id != 5 && $pr->discount==0) || ($pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount==0))perm_pr @else new_pr @endif">{{ $pr->price_r }} грн</span>
											</div>
											<div class="clearfix">
												<form class="fleft tocart">
													<input type="submit" data-id="{{ $pr->id }}" data-product-type="@if( $pr->type == 4) 4 @else 1 @endif" data-product-size="@if( $pr->type == 4) {{ $pr->size }} @else 1 @endif" value="Купить">
												</form>
												<form class="tocompare">
													<input type="submit" value="" data-id="{{ $pr->id }}" data-type="1">
												</form>
											</div>
											@if( $pr->share == 1 ) <div class="sale">sale</div> @endif
											@if( $pr->newest == 1 ) <div class="new">new</div> @endif
											@if( $pr->hit == 1 ) <div class="hit">хит</div> @endif
										</div>
								@endforeach
							</ul>
						@else
							По данному бренду нет товаров
						@endif
					</div>
					<!-- products_wr end -->

					<!-- add to cart message -->
					<div class="overlay"></div>
					<div class="addedToCart clearfix">
						<p>Товар добавлен в корзину</p>
						<a href="#" class="fleft closeAddToCart">Продолжить покупки</a>
						<a href="/cart" class="fright">Оформить заказ</a>
					</div>
				</div>
				<!-- page_content end -->

				<div class="brands_right fright">
					<p class="brands_title">Бренды</p>
					<ul>
						@foreach( $brands_all as $ba )
							<li>
								<a href="/brand/{{ $ba->slug }}">
									<img src="/uploads/brands/{{ $ba->image }}" alt="{{ $ba->name }}">
								</a>
							</li>
						@endforeach
					</ul>
					@include('frontend._viewed_pr')
					@include('frontend._aside_news')
				</div>
				<!-- prod right end -->
			</div>
			<!-- page_wr end -->
			@include('frontend._notification')
		</div>
		<!-- wrapper end -->
	</div>
	<!-- wrapper_1095 end -->
</div>
<!-- global wrapper end -->

@include('frontend._footer')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/frontend/js/jscrollpane.js"></script>

<script>

	// отправка формы при изменении значения
	$('.sorting select').change(function(){
		$(this).closest('form').submit();
	})

	// Добавление в корзину 
	$('.tocart input').click(function(){
	yaCounter36382700.reachGoal('addtobacket');
ga('send', 'event', 'add_card', 'send');
		var slug = '/tocart';

		var product_type = Number( $(this).data('productType') );
		if( product_type == 4 )
			var slug = '/len_facility_tocart';

		$.post( slug, { _token: '{{ csrf_token() }}', product_id: $(this).data('id'), prod_type: $(this).data('productType'), prod_size: $(this).data('productSize') },
		 function(data){
		 	console.log(data);
		 	$('.overlay').show();
		 	$('.addedToCart').fadeIn(200);
		 	$('.cart_quant').text(data.quantity + " товаров");
		 	$('.cart_pr').text(data.total_price + " Грн");
		});

		return false;
	});


	// Добавление в корзину из рубрики вы смотрели
	$('.viewedtocart').submit(function(){

		var prod_type = Number($(this).find('input').data('productType'));
		var slug = '/tocart';
		var data = { _token: $(this).data('token'), product_id: Number($(this).find('input').data('id')), prod_type: prod_type };

		if( prod_type == 3 ){
			data.quantity_type = 1;
			data.quantity = 'def';
			slug = '/lentocart';
		}
		else if(prod_type == 4 ){
			data.prod_size = Number($(this).find('input').data('productSize'));
			slug = '/len_facility_tocart';
		}

		$.post( slug, data, function(data){
		 	$('.overlay').show();
		 	$('.addedToCart').fadeIn(200);
		 	$('.cart_quant').text(data.quantity + " товаров");
		 	$('.cart_pr').text(data.total_price + " Грн");
		});

		return false;
	});


	// уведомление о добавлении в корзину
	$('.closeAddToCart').click(function(){
		$('.overlay').hide();
		$('.addedToCart').fadeOut(200);
		$('.addedToCompare').fadeOut(200);
		return false;
	})

	// Добавление к сравнению
	$('.tocompare input').click(function(){

		$.post('/compare', { _token: '{{ csrf_token() }}', id: $(this).data('id'), type: $(this).data('type') }, function(data){
			$('.overlay').show();
			$('.addedToCompare').fadeIn(200);
		});
		return false;
	});


	$(function(){
		$('.aside_news').jScrollPane();
	});


</script>

@section('scripts')
@show

</body>
</html>