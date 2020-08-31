@extends('frontend.layout')

@section('main')
	@include('frontend._breadcrumbs')

	<div class="prod_wr">
		<div class="clearfix">
			<div class="fleft">
				<div class="pr_title">
					@if( $previous_pr )
						<a href="/len-facility/{{ $previous_pr->slug }}"></a>
					@endif
					<span>{{ $page->name }} {{ $page->code }}</span>
					@if( $next_pr )
						<a href="/len-facility/{{ $next_pr->slug }}" class="next"></a>
					@endif
				</div>
				<div class="product_sl">
					@if( $page->share == 1 )
						<div class="sale">sale</div>
					@elseif( $page->newest == 1 )
						<div class="new">new</div>
					@elseif( $page->hit == 1 )
						<div class="hit">хит</div>
					@endif
					@if( $prod_imgs )
						<ul class="bxslider_p">
							@foreach( $prod_imgs as $pi )
								<li>
									<a class="big_image" href="/uploads/products/{{ $pi }}">
										<img src="/uploads/products/lg/{{ $pi }}" alt="{{ $page->name }}">
									</a>
								</li>
							@endforeach
						</ul>

						<div id="bx-pager">
							@foreach( $prod_imgs as $k => $pi )
								<a data-slide-index="{{ $k }}" href=""><img src="/uploads/products/sm/{{ $pi }}" alt="{{ $page->name }}"></a>
							@endforeach
						</div>
					@else
						<img src="/frontend/img/offers_def.png" alt="{{ $page->name }}">
					@endif
				</div>
				<!-- product_sl end -->
				<div class="prod_networks clearfix">
					<div class="fleft">
						<p>Рассказать друзьям:</p>
						<script type="text/javascript">(function() {
						  if (window.pluso)if (typeof window.pluso.start == "function") return;
						  if (window.ifpluso==undefined) { window.ifpluso = 1;
						    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
						    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
						    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
						    var h=d[g]('body')[0];
						    h.appendChild(s);
						  }})();</script>
						<div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,nocounter,sepcounter=1,theme=14" data-services="vkontakte,odnoklassniki,facebook,google" data-url="http://{{Request::getHttpHost()}}/product/{{ $page->slug }}" data-title="{{ $page->name }}"></div>
					</div>
				</div>
				<!-- prod_networks end -->
			</div>
			<!-- fleft end -->

			<div class="buy_section fright">
				<div class="brand_img">
					@if( $page->brand_img )
						<a href="/brand/{{ $page->brand_slug }}">
							<img src="/uploads/brands/thumbs/{{ $page->brand_img }}" alt="{{ $page->brand_name }}">
						</a>
					@endif
				</div>

				<div class="prod_info">
					<form class="tocart">
						<input type="hidden" name="product_id" value="{{ $page->id }}">
						<input type="hidden" name="prod_type" value="1">
						{!! csrf_field() !!}
						<div class="size">
							<p class="heading">Обьем</p>
							@foreach( $page->packings as $k => $pack )
								<label><input type="radio" class="pack_size" name="prod_size" data-pack-id="#pack{{ $page->id }}{{ $k }}" @if( $k == 0 ) checked @endif value="{{ $pack->size }}">{{ $pack->size }} мл.</label>
							@endforeach
						</div>

						<div class="quantity">
							<p class="heading">Количество</p>
							<select name="quantity" id="len_f_quantity">
								@for( $i=1; $i<=10; $i++ )
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
						<div class="fon-fix-wr">
						@foreach( $page->packings as $k => $pp )
							<div class="prices @if( $k == 0 ) visible @endif" id="pack{{ $page->id }}{{ $k }}">
								@if( $pp->discount != 0 || $user->len_discount != 0 )
									<p class="new_price">{{ $pp->price - $pp->price * $pp->discount/100 - $pp->price * $user->len_discount/100 }} грн</p>
									<p class="old_price">{{ $pp->price }} грн</p>
								@else( ( $pp->discount) != 0 )
									<p class="@if($pp->discount == 0)perm_price @else new_price @endif">{{ $pp->price }} грн</p>
								@endif
							</div>
						@endforeach
						
						<input type="submit" value="Купить">
					</form>
					<form class="tocompare len_facil">
						<input type="submit" value="Сравнить" data-id="{{ $page->id }}" data-type="1">
					</form>
				  </div>
				</div>
			</div>
			<!-- buy section end -->
		</div>
		<!-- clearfix end -->

		@if( count( $alike_pr ) )
			<div class="glass_slider">
				<div class="gl_slider">
					@foreach( $alike_pr as $ap )
						<a class="slide" href="/product/{{ $ap->slug }}">
							<img src="/uploads/products/sm/{{ unserialize($ap->imgs)[0] }}" alt="{{ $ap->name }}">
						</a>
					@endforeach
				</div>
			</div>
		@endif
		<!-- glass_slider end -->
		
		<!-- комплекты -->
		@if( count( $suggested_ac ) )
			@include('frontend._suggested')
		@endif


		<div class="prod_tabs">
			<div class="tab_links">
				<a href="#descr" class="active">Описание</a>
				<a href="#params">Характеристики</a>
				<a href="#reviews">Отзывы</a>
			</div>
			<div class="tab_content">
				<div id="descr">
					{!! $page->descr !!}
				</div>
				<div id="params">
					{!! $page->parameters !!}
				</div>
				<div id="reviews">
					@if( Session::has('rev_message') )
						<p class="heading">{{ Session::get('rev_message') }}</p>
					@else
						<p class="heading">Оставить отзыв</p>

						@if( $errors->any() )
							<p class="error">Вы ошибись при заполнении формы. Попробуйте еще раз</p>
						@endif

						<form method="POST" action="/productReview">
							{!! csrf_field() !!}
							<input type="hidden" name="product_id" value="{{ $page->id }}">
							<input type="hidden" name="type" value="4">
							<input type="text" name="name" placeholder="Ваше имя">
							<textarea name="body" placeholder="Текст отзыва"></textarea>
							<input type="submit" value="Отправить">
						</form>
					@endif

					@if( count( $prod_reviews ) )
						<ul>
							@foreach( $prod_reviews as $pr_rev )
								<li>
									<p class="clearfix">
										<span class="fleft author">Автор отзыва: {{ $pr_rev->name }}</span>
										<span class="fright">Отзыв добавлен: {{ $pr_rev->created_at->format('d.m.Y') }} г.</span>
									</p>
									<p>{{ $pr_rev->body }}</p>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>
		</div>
		<!-- prod_tabs end -->
	</div>
	<!-- product wr end -->

	@include('frontend._notification')

