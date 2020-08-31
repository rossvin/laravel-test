@extends('frontend.layout_main')

@section('main')

	<div class="wrapper">
		<div class="pers_area">

			<div class="title">{{ $page->name }}</div>
			                                     
				<form method="POST" action="/edit-info">
					{!! csrf_field() !!}

					<div class="form_group">
						<label for="login"></label>
						<input type="text" value="{{ $user->login }}" name="login" id="login" placeholder="Введите Ваш Логин">
					</div>
					<div class="form_group">
						<label for="email" class="subscr_email"></label>
						<input type="email" value="{{ $user->email }}" name="email" id="email" placeholder="Введите Ваш email">
					</div>

					<div class="form_group">
						<label for="phone" class="subscr_phone"></label>
						<input type="text" value="{{ $user->phone }}" name="phone" id="phone" placeholder="Введите Ваш телефон">
					</div>
					<div class="form_group">
						<label for="adress" class="home"></label>
						<input type="text" value="{{ $user->address }}" name="address" id="adress" placeholder="Введите Ваш адрес">
					</div>

					<div class="form_group">
						<label for="password" class="password"></label>
						<input type="password" name="password" id="password" placeholder="Новый пароль">
					</div>
					<input type="submit" value="Изменить">
				</form>

		</div>
	</div>
	<!-- wrapper end -->

@endsection