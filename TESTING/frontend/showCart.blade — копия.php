@extends('frontend.layout_main')

@section('main')
<div class="wrapper_1095">
	<div class="wrapper cart_wr">
		<p class="page_title">{{ $page->name }}</p>
		@if( count($products) || count($accessories) || count($lens) )
			<table>
				<tr class="title">
					<td>Название</td>
					<td>Изображение</td>
					<td>Цена</td>
					<td>Количество</td>
					<td>Сумма</td>
					<td>Удалить</td>
				</tr>
				@foreach( $products as $pr )
				<tr>
					<td><a href="/product/{{ $pr->slug }}">{{ $pr->name }}</a></td>
					<td><img src="@if( $pr->imgs != '' )/uploads/products/sm/{{ unserialize($pr->imgs)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $pr->name }}"></td>
					<td>
						@if( isset($user) && $user->gl_discount != 0 )
							{{ $pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->gl_discount/100 }}
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
							<input type="hidden" name="type" value="{{ $pr->type }}">
							<input type="text" name="quantity" class="quantity" value="{{ $cur_ids[$pr->type][$pr->id] }}" onchange="this.form.submit()">
							<a href="#" class="plus"></a>
						</form>
					</td>
					<td>
						@if( isset($user) && $user->gl_discount != 0 )
							{{ ($pr->price - $pr->price * $pr->discount/100 - $pr->price * $user->gl_discount/100) * $cur_ids[$pr->type][$pr->id] }}
						@else
							{{ ($pr->price - $pr->price * $pr->discount/100) * $cur_ids[$pr->type][$pr->id] }}
						@endif
						 Грн
					</td>
					<td>
						<form action="remove_from_cart" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="product_id" value="{{ $pr->id }}">
							<input type="hidden" name="type" value="{{ $pr->type }}">
							<input type="image" src="/frontend/img/icons/close.png" alt="close">
						</form>
					</td>
				</tr>
				@endforeach
				@foreach( $lens as $len )
				<tr>
					<td><a href="/lens/{{ $len->slug }}">{{ $len->name }}</a></td>
					<td><img src="@if( $len->imgs != '' )/uploads/lens/sm/{{ unserialize($len->imgs)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $len->name }}"></td>
					<td>
					@if( isset($user) && $user->len_discount != 0 )
						{{ $len->price - $len->price * $len->discount/100 - $len->price * $user->len_discount/100 }}
					@else
						{{ $len->price - $len->price * $len->discount/100 }}
					@endif
					 Грн</td>
					<td>
						<form action="change_quantity" method="POST">
							<a href="#" class="minus"></a>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="product_id" value="{{ $len->id }}">
							<input type="hidden" name="type" value="3">
							<input type="text" name="quantity" class="quantity" value="{{ $cur_ids[3][$len->id] }}" onchange="this.form.submit()">
							<a href="#" class="plus"></a>
						</form>
					</td>
					<td>{{ $len->price_total }} Грн</td><td>
						<form action="remove_from_cart" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="product_id" value="{{ $len->id }}">
							<input type="hidden" name="type" value="3">
							<input type="image" src="/frontend/img/icons/close.png" alt="close">
						</form>
					</td>
				</tr>
				@endforeach
				@foreach( $accessories as $ac )
				<tr>
					<td><a href="/accessory/{{ $ac->slug }}">{{ $ac->name }}</a></td>
					<td><img src="@if( $ac->imgs != '' )/uploads/accessories/sm/{{ unserialize($ac->imgs)[0] }} @else /frontend/img/def_sm.png @endif" alt="{{ $ac->name }}"></td>
					<td>
						@if( isset($user) && $user->gl_discount != 0 )
							{{ $ac->price - $ac->price * $ac->discount/100 - $ac->price * $user->gl_discount/100 }}
						@else
							{{ $ac->price - $ac->price * $ac->discount/100 }}
						@endif
					 Грн
					</td>
					<td>
						<form action="change_quantity" method="POST">
							<a href="#" class="minus"></a>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="product_id" value="{{ $ac->id }}">
							<input type="hidden" name="type" value="{{ $ac->type }}">
							<input type="text" name="quantity" class="quantity" value="{{ $cur_ids[$ac->type][$ac->id] }}">
							<a href="#" class="plus"></a>
						</form>
					</td>
					<td>
						@if( isset($user) && $user->gl_discount != 0 )
							{{ ($ac->price - $ac->price * $ac->discount/100 - $ac->price * $user->gl_discount/100) * $cur_ids[$ac->type][$ac->id] }}
						@else
							{{ ($ac->price - $ac->price * $ac->discount/100) * $cur_ids[$ac->type][$ac->id] }}
						@endif
					 Грн
					</td>
					<td>
						<form action="remove_from_cart" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="product_id" value="{{ $ac->id }}">
							<input type="hidden" name="type" value="{{ $ac->type }}">
							<input type="image" src="/frontend/img/icons/close.png" alt="close">
						</form>
					</td>
				</tr>
				@endforeach
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
							<input type="submit" value="Оформить заказ">
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
									<input type="submit" value="Оформить заказ">
								</div>
								<div class="fright">
									<p class="heading">Способ доставки</p>
									<div class="deliv_wr clearfix">
										<div class="deliv_links fleft">
											<a href="#self" class="active">Самовывоз</a>
											<a href="#our">Доставка по Киеву и области</a>
											<a href="#post">Новая почта</a>
										</div>
										<div class="deliv_content fright">
											<div id="self">
												Свой заказ Вы можете забрать по адресу {{ $settings[5]->value }}
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
										<input type="submit" value="Оформить заказ">
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


</script>

@endsection