@endsection


@section('users_info')
	@if( count($useful_info) )
		<div class="info_for_users">
			<div class="wrapper">
				<p class="heading">Полезная информация покупателю:</p>
				<ul>
					@foreach( $useful_info as $ui )
						<li><a href="/articles/{{ $ui->slug }}">{{ $ui->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
		<!-- info_for_users end -->
	@endif
@endsection


<!-- aside product blocks -->
@section('accessories')
	<div class="select_accessory">
		<p class="title">Подберите аксессуар:</p>
		@foreach( $accessories_cat as $ac )
			<a href="/accessories/{{ $ac->slug }}">{{ $ac->name }}</a>
		@endforeach
	</div>
	<!--  select_accessory end -->
@endsection

@section('viewed')
	@include('frontend._viewed_pr')
@endsection
<!-- end of aside product blocks -->

@section('styles')
	<link href="/frontend/css/jquery.formstyler.css" rel="stylesheet">
	<link href="/frontend/css/jquery.fancybox.css" rel="stylesheet">
@endsection

@section('scripts')

<script src="/frontend/js/jquery.formstyler.min.js"></script>
<script src="/frontend/js/jquery.fancybox.js"></script>
<script>

	$('.bxslider_p').bxSlider({
		pagerCustom: '#bx-pager',
		controls: false
	});

	$('.gl_slider').bxSlider({
		slideWidth: 110,
		minSlides: 5,
		maxSlides: 5,
		slideMargin: 10,
		pager: false
	});

	$('.sug_sl').bxSlider();

	$("input[type='checkbox'").styler();


	// изменение цены при изменении порции
	$('.pack_size').change(function(){
		var id = $(this).data('packId');
		$('.prices').hide();
		$(id).css('display', 'block');
	});


	// Добавление в корзину
	$('.tocart').submit(function(){

		$.post( '/len_facility_tocart' , $(this).serialize(), function(data){
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

	$('.buyPackage input').click(function(){

		$.post('/package_to_cart', { _token: '{{ csrf_token() }}', kit_id: $(this).data('kitId') },
		 function(data){
		 	console.log(data);
		 	$('.overlay').show();
		 	$('.addedToCart p').text('Комплект додавлен в корзину');
		 	$('.addedToCart').fadeIn(200);
		 	$('.cart_quant').text(data.quantity + " товаров");
		 	$('.cart_pr').text(data.total_price + " Грн");
		});

		return false;
	})

	// уведомление о добавлении в корзину
	$('.closeAddToCart').click(function(){
		$('.overlay').hide();
		$('.addedToCart').fadeOut(200);
		$('.addedToCart p').text('Товар добавлен в корзину');
		$('.addedToCompare').fadeOut(200);
		return false;
	})


	// Добавление к сравнению
	$('.tocompare input').click(function(){

		$.post('/compare', { _token: '{{ csrf_token() }}', id: $(this).data('id'), type: $(this).data('type') }, function(data){
			console.log(data);
		 	$('.overlay').show();
		 	$('.addedToCompare').fadeIn(200);
		});

		return false;
	});



	// tabs
	$('.tab_links a').click(function(){

		$('.tab_content div').hide();
		$('.tab_links a').removeClass('active');

		var cur = $(this).attr('href');
		$(this).addClass('active');
		$(cur).show();

		return false;
	});

	$("a.big_image").fancybox();

</script>
@endsection