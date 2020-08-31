@extends('frontend.layout_main')

@section('main')

	<div class="wrapper_1095">
		<div class="wrapper">

			@include('frontend._offers_slider')

			<div class="brands">
				<div class="brands_slider">
					@foreach( $brands as $br )
						<a href="/brand/{{ $br->slug }}" class="slide">
							<img src="/uploads/brands/{{ $br->image }}" alt="{{ $br->name }}">
						</a>
					@endforeach
				</div>
				<!-- brands slider end -->
			</div>
			<!-- brands end -->

			{{--<div class="breadcrumbs clearfix">--}}
{{--				<a href="{{ URL::previous() }}" class="back fleft">&lt; Назад</a>--}}
				{{--<ul class="fleft">--}}
					{{--<li><a href="/">Главная</a>&ensp;/&ensp;--}}
					{{--<li>{{ $page->name }}--}}
				{{--</ul>--}}
			{{--</div>--}}
			@include('frontend._text_page_breadcrumbs')
			<!-- breadcrumbs end -->

			<div class="catalog clearfix">
				<aside class="fleft">
					<p class="title">{{ $page->name }}</p>

					@if( Input::has('filter') || Input::has('brand') )
						<div class="selected_cat">
							<p class="heading">ВЫБРАННЫЕ КАТЕГОРИИ</p>
							<ul>
								@if(Input::has('brand'))
									@foreach( $filter_brands as $br )
										@if( in_array($br->id, Input::get('brand')) )
											<li class="clearfix">
												<span class="fleft">{{ $br->name }}</span>
												<a href="#" data-type="1" data-id="{{ $br->id }}" class="fright">удалить</a>
											</li>
										@endif
									@endforeach
								@endif
								@foreach( $features as $f )
									@if( isset( Input::get('filter')[$f->id] ) )
										@if( count( $f->options ) )
											@foreach( $f->options as $key => $o )
												@if( isset( Input::get('filter')[$f->id] )  && in_array( $o->value, Input::get('filter')[$f->id] ) )
													<li class="clearfix">
														<span class="fleft">{{ $o->value }}</span>
														<a href="#" data-id="{{ $f->id.$o->id }}" class="fright">удалить</a>
													</li>
												@endif
											@endforeach
										@elseif( count( $f->len_options ) )
											@foreach( $f->len_options as $key => $o )
												@if( isset( Input::get('filter')[$f->id] )  && in_array( $o->value, Input::get('filter')[$f->id] ) )
													<li class="clearfix">
														<span class="fleft">{{ $o->value }}</span>
														<a href="#" data-id="{{ $f->id.$o->id }}" class="fright">удалить</a>
													</li>
												@endif
											@endforeach
										@endif
										
									@endif
								@endforeach
							</ul>
						</div>
					@endif
					<!-- selected cat end -->

					@if( count($articles) )
						<div class="additional_info">
							<p class="heading">Дополнительная информация</p>
							<ul>
								@foreach( $articles as $art )
									<li><a href="/articles/{{ $art->slug }}">{{ $art->name }}</a></li>
								@endforeach
							</ul>
						</div>
					@endif
					<!-- additional_info end -->

					<form>
						<div class="filter">
							<p class="heading">Критерии выбора</p>

							<div class="filter_group">
								<div class="block-filter-group">
									<p>Выберите бренд</p>
									@foreach( $filter_brands as $br )
										<label><input type="checkbox" id="{{ $br->id }}" name="brand[]" value="{{ $br->id }}" onchange="this.form.submit()" @if( Input::has('brand') && in_array($br->id, Input::get('brand')) ) checked  @endif>{{ $br->name }} ({{$br->count_pr}})</label>
									@endforeach
								</div>
							</div>

							@foreach( $features as $f )
								@if( count( $f->options ) )
									<div class="filter_group">
										<div class="block-filter-group">
											<p>{{ $f->name }}</p>
											@foreach( $f->options as $key => $o )
												<label class="lab{{ $key }}">
													<input @if( isset( Input::get('filter')[$f->id] )  && in_array( $o->value, Input::get('filter')[$f->id] ) ) checked @endif onchange="this.form.submit()" name="filter[{{ $f->id }}][]" type="checkbox" value="{{{ $o->value }}}" id="{{ $f->id.$o->id }}">
													@if( $f->id == 5)
														<img src="/frontend/img/icons/
														@if( $o->value == 'капли')1
														@elseif( $o->value == 'wayfarer')2
														@elseif( $o->value == 'круглые')3
														@elseif( $o->value == 'кошачий глаз')4
														@elseif( $o->value == 'маска')5
														@elseif( $o->value == 'прямоугольные')6
														@elseif( $o->value == 'квадратные')7
														@elseif( $o->value == 'бабочка')8
														@else
														2
														@endif
														.png" alt="$o->value">
													@endif
													{{ $o->value }} ({{ $o->prod_count }})
												</label>
											@endforeach
										</div>
									</div>

								@elseif( count( $f->len_options ) )
									<div class="filter_group">
										<p>{{ $f->name }}</p>
										@foreach( $f->len_options as $key => $o )
											<label class="lab{{ $key }}">
												<input @if( isset( Input::get('filter')[$f->id] )  && in_array( $o->value, Input::get('filter')[$f->id] ) ) checked @endif onchange="this.form.submit()" name="filter[{{ $f->id }}][]" type="checkbox" value="{{{ $o->value }}}" id="{{ $f->id.$o->id }}">
												{{ $o->value }} ({{ $o->prod_count }})
											</label>
										@endforeach
									</div>
								@endif
							@endforeach

							<div class="filter_group">
								<p>Стоимость:</p>
								<input type="text" id="cost" name="price" onchange="this.form.submit()">
							</div>
						</div>
						<!-- filter end -->
						<div class="accessory">
							@if( $page->id == 5 )
								<p>Подберите средства по уходу за контактными линзами</p>
							@elseif( $page->id == 6 )
								<p>Подберите сопутствующий товар</p>
							@else
								<p>Подберите аксессуар к очкам:</p>
							@endif
							@foreach( $accessories as $ac )
								<a href="/accessories/{{ $ac->slug }}">{{ $ac->name }}</a>
							@endforeach
						</div>
					</form>
					<!-- form end -->

					@include('frontend._aside_news')
				</aside>
				<!-- aside end -->
				<div class="products_wr fright">

					<p class="count_products">Найдено {{ $products_total }} {{ Lang::choice('товар|товара|товаров', $products_total, array(), 'ru') }}</p>

					<div class="sorting clearfix">
						<form class="fleft">
							<label for="sort_by">Сортировать по: </label>
							<select name="sort_by" id="sort_by">
								@foreach( $sort_by_var as $k => $sb )
									<option @if( Session::get('sort_by') == $k ) selected="true" @endif value="{{ $k }}">{{ $sb }}</option>
								@endforeach
							</select>
							<label for="prod_per_page">Товаров на странице:</label>
							<select name="per_page" id="prod_per_page">
								@foreach( $per_page_opt as $pp )
									<option @if( Session::get('per_page') == $pp ) selected="true" @endif value="{{ $pp }}">{{ $pp }}</option>
								@endforeach
							</select>
						</form>

						@include('frontend._pagination', ['paginator' => $products->appends(['sort_by'=> Session::get('sort_by'), 'per_page' => Session::get('per_page')])])
						<!-- pagination end -->
					</div>
					<!-- sorting end -->

					@if( count($products) )
						<ul class="products clearfix">
							@foreach( $products as $pr )
								<li>
									<div class="prod_item">
										<a href="@if($page->id == 5)/lens/@elseif($page->id == 6)/len-facility/@else/product/@endif{{ $pr->slug }}" class="main_link">
											<div class="img">
												<img src="@if( isset(unserialize($pr->imgs)[0]) ) /uploads/products/md/{{ unserialize($pr->imgs)[0] }} @else /frontend/img/rev_def.png @endif" alt="{{ $pr->name }}">
											</div>
											<div class="pr_name">
												<span>{{ $pr->name }}</span>
											</div>
										</a>
										<div class="price">
											@if( ($pr->category_id == 5 && $pr->only_packages == 0 || $pr->category_id != 5) && $pr->discount != 0 )
												<span class="old_pr">{{ $pr->price }} грн</span>
											@elseif( $pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount != 0)
												<span class="old_pr">{{ $pr->package_price }} грн</span>
											@endif
											<span class="@if( ($pr->category_id != 5 && $pr->discount==0) || ($pr->category_id == 5 && $pr->only_packages == 1 && $pr->package_discount==0)  || ($pr->category_id == 5 && $pr->only_packages == 0 && $pr->discount==0))perm_pr @else new_pr @endif">{{ $pr->price_r }} грн</span>
										</div>
										<div class="clearfix">
											<form class="fleft tocart">
												<input type="submit" data-id="{{ $pr->id }}" data-product-type="{{$pr->type}}" data-quantity-type="@if( $pr->type == 3 && $pr->only_packages == 1) {{$pr->in_package}} @else 1 @endif"  data-product-size="@if( $pr->type == 4) {{ $pr->size }} @else 1 @endif" value="Купить">
											</form>
											<form class="tocompare">
												<input type="submit" value="" data-id="{{ $pr->id }}" data-type="1">
											</form>
										</div>
										@if( $pr->share == 1 )
											<div class="sale">sale</div>
										@elseif( $pr->newest == 1 )
											<div class="new">new</div>
										@elseif( $pr->hit == 1 )
											<div class="hit">хит</div>
										@endif

										@if( $pr->parameters != '' )
											<div class="prod_details">
												{!! $pr->parameters !!}
											</div>
										@endif
									</div>
								</li>
							@endforeach
						</ul>

						<div class="post_products_pagination">
							@include('frontend._pagination', ['paginator' => $products->appends(['sort_by'=> Session::get('sort_by'), 'per_page' => Session::get('per_page')])])
						</div>
					@else
						<p class="no_products">Товары отсутствуют</p>
					@endif
					<div class="cat_description">
						@if(  app('request')->input('page') == 1 || (Request::is('categories/*') && !app('request')->input('page')))
							{!! $page->body !!}
						@endif
					</div>
				</div>
				<!-- products_wr end -->
			</div>
			<!-- catalog end -->
		</div>
		<!-- wrapper end -->
	</div>
	<!-- wrapper_1095 end -->

	@include('frontend._notification')

