@extends('frontend.layout')

@section('main')

	<h1 class="page_title">
		{!! $page->name !!}
	</h1>

	@if( count($histories) )
		<ul class="reviews_wr">
			@foreach( $histories as $hist )
				<li class="clearfix">
					<div class="rev_img fleft">
						<img src="@if( $hist->image ) /uploads/histories/{{ $hist->image }} @else /frontend/img/rev_def.png @endif" alt="{{ $hist->name }}">
					</div>
					<p>{{ $hist->body }}</p>
					<p class="rev_author">{{ $hist->name }} @if( $hist->age ) , {{ $hist->age }} @endif</p>
				</li>
			@endforeach
		</ul>
	@else
		<p>Истории клиентов отсутствуют</p>
	@endif

	<div class="make_review">
		@if( Session::has('message') )
			<p class="title">{{ Session::get('message') }}</p>
		@else
			<p class="title">Вы можете отправить историю заполнив форму: </p>

			@if( $errors->any() )
            	<p class="error">Вы ошибись при заполнении формы. Попробуйте еще раз</p>
            @endif

			<form method="POST" action="/histories" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="form_group">
					<label for="name">Ваше имя *</label>
					<input type="text" name="name" id="name" required>
				</div>
				<div class="form_group">
					<label for="body">Ваша история *</label>
					<textarea name="body" id="body" required></textarea>
				</div>
				<div class="form_group">
					<label for="image">Ваше изображение</label>
					<input type="file" name="image" id="image">
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