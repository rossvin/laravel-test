<div class="suggested">
	<div class="sug_sl">
		@foreach( $suggested_ac as $sa )
			<div class="slide">
				<p class="title">Рекомендуем купить комплект</p>
				<div class="current_prod">
					<a href="@if( $sa->type1 == 1 )/product/@elseif( $sa->type1 == 2 )/accessory/@elseif( $sa->type1 == 3 )/lens/@elseif( $sa->type1 == 4 )/len-facility/@endif{{ $sa->slug1 }}">
						<img src="@if( $img = unserialize($sa->img1)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/rev_def.png @endif" alt="{{ $sa->name1 }}">
					</a>
					<div class="suggested_name">
						{{ $sa->name1 }}
					</div>
					<div class="prices">
						@if($sa->discount1 != 0)
							<span class="old_price">
								@if( in_array($sa->type1, [1,2]) && $user->gl_discount != 0) 
									{{ $sa->price1 - $sa->price1 * $user->gl_discount/100 }}
								@else
									{{ $sa->price1 - $sa->price1 * $user->len_discount/100 }}
								@endif
								 грн
							</span>
						@endif
						@if( in_array($sa->type1, [1,2]) )
							<span class="@if($sa->discount1 == 0)perm_pr @else new_price @endif">{{ $sa->price1 - $sa->price1 * $sa->discount1/100 - $sa->price1 * $user->gl_discount/100 }} грн</span>
						@elseif( in_array($sa->type1, [3,4]) )
							<span class="@if($sa->discount1 == 0)perm_pr @else new_price @endif">{{ $sa->price1 - $sa->price1 * $sa->discount1/100 - $sa->price1 * $user->len_discount/100 }} грн</span>
						@endif
					</div>
				</div>
				<!-- current_prod end -->
				<div class="accessory_prod">
					<a href="@if( $sa->type2 == 1 )/product/@elseif( $sa->type2 == 2 )/accessory/@elseif( $sa->type2 == 3 )/lens/@elseif( $sa->type2 == 4 )/len-facility/@endif{{ $sa->slug2 }}">
						<img src="@if( $img = unserialize($sa->img2)[0] ) /uploads/products/md/{{ $img }} @else /frontend/img/rev_def.png @endif" alt="glas">
					</a>
					<div class="suggested_name">
						{{ $sa->name2 }}
					</div>
					<div class="prices">
						@if($sa->discount2 != 0)
							<span class="old_price">
								@if( in_array($sa->type1, [1,2]) && $user->gl_discount != 0) 
									{{ $sa->price2 - $sa->price2 * $user->gl_discount/100 }}
								@else
									{{ $sa->price2 - $sa->price2 * $user->len_discount/100 }}
								@endif
								 грн
							</span>
						@endif
						@if( in_array($sa->type2, [1,2]) )
							<span class="@if($sa->discount2 == 0)perm_pr @else new_price @endif">{{ $sa->price2 - $sa->price2 * $sa->discount2/100 - $sa->price2 * $user->gl_discount/100 }} грн</span>
						@elseif( in_array($sa->type2, [3,4]) )
							<span class="@if($sa->discount2 == 0)perm_pr @else new_price @endif">{{ $sa->price2 - $sa->price2 * $sa->discount2/100 - $sa->price2 * $user->len_discount/100 }} грн</span>
						@endif
					</div>
				</div>
				<!-- accessory_prod end -->
				<div class="total_price">
					<p>{{ $sa->price }} <span>грн</span></p>

					<form class="buyPackage">
						<input type="submit" data-kit-id="{{ $sa->id }}" value="Купить комплект">
					</form>
				</div>
				<!-- total price end -->
			</div>
			<!-- slide end -->
		@endforeach
	</div>
</div>
<!-- suggested end -->