@endsection

@section('styles')
	<link href="/frontend/css/jquery.formstyler.css" rel="stylesheet">
	<link href="/frontend/css/ion.rangeSlider.css" rel="stylesheet">
	<link href="/frontend/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
@endsection

@section('scripts')
	<script src="/frontend/js/jquery.formstyler.min.js"></script>
	<script src="/frontend/js/ion.rangeSlider.min.js"></script>
	<!-- the jScrollPane script -->
	<script src="/frontend/js/jscrollpane.js"></script>

	<script>
		$('.brands_slider').bxSlider({
			slideWidth: 120,
			minSlides: 6,
			maxSlides: 6,
			slideMargin: 20,
			pager: false,
			auto: true,
			speed: 1000
		});

		 $("input[type='checkbox']").styler();

		 $("#cost").ionRangeSlider({
		 	type: "double",
		 	hide_min_max: true,
		    min: 0,
		    max: "{{ $price_range['max'] }}",
		    from: "{{ $limits[0] }}",
		    to: "{{ $limits[1] }}",
		 });

		// удаление из фильтрации 
		$('.selected_cat a').click(function(){

			$(".filter_group input[id='"+ $(this).data('id') +"']").removeAttr('checked').closest('form').submit();
			return false;
		});

		// отправка формы при изменении значения
		$('.sorting select').change(function(){
			$(this).closest('form').submit();
		})


		// Добавление к сравнению
		$('.tocompare input').click(function(){

			$.post('/compare', { _token: '{{ csrf_token() }}', id: $(this).data('id'), type: $(this).data('type') }, function(data){
				console.log(data);
			 	$('.overlay').show();
			 	$('.addedToCompare').fadeIn(200);
			});
			return false;
		});

		// Добавление в корзину 
		$('.tocart input').click(function(){


            if(typeof yaCounter36382700 != "undefined") {
                yaCounter36382700.reachGoal('addtobacket');
            }

ga('send', 'event', 'add_card', 'send');
			var slug = '/tocart';
			var data = { _token: '{{ csrf_token() }}', product_id: $(this).data('id'), prod_type: $(this).data('productType'), prod_size: $(this).data('productSize') };

			var product_type = Number( $(this).data('productType') );
			if( product_type == 4 )
				slug = '/len_facility_tocart';
			else if( product_type == 3){
				data.quantity = 1;
				data.quantity_type = Number( $(this).data('quantityType') );
				slug = '/lentocart';
			}

			$.post( slug, data,
			 function(data){
			 	$('.overlay').show();
			 	$('.addedToCart').fadeIn(200);
			 	$('.cart_quant').text(data.quantity + " товаров");
			 	$('.cart_pr').text(data.total_price + " Грн");
			});

			return false;
		});

		// уведомление о добавлении в корзину
		$('.closeAddToCart').click(function(){
			$('.overlay').hide();
			$('.addedToCart').fadeOut(200);
			$('.addedToCompare').fadeOut(200);
			return false;
		})


		$(function(){
			$('.scroll-pane').jScrollPane();
			$('.aside_news').jScrollPane();
			$('.block-filter-group').jScrollPane({
				verticalDragMinHeight: 43,
				verticalDragMaxHeight: 43,
				horizontalDragMinWidth: 20,
				horizontalDragMaxWidth: 20,
			});
		});

	</script>
@endsection