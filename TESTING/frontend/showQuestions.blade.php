@extends('frontend.layout')

@section('main')

	<div class="page_title"><h1>{!! $page->name !!}</h1></div>


		{!! $page->body !!}

	<div class="make_review">
		@if( $errors->any() )
        	<p class="error">Вы ошибись при заполнении формы. Попробуйте еще раз</p>
        @endif
        @if( Session::has('message') )
			<p class="success">{{ Session::get('message') }}</p>
        @endif

		<form method="POST" action="/ask">
			{!! csrf_field() !!}
			<div class="form_group">
				<label for="name">Имя *</label>
				<input type="text" name="name" id="name">
			</div>
			<div class="form_group">
				<label for="lname">Фамилия</label>
				<input type="text" name="lname" id="lname">
			</div>
			<div class="form_group">
				<label for="email">Email *</label>
				<input type="text" name="email" id="email">
			</div>
			<div class="form_group">
				<label for="phone">Телефон</label>
				<input type="text" name="phone" id="phone">
			</div>
			<div class="form_group">
				<label for="age">Возраст</label>
				<input type="text" name="age" id="age">
			</div>
			<div class="form_group">
				<label for="question">Ваш вопрос *</label>
				<textarea name="question" id="question"></textarea>
			</div>
			<p>Введите текст с картинки</p>
			<div class="form_group">
				<label>{!! captcha_img() !!}</label>
				<input type="text" name="captcha">
			</div>
			<div class="form_group">
				<input type="submit" value="Отправить">
			</div>
		</form>

		<p class="title">Заданные вопросы:</p>
		<ul class="answers">
			@foreach( $questions as $q )
				<li>
					<p class="date"><span>Отправлено: </span>{{ $q->created_at->format('d-m-Y') }}</p>
					<p class="name">{!! ucwords($q->name. ' ' . $q->lname) !!}</p>
					<p>{!! $q->question !!}</p>
					<p class="name">Treviso</p>
					<p>{!! $q->answer !!}</p>
				</li>
			@endforeach
		</ul>

		{!! $questions->render()  !!}

	</div>



@endsection