@extends('frontend.layout_main')

@section('main')

<div class="wrapper_1095">
	<div class="wrapper products_wr">
		<div class="search_results">
			@if( $quantity != 0 )
				<p class="title">По вашему запросу "{!! $search !!}" найденно {{ $quantity }} {{ Lang::choice('товар|товара|товаров', $quantity , array(), 'ru') }}</p>
				<ul class="products clearfix">
					@foreach( $products as $pr )
						<li>
							<div class="prod_item">
								<a href="@if( $pr->type == 1 )/product/@elseif( $pr->type == 2 )/accessory/@elseif( $pr->type == 3 )/lens/@elseif( $pr->type == 4 )/len-facility/@endif{{ $pr->slug }}" class="main_link">
									<div class="img">
										<img src="@if( $img = unserialize($pr->imgs)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/rev_def.png @endif" alt="{{ $pr->name }}">
									</div>
									<div class="pr_name">
										<span>{{ $pr->name }}</span>
									</div>
								</a>
								<div class="price">
									@if( $pr->category_id == 5 && $pr->only_packages == 0 || $pr->category_id != 5 && $pr->discount != 0 )
										<span class="old_pr">{{ $pr->price }} грн</span>
									@elseif( $pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount != 0)
										<span class="old_pr">{{ $pr->package_price }} грн</span>
									@endif
									<span class="@if( ($pr->category_id != 5 && $pr->discount==0) || ($pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount==0))perm_pr @else new_pr @endif">{{ $pr->price_r }} грн</span>
								</div>
								@if( $pr->share == 1 ) <div class="sale">sale</div> @endif
								@if( $pr->newest == 1 ) <div class="new">new</div> @endif
								@if( $pr->hit == 1 ) <div class="hit">хит</div> @endif
							</div>
						</li>
					@endforeach
				</ul>
			@else
				<p class="title">По вашему запросу "{!! $search !!}" товаров не найдено. Попробуйте поискать что-то другое</p>
			@endif
		</div>
		@include('frontend._notification')
	</div>
</div>
@endsection