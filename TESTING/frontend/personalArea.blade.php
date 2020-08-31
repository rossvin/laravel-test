@extends('frontend.layout_main')

@section('main')

	<div class="wrapper">
		<div class="pers_area">

			<div class="title">{{ $page->name }}</div>

			@if (Auth::check())
				<div class="clearfix">
					<div class="user_info fleft">
						<table>
							<tr>
								<td>Логин</td>
								<td>{{ $user->login }}</td>
							</tr>
							<tr>
								<td>Электронная почта</td>
								<td>{{ $user->email }}</td>
							</tr>
							@if( $user->phone )
								<tr>
									<td>Телефон</td>
									<td>{{ $user->phone }}</td>
								</tr>
							@endif
							@if( count( $orders ) )
								<tr>
									<td>Накопленная сумма</td>
									<td>{{ $total_ordered }} грн</td>
								</tr>
							@endif
							@if( $user->gl_discount != 0 )
								<tr>
									<td>Скидка на очки</td>
									<td>{{ $user->gl_discount }} %</td>
								</tr>
							@endif
							@if( $user->len_discount != 0 )
								<tr>
									<td>Скидка на линзы</td>
									<td>{{ $user->len_discount }} %</td>
								</tr>
							@endif
						</table>
					</div>
					<!-- user_info end -->
					<div class="right_section fright">
						<a href="/edit-info">Редактировать личные данные</a>
						<a href="/logout">Выйти</a>
					</div>
					<!-- fright end -->
				</div>
				<!-- clearfix end -->
				@if( count( $orders ) )
				<table class="ordered_pr">
					<tr>
						<td>Номер заказа</td>
						<td>Дата заказа</td>
						<td>Заказанные товары</td>
						<td>Информация о заказе</td>
						<td>Статус заказа</td>
					</tr>
					@foreach( $orders as $order )
						<tr>
							<td>№ {{ $order->id }}</td>
							<td>{{ $order->created_at->format('d.m.Y h:i') }}</td>
							<td>
								@foreach( $order->orderedproducts as $op )
									@if( $op->product_type != 5 )
										<a href="@if( $op->type == 1 )/product/@elseif( $op->type == 2 )/accessory/@elseif( $op->type == 3 )/lens/@elseif( $op->type == 4 )/len-facility/@endif{{ $op->slug }}" target="_blank">
											<img src="@if( $img = unserialize($op->imgs)[0] ) /uploads/products/{{ $img }} @else /frontend/img/def_sm.png @endif" alt="{{ $op->product_name}}">
										</a>
									@endif
								@endforeach
								@foreach( $orders_kits as $ok )
									@if( $ok->order_id == $order->id )
										<div class="kit">
											<a href="@if( $ok->type1 == 1 )/product/@elseif( $ok->type1 == 2 )/accessory/@elseif( $ok->type1 == 3 )/lens/@elseif( $ok->type1 == 4 )/len-facility/@endif{{ $ok->slug1 }}" target="_blank">
												<img src="@if( $img1 = unserialize($ok->img1)[0] ) /uploads/products/{{ $img1 }} @else /frontend/img/def_sm.png @endif" alt="{{ $ok->name1 }}">
											</a>
											<span>+</span>
											<a href="@if( $ok->type2 == 1 )/product/@elseif( $ok->type2 == 2 )/accessory/@elseif( $ok->type2 == 3 )/lens/@elseif( $ok->type2 == 4 )/len-facility/@endif{{ $ok->slug2 }}" target="_blank">
												<img src="@if( $img2 = unserialize($ok->img2)[0] ) /uploads/products/{{ $img2 }} @else /frontend/img/def_sm.png @endif" alt="{{ $ok->name2 }}">
											</a>
										</div>
									@endif
								@endforeach
							</td>
							<td>{{ count($order->orderedproducts) }} {{ Lang::choice('товар|товара|товаров', count($order->orderedproducts), array(), 'ru') }} на {{ $order->total_cost }} грн</td>
							<td>
								@if( $order->status == 0 )
									<span class="red">Новый</span>
								@elseif( $order->status == 1 )
									<span class="brown">В обработке</span>
								@else
									<span class="green">Выполнен</span>
								@endif
							</td>
						</tr>
					@endforeach
				</table>
				@endif
			@else
				@if( Session::has('error') || $errors->any() )
					@foreach( $errors->all() as $error )
						<li>{{ $error }}
					@endforeach
				@endif
				<form method="POST" action="/login" id="login_form">
					{!! csrf_field() !!}
					<div class="form_group">
						<label for="login"></label>
						<input type="text" name="login" id="login" placeholder="Ваш Логин" required>
					</div>
					<div class="form_group">
						<label for="password" class="password"></label>
						<input type="password" name="password" id="password" placeholder="Ваш пароль" required>
					</div>
					<input type="submit" value="Войти">
				</form>


				<form method="POST" action="/register" id="reg_form">
					{!! csrf_field() !!}

					<div class="form_group">
						<label for="login"></label>
						<input type="text" name="login" id="login" placeholder="Ваш Логин" required>
					</div>
					<div class="form_group">
						<label for="email" class="subscr_email"></label>
						<input type="email" name="email" id="email" placeholder="Ваш email" required>
					</div>

					<div class="form_group">
						<label for="phone" class="subscr_phone"></label>
						<input type="text" name="phone" id="phone" placeholder="Ваш телефон">
					</div>
					<div class="form_group">
						<label for="adress" class="home"></label>
						<input type="text" name="address" id="adress" placeholder="Ваш адрес">
					</div>

					<div class="form_group">
						<label for="password" class="password"></label>
						<input type="password" name="password" id="password" placeholder="Ваш пароль" required>
					</div>
					<input type="submit" value="Зарегистрироваться">
				</form>

				<!-- <a href="#" class="change_password">Изменить пароль</a> -->
				<a href="#" class="toggle">Зарегистрироваться</a>
			@endif
		</div>
	</div>
	<!-- wrapper end -->

@endsection

@section('scripts')
<script>

	var status = 1;
	$('.toggle').click(function(){
		if( status == 1 ){
			$(this).text('Войти');
			$('#login_form').hide(300);
			$('#reg_form').show(300);
			status = 0;
		}
		else{
			$(this).text('Зарегистрироваться');
			$('#reg_form').hide(300);
			$('#login_form').show(300);
			status = 1;
		}
		return false;
	});


</script>
@endsection