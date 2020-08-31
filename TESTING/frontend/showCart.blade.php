@extends('frontend.layout_main')

@section('main')
<div class="wrapper_1095">
	<div class="wrapper cart_wr"> 
		<p class="page_title">{{ $page->name }}</p>
		@if( count($products) || count($len_facilities) || count($kits) )
			<table>
				<tr class="title">
					<td>Название</td>
					<td>Изображение</td>
					<td>Цена</td>
					<td>Количество</td>
					<td>Сумма</td>
					<td>Удалить</td>
				</tr>
				@if($products)
					@foreach( $products as $pr )
					<tr>
						<td><a href="@if($pr->type==3)/lens/@else/product/@endif{{ $pr->slug }}">{{ $pr->name }}</a></td>
						<td><img src="@if( $pr->imgs != '' )/uploads/products/sm/{{ unserialize($pr->imgs)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $pr->name }}"></td>
						<td>
							@if( in_array( $pr->type, [1,2]) )
								{{ $pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->gl_discount/100 }}
							@elseif( $pr->type == 3 && $pr->only_packages != 1 )
								{{ $pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->len_discount/100 }}
							@elseif( $pr->type == 3 && $pr->only_packages == 1 )
								{{ $pr->price_total / ($cur_ids[1][$pr->id] / $pr->in_package) }}
							@else
								{{ $pr->price - $pr->price * $pr->discount/100 }}
							@endif
							 Грн
						</td>
						<td>
							<form action="change_quantity" method="POST">
								<a href="#" class="minus"></a>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="1">
								<input type="text" name="quantity" class="quantity" value="@if( $pr->type == 3 && $pr->only_packages == 1 ) {{ $cur_ids[1][$pr->id] / $pr->in_package }} @else {{ $cur_ids[1][$pr->id] }} @endif" onchange="this.form.submit()">
								<a href="#" class="plus"></a>
							</form>
						</td>
						<td>
							@if( in_array( $pr->type, [1,2]) )
								{{ ($pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->gl_discount/100) * $cur_ids[1][$pr->id] }}
							@elseif( $pr->type == 3 )
								{{ $pr->price_total }}
							@else
								{{ ($pr->price - $pr->price * $pr->discount/100) * $cur_ids[1][$pr->id] }}
							@endif
							 Грн
						</td>
						<td>
							<form action="remove_from_cart" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="1">
								<input type="image" src="/frontend/img/icons/close.png" alt="close">
							</form>
						</td>
					</tr>
					@endforeach
				@endif

				@if($len_facilities)
					@foreach( $len_facilities as $pr )
					<tr>
						<td><a href="/len-facility/{{ $pr->slug }}">{{ $pr->name }} ( {{ $pr->size }}мл. )</a></td>
						<td><img src="@if( $pr->imgs != '' )/uploads/products/sm/{{ unserialize($pr->imgs)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $pr->name }}"></td>
						<td>
							@if( $pr->type == 4 && isset($user) && $user->len_discount != 0 )
								{{ $pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->len_discount/100 }}
							@else
								{{ $pr->price - $pr->price * $pr->discount/100 }}
							@endif
							 Грн
						</td>
						<td>
							<form action="change_quantity" method="POST">
								<a href="#" class="minus"></a>
								{!! csrf_field() !!}
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="2">
								<input type="hidden" name="size" value="{{ $pr->size }}">
								<input type="text" name="quantity" class="quantity" value="{{ $lf_ids[ $pr->id ][ $pr->size ] }}" onchange="this.form.submit()">
								<a href="#" class="plus"></a>
							</form>
						</td>
						<td>
							@if( $pr->type == 4 && isset($user) && $user->len_discount != 0 )
								{{ ($pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->len_discount/100) * $lf_ids[ $pr->id ][ $pr->size ] }}
							@else
								{{ ($pr->price - $pr->price * $pr->discount/100) * $lf_ids[ $pr->id ][ $pr->size ] }}
							@endif
							 Грн
						</td>
						<td>
							<form action="remove_from_cart" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="2">
								<input type="hidden" name="size" value="{{ $pr->size }}">
								<input type="image" src="/frontend/img/icons/close.png" alt="close">
							</form>
						</td>
					</tr>
					@endforeach
				@endif
				@if($kits)
					@foreach( $kits as $pr )
					<tr>
						<td>
							<a href="@if($pr->type1 == 4)/len-facility/@elseif($pr->type1 == 3)/lens/@elseif($pr->type1 == 2)/accessories/@else/product/@endif{{ $pr->slug1 }}">{{ $pr->name1 }}</a><br>
							<a href="@if($pr->type2 == 4)/len-facility/@elseif($pr->type2 == 3)/lens/@elseif($pr->type2 == 2)/accessories/@else/product/@endif{{ $pr->slug2 }}">{{ $pr->name2 }}</a>
						</td>
						<td>
							<img src="@if( $pr->img1 != '' )/uploads/products/sm/{{ unserialize($pr->img1)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $pr->name1 }}">
							<img src="@if( $pr->img2 != '' )/uploads/products/sm/{{ unserialize($pr->img2)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $pr->name2 }}">
						</td>
						<td>{{ $pr->price }} Грн</td>
						<td>
							<form action="change_quantity" method="POST">
								<a href="#" class="minus"></a>
								{!! csrf_field() !!}
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="5">
								<input type="hidden" name="size" value="0">
								<input type="text" name="quantity" class="quantity" value="{{ $kits_in_cart[ $pr->id ] }}" onchange="this.form.submit()">
								<a href="#" class="plus"></a>
							</form>
						</td>
						<td>{{ $pr->price * $kits_in_cart[ $pr->id ] }} Грн</td>
						<td>
							<form action="remove_from_cart" method="POST">
								{!! csrf_field() !!}
								<input type="hidden" name="product_id" value="{{ $pr->id }}">
								<input type="hidden" name="type" value="5">
								<input type="hidden" name="size" value="0">
								<input type="image" src="/frontend/img/icons/close.png" alt="close">
							</form>
						</td>
					</tr>
					@endforeach
				@endif
			</table>

			<p class="total_price">Общая стоимость: <span>{{ $total_price  }} Грн</span></p>
			
			@if( Session::has('message') )
				<p class="notification">{{ Session::get('message') }}</p>
			@endif

			@include('errors.formErrors')

			<div class="prod_tabs">
				<div class="tab_links">
					<a href="#descr" class="active">Быстрое оформление</a>
					<a href="#params">Полное оформление</a>
					<!-- <a href="#reviews">@if (Auth::check() ) Оформление для зарегистрированных пользователей @else Войти с паролем @endif</a> -->
				</div>
				<div class="tab_content">
					<div id="descr">
						<p class="heading">Контактная информация</p>
						<form method="POST" action="/quick_order">
							{!! csrf_field() !!}
							<div class="form_group">
								<label class="subscr_phone"></label><input type="text" name="phone" required placeholder="Телефон">
							</div>
							<textarea name="comment" placeholder="Ваш комментарий"></textarea>
							<input type="submit" value="Оформить заказ" onclick="yaCounter36382700.reachGoal('sendorder');">
						</form>
					</div>
					<!-- descr end -->
					<div id="params">
						<form method="POST" action="/full_order">
							{!! csrf_field() !!}
							<div class="clearfix">
								<div class="fleft">
									<p class="heading">Контактная информация</p>
									<div class="form_group">
										<label></label><input type="text" name="name" required placeholder="Имя">
									</div>
									<div class="form_group">
										<label class="subscr_phone"></label><input type="text" name="phone" required placeholder="Телефон">
									</div>
									<div class="form_group">
										<label class="subscr_email"></label><input type="email" name="email" required placeholder="Email">
									</div>
									<textarea name="comment" placeholder="Ваш комментарий"></textarea>
									<input type="submit" value="Оформить заказ" onclick="yaCounter36382700.reachGoal('sendorder');ga('send', 'event', 'send_order', 'button')">
								</div>
								<div class="fright">
									<p class="heading">Способ доставки</p>
									<div class="deliv_wr clearfix">
										<div class="deliv_links fleft">
											<a href="#self" class="active">Самовывоз</a>
											<a href="#our">Доставка по Херсону и области</a>
											<a href="#post">Новая почта</a>
										</div>
										<div class="deliv_content fright">
											<div id="self">
												<select name="place" style=" display: block;  width: 100%;  height: 32px; border-radius: 5px; border: 1px solid #dabb9d; margin-bottom: 10px; color: #cc8d62; padding: 0 10px;">
													<option value="не выбрано">Выберите адрес доставки </option>
													@foreach( $address as $a )
														<option value="{{ $a->name }}">{{ $a->name }}</option>
													@endforeach
												</select>
											</div>
											<div id="our">
												<p>Напишите свой адрес и мы доставим Ваш заказ</p>
												<div class="form_group">
													<label class="home"></label><input type="text" name="address" placeholder="Ваш адресс">
												</div>
											</div>
											<div id="post">
												
											</div>
										</div>
										<!-- deliv_content end -->
									</div>
									<!-- clearfix end -->

									<p class="heading">Способы оплаты:</p>
									<div class="pay_method">
										<label><input type="radio" name="pay_type" value="1" checked>Наличные</label>
										<label><input type="radio" name="pay_type" value="2">Предоплата на карту Privatbank</label>
										<label><input type="radio" name="pay_type" value="3">Безналичный расчет</label>
									</div>
								</div>
								<!-- fright end -->
							</div>
						</form>
					</div>
					<!-- params end -->
					<div id="reviews">
						@if (Auth::check())
							<form  method="POST" action="/auth_order">
								{!! csrf_field() !!}
								<div class="clearfix">
									<div class="fleft">
										<p class="heading">Введите комментарий к заказу</p>
										<textarea name="comment" placeholder="Ваш комментарий"></textarea>
										<input type="submit" value="Оформить заказ" >
									</div>
									<div class="fright">
										<p class="heading">Способ доставки</p>
										<div class="deliv_wr clearfix">
											<div class="deliv_links2 fleft">
												<a href="#self2" class="active">Самовывоз</a>
												<a href="#our2">Доставка по Киеву и области</a>
												<a href="#post2">Новая почта</a>
											</div>
											<div class="deliv_content fright">
												<div id="self2">
													Свой заказ Вы можете забрать по адресу ....
												</div>
												<div id="our2">
													<p>Напишите свой адрес и мы доставим Ваш заказ</p>
													<div class="form_group">
														<label class="home"></label><input type="text" name="address" placeholder="Ваш адресс">
													</div>
												</div>
												<div id="post2">
													
												</div>
											</div>
											<!-- deliv_content end -->
										</div>
										<!-- clearfix end -->

										<p class="heading">Способы оплаты:</p>
										<div class="pay_method">
											<label><input type="radio" name="pay_type" value="1" checked>Наличные</label>
											<label><input type="radio" name="pay_type" value="2">Предоплата на карту Privatbank</label>
											<label><input type="radio" name="pay_type" value="3">Безналичный расчет</label>
										</div>
									</div>
									<!-- fright end -->
								</div>
							</form>
						@else
							<p class="heading">Авторизация: </p>
							@if( Session::has('error') || $errors->any() )
								<p>Логин или пароль введен неправильно</p>
							@endif
							<form method="POST" action="/login" id="login_form">
								{!! csrf_field() !!}
								<div class="form_group">
									<label></label><input type="text" name="login" placeholder="Введите Ваш Логин">
								</div>
								<div class="form_group">
									<label class="password"></label><input type="password" name="password"  placeholder="Введите Ваш пароль">
								</div>
								<input type="submit" value="Войти">
							</form>
						@endif
					</div>
				</div>
			</div>
			<!-- prod_tabs end -->

			<!-- комплекты -->
			@if( isset( $suggested_ac ) )
				@include('frontend._suggested')
			@endif

		@else
			@if( Session::has('message') )
				<p class="notification">{{ Session::get('message') }}</p>
			@else
				<p class="msg">В вашей корзине еще нет товаров</p>
			@endif
		@endif
	</div>
	<!-- wrapper end -->
