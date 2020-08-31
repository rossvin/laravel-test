@extends('frontend.layout')

@section('main')

	<h1 class="page_title">
		{!! $page->name !!}
	</h1>

	@if( count($reviews) )
		<ul class="reviews_wr">
			@foreach( $reviews as $rev )
				<li class="clearfix">
					<div class="rev_img fleft">
						<img src="@if( $rev->image ) /uploads/reviews/{{ $rev->image }} @else /frontend/img/rev_def.png @endif" alt="{{ $rev->name }}">
					</div>
					<p>{{ $rev->body }}</p>
					<p class="rev_author">{{ $rev->name }} @if( $rev->age ) , {{ $rev->age }} @endif</p>
				</li>
			@endforeach
		</ul>
	@else
		<p>Отзывы отсутствуют</p>
	@endif



	<div class="make_review">
		@if( Session::has('message') )
			<p class="title">{{ Session::get('message') }}</p>
		@else
			<p class="title">Вы можете отправить отзыв заполнив форму: </p>

			@if( $errors->any() )
            	<p class="error">Вы ошибись при заполнении формы. Попробуйте еще раз</p>
            @endif

			<form method="POST" action="/reviews" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="form_group">
					<label for="name">Ваше имя *</label>
					<input type="text" name="name" required id="name" value="{!! Input::old('name') !!}">
				</div>
				<div class="form_group">
					<label for="age">Ваш возраст</label>
					<input type="text" name="age" id="age" value="{!! Input::old('age') !!}">
				</div>
				<div class="form_group">
					<label for="email">Ваш email *</label>
					<input type="email" name="email" required id="email" value="{!! Input::old('email') !!}">
				</div>
				<div class="form_group">
					<label for="body">Ваш комментарий *</label>
					<textarea name="body" required id="body">{!! Input::old('body') !!}</textarea>
				</div>
				<div class="form_group">
					<label for="image">Ваше изображение</label>
					<input type="file" name="image" id="image" value="{!! Input::old('image') !!}">
				</div>
				<p>Введите текст с картинки</p>
				<div class="form_group">
					<label>{!! captcha_img() !!}</label>
					<input type="text" name="captcha" required>
				</div>
				<div class="form_group">
					<input type="submit" value="Отправить">
				</div>
			</form>
		@endif
	</div>

@endsection