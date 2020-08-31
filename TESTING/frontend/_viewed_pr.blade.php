@if( count($viewed_pr) )
	<div class="viewed">
		<p class="title">Вы смотрели</p>
		@foreach( $viewed_pr as $vp )
			<div class="viewed_item clearfix">
				<a class="viewed_img fleft" href="@if( $vp->type == 1 )/product/@elseif( $vp->type == 2 )/accessory/@elseif( $vp->type == 3 )/lens/@elseif( $vp->type == 4 )/len-facility/@endif{{ $vp->slug }}">
					<img src="/uploads/products/sm/{{ unserialize($vp->imgs)[0] }}" alt="{{ $vp->name }}">
				</a>
				<div class="viewed_descr fright">
					<a href="@if( $vp->type == 1 )/product/@elseif( $vp->type == 2 )/accessory/@elseif( $vp->type == 3 )/lens/@elseif( $vp->type == 4 )/len-facility/@endif{{ $vp->slug }}">{{ $vp->name }}</a>
					<span>{{ $vp->cat_name }}</span>
					<form class="viewedtocart" data-token="{{ csrf_token() }}">
						<input type="image" data-id="{{ $vp->id }}" data-product-type="{{$vp->type}}" data-product-size="@if( $vp->type == 4) {{ $vp->size }} @else 1 @endif" src="/frontend/img/icons/cart_act.png" alt="cart">
					</form>
				</div>
			</div>
		@endforeach
	</div>
	<!-- viewed end -->
@endif