</div>
<!-- wrapper 1095 end -->
@endsection

@section('scripts')

<script>

	$('.minus').click(function(){

		if( $(this).siblings('.quantity').attr('value') != 1 ){
			$(this).siblings('.quantity').attr('value', $(this).siblings('.quantity').attr('value') - 1 );
			$(this).closest('form').submit();
		}
		return false;
	});

	$('.plus').click(function(){

		$(this).siblings('.quantity').attr('value', parseInt( $(this).siblings('.quantity').attr('value')) + 1 );
		$(this).closest('form').submit();
		return false;
	});

	$('.quantity').change(function(){
		if($(this).val() <= 0 )
			$(this).val(1);
		$(this).closest('form').submit();
	});

	// tabs
	$('.tab_links a').click(function(){
ga('send', 'event', 'sendorder', 'click');
		$('#descr, #params, #reviews').hide();
		$('.tab_links a').removeClass('active');

		var cur = $(this).attr('href');
		$(this).addClass('active');
		$(cur).show();

		return false;
	});

	// tabs
	$('.deliv_links a').click(function(){

		$('#our, #self, #post, #our2, #self2, #post2').hide();
		$('.deliv_links a').removeClass('active');

		var cur = $(this).attr('href');
		$(this).addClass('active');
		$(cur).show();

		return false;
	});

	$('.deliv_links2 a').click(function(){

		$('#our2, #self2, #post2').hide();
		$('.deliv_links2 a').removeClass('active');

		var cur = $(this).attr('href');
		$(this).addClass('active');
		$(cur).show();

		return false;
	});


	// слайдер комплектов
	$('.sug_sl').bxSlider();


	// купить комплект
	$('.buyPackage input').click(function(){

		$.post('/package_to_cart', { _token: '{{ csrf_token() }}', kit_id: $(this).data('kitId') },
		 function(data){
		 	location.reload();
		});
		return false;
	})

</script>

@endsection