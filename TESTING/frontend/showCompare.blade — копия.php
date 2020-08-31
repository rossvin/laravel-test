@extends('frontend.layout_main')

@section('main')
<div class="wrapper_1095">
	<div class="wrapper cart_wr">
		<p class="page_title">{{ $page->name }}</p>

		@if( isset($products) && count( $products ) == 2 )
		<table class="compare">
			<tr>
				<td>Характеристики</td>
				@foreach( $products as $p )
					<td class="heading">
						<img src="@if( $img = unserialize($p->imgs)[0] )/uploads/products/sm/{{ $img }} @else /frontend/img/def_sm.png @endif" alt="{{ $p->name }}">
						<span>{{ $p->name }}</span>
						<form action="remove_from_compare" method="POST">
							{!! csrf_field() !!}
							<input type="hidden" name="product_id" value="{{ $p->id }}">
							<input type="hidden" name="type" value="1">
							<input type="image" src="/frontend/img/icons/close_big.png" alt="close">
						</form>
					</td>
				@endforeach
			</tr>
			<tr>
				<td>Категория</td>
				<td>{{ $products[0]->cat_name }}</td>
				<td>{{ $products[1]->cat_name }}</td>
			</tr>
			<tr>
				<td>Цена</td>
				<td>{{ $products[0]->price }} грн.</td>
				<td>{{ $products[1]->price }} грн.</td>
			</tr>
			@foreach( $features as $f )
				@if( count($f->options) )
					<tr>
						<td>{{ $f->name }}</td>

						@if( count($f->options) == 2 )
							@foreach( $f->options as $k => $o )
								<td>{{ $o->value }}</td>
							@endforeach
						@else
							@if( $f->options[0]->product_id == $products[0]->id )
								<td>{{$f->options[0]->value}}</td>
							@else
								<td> - </td>
							@endif

							@if( $f->options[0]->product_id != $products[0]->id )
								<td>{{$f->options[0]->value}}</td>
							@else
								<td> - </td>
							@endif
						@endif
					</tr>
				@endif
			@endforeach
		</table>
		@elseif( isset($lens) && count( $lens ) == 2 )
		<table class="compare">
			<tr>
				<td>Характеристики</td>
				@foreach( $lens as $len )
					<td class="heading">
						<img src="@if( $img = unserialize($len->imgs)[0] )/uploads/lens/sm/{{ $img }} @else /frontend/img/def_sm.png @endif" alt="{{ $len->name }}">
						<span>{{ $len->name }}</span>
						<form action="remove_from_compare" method="POST">
							{!! csrf_field() !!}
							<input type="hidden" name="product_id" value="{{ $len->id }}">
							<input type="hidden" name="type" value="3">
							<input type="image" src="/frontend/img/icons/close_big.png" alt="close">
						</form>
					</td>
				@endforeach
			</tr>
			@foreach( $len_features as $f )
				@if( count($f->len_options) )
					<tr>
						<td>{{ $f->name }}</td>

						@if( count($f->len_options) == 2 )
							@foreach( $f->len_options as $k => $o )
								<td>{{ $o->value }}</td>
							@endforeach
						@else
							@if( $f->len_options[0]->product_id == $lens[0]->id )
								<td>{{$f->len_options[0]->value}}</td>
							@else
								<td> - </td>
							@endif

							@if( $f->len_options[0]->product_id != $lens[0]->id )
								<td>{{$f->len_options[0]->value}}</td>
							@else
								<td> - </td>
							@endif
						@endif
					</tr>
				@endif
			@endforeach
		</table>
		@else
			<p>Вы добавили недостаточно товаров для сравнения</p>
		@endif
	</div>
	<!-- wrapper end -->
</div>
<!-- wrapper 1095 end -->
@endsection


@section('scripts')

<script>

</script>

@endsection