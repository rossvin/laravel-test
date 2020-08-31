<div class="news_wrapper">
	<div class="clearfix">
		<div class="title fleft">новости</div>
		<a href="/news" class="fright all_news">Все новости</a>
	</div>
	<div class="aside_news">
		@foreach( $aside_news as $an )
			<div class="n_item">
				<p class="date">@if($an->published_at != ''){{ date('d-m-Y', $an->published_at ) }}@else{{ $an->created_at->format('d-m-Y') }}@endif</p>
				<p class="n_title">{{ $an->name }}</p>
				<a href="/news/{{ $an->slug }}" class="details">Подробнее</a>
			</div>
		@endforeach
	</div>
	<!-- news_wrapper end -->

	<div class="news_subscribe">
		<p class="title">Подписаться на новости</p>
		<form method="POST" action="/subscribe">
			{!! csrf_field() !!}
			<div class="form_group">
				<label for="name"></label>
				<input type="text" name="name" id="name" placeholder="Введите Ваше Имя">
			</div>
			<div class="form_group">
				<label for="email" class="subscr_email"></label>
				<input type="email" name="email" id="email" placeholder="Введите Вам email">
			</div>
			<input type="submit" value="Подписаться">
		</form>
		@if( Session::has('message') )
			<p class="subscr_message">{{ Session::get('message') }}</p>
		@endif
		@if( $errors->any() )
			<p>Вы ошиблись при заполнении формы. Заполните все поля и повторите попытку</p>
		@endif
	</div>
</div>
<!-- news wrapper end -->