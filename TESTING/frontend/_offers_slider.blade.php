<div class="raz">Показать Выгодные предложения</div>
<div class="del">
<div class="offers">
	<div class="title">Выгодные предложения</div>
	<div class="offers_slider">
		@foreach( $offers as $off )
			<div class="slide">
				<img src="@if( $off->image ) /uploads/offers/{{ $off->image }} @else /frontend/img/offers_def.png @endif" alt="{{ $off->name }}">
				<p>{{ $off->name }}</p>
				<a href="/offers/{{ $off->slug }}" class="details">Подробнее</a>
			</div>
		@endforeach
	</div>
	<!-- offers slider end -->
</div>
</div>

<!-- offers end -->