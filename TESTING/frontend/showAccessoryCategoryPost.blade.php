@extends('frontend.layout_main')

@section('main')

	<div class="wrapper_1095">
		<div class="wrapper">

			@include('frontend._offers_slider')

			<div class="brands">
				<div class="brands_slider">
					@foreach( $brands as $br )
						<a href="/brand/{{ $br->slug }}" class="slide">
							<img src="/uploads/brands/{{ $br->image }}" alt="{{ $br->name }}">
						</a>
					@endforeach
				</div>
				<!-- brands slider end -->
			</div>
			<!-- brands end -->

			<div class="breadcrumbs clearfix">
				<a href="{{ URL::previous() }}" class="back fleft">&lt; Назад</a>
				<ul class="fleft">
					<li><a href="/">Главная</a>&ensp;/&ensp;
					<li>{{ $page->name }}
				</ul>
			</div>
			<!-- breadcrumbs end -->

			<div class="catalog clearfix">
				<aside class="fleft">
					<p class="title">{{ $page->name }}</p>

					@if( count($articles) )
						<div class="additional_info">
							<p class="heading">Дополнительная информация</p>
							<ul>
								@foreach( $articles as $art )
									<li><a href="/articles/{{ $art->slug }}">{{ $art->name }}</a></li>
								@endforeach
							</ul>
						</div>
					@endif
					<!-- additional_info end -->

					<!-- form end -->

					@include('frontend._aside_news')
				</aside>
				<!-- aside end -->
				<div class="products_wr fright">

					@if( count($accessories) )

						<p class="count_products">Найдено {{ $accessories_total }} {{ Lang::choice('аксессуар|аксессуара|аксессуаров', $accessories_total, array(), 'ru') }}</p>

						<div class="sorting clearfix">
							<form class="fleft">
								<label for="sort_by">Сортировать по: </label>
								<select name="sort_by" id="sort_by">
									@foreach( $sort_by_var as $k => $sb )
										<option @if( Session::get('sort_by') == $k ) selected="true" @endif value="{{ $k }}">{{ $sb }}</option>
									@endforeach
								</select>
								<label for="prod_per_page">Аксессуаров на странице:</label>
								<select name="per_page" id="prod_per_page">
									@foreach( $per_page_opt as $pp )
										<option @if( Session::get('per_page') == $pp ) selected="true" @endif value="{{ $pp }}">{{ $pp }}</option>
									@endforeach
								</select>
							</form>

							@include('frontend._pagination', ['paginator' => $accessories->appends(['sort_by'=> Session::get('sort_by'), 'per_page' => Session::get('per_page')])])
							<!-- pagination end -->
						</div>
						<!-- sorting end -->
						<ul class="products clearfix">
							@foreach( $accessories as $ac )
								<li>
									<div class="prod_item">
										<a href="/accessory/{{ $ac->slug }}" class="main_link">
											<div class="img">
												<img src="@if( $img = unserialize($ac->imgs)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/rev_def.png @endif" alt="{{ $ac->name }}">
											</div>
											<div class="pr_name">
												<span>{{ $ac->name }}</span>
											</div>
										</a>
										<div class="price">
											@if( ( $ac->discount) != 0 )
												<span class="old_pr">
													@if( isset($user) && $user->gl_discount != 0 )
														{{ $ac->price - $ac->price * $user->gl_discount/100 }}
													@else
														{{ $ac->price }}
													@endif
												 грн
												</span>
											@endif
											<span class="@if($ac->discount==0)perm_pr @else new_pr @endif">
												@if( isset($user) && $user->gl_discount != 0 )
													{{ $ac->price - $ac->price * $ac->discount/100 - $ac->price * $user->gl_discount/100 }}
												@else
													{{ $ac->price - $ac->price * $ac->discount/100 }}
												@endif
											 грн
											</span>
										</div>
										<div class="clearfix">
											<form class="tocart">
												<input type="submit" data-id="{{ $ac->id }}" data-product-type="1" value="Купить">
											</form>
										</div>
									</div>
							@endforeach
						</ul>

						<div class="post_products_pagination">
							@include('frontend._pagination', ['paginator' => $accessories->appends(['sort_by'=> Session::get('sort_by'), 'per_page' => Session::get('per_page')])])
						</div>
					@else
						В данной категории аксессуары отсутствуют
					@endif

					<div class="cat_description">
					{!! $page->body !!}
					</div>
				</div>
				<!-- products_wr end -->
			</div>
			<!-- catalog end -->
		</div>
		<!-- wrapper end -->
	</div>
	<!-- wrapper_1095 end -->

	<!-- add to cart message -->
	<div class="overlay"></div>
	<div class="addedToCart clearfix">
		<p>Аксессуар добавлен в корзину</p>
		<a href="#" class="fleft closeAddToCart">Продолжить покупки</a>
		<a href="/cart" class="fright">Оформить заказ</a>
	</div>


@endsection


@section('scripts')
	<!-- the jScrollPane script -->
	<script src="/frontend/js/jscrollpane.js"></script>

	<script>
		$('.brands_slider').bxSlider({
			slideWidth: 120,
			minSlides: 6,
			maxSlides: 6,
			slideMargin: 20,
			pager: false
		});

		// отправка формы при изменении значения
		$('.sorting select').change(function(){
			$(this).closest('form').submit();
		});

		// Добавление к сравнению
		$('.tocompare input').click(function(){

			$.post('/compare', { _token: '{{ csrf_token() }}', id: $(this).data('id') }, function(data){
				console.log(data);
			});
			$(this).attr('disabled','true');
		});


		// $('.viewed_compare_form input').click(function(){

		// 	$.post('/compare', { _token: '{{ csrf_token() }}', id: $(this).data('id') });
		// 	$(this).closest('form').css('display','none').after("<a href='/compare' class='compare'>В сравнение</a>");
		// });

		// Добавление в корзину 
		$('.tocart input').click(function(){
		yaCounter36382700.reachGoal('addtobacket');
ga('send', 'event', 'add_card', 'send');
			$.post( '/tocart', { _token: '{{ csrf_token() }}', product_id: $(this).data('id'), prod_type: $(this).data('productType') },
			 function(data){
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
			return false;
		})


		$(function(){
			$('.scroll-pane').jScrollPane();
			$('.aside_news').jScrollPane();
		});

	</script>
@endsection