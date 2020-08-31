	@include('frontend._top_section')

	<div class="wrapper_1095">
		<div class="wrapper">

			<div class="page_wr clearfix">
				@include('frontend._text_page_breadcrumbs')
				<div class="page_content fleft"> 
					@yield('main')
				</div>
				<!-- page_content end -->

				<div class="page_right fright">
					<div class="diagnostics">
						<p class="title">Количество проведенных диагностик зрения.</p>
						@foreach( $int as $v )
							<span>{{ $v }}</span>
						@endforeach
						<div class="join_us">
							Присоединяйтесь к нам!
							<div class="arrow"></div>
						</div>
						<p class="descr">Запишитесь на прием к офтальмологу и пройдите комплексную диагностику зрения.</p>
						<form id="feedback" action="/feedback">
							{!! csrf_field() !!}
							<div class="form_group">
								<label class="subscr_name"></label><input type="text" name="name" required placeholder="Имя">
							</div>
							<div class="form_group">
								<label class="subscr_phone"></label><input type="text" name="phone" required placeholder="Телефон">
							</div>
							<div class="form_group">
								<label class="subscr_email"></label><input type="email" name="email" required placeholder="Email">
							</div>
							<div class="form_group">
								<label class="date"></label><input type="text" name="date" required placeholder="Дата" id="datetimepicker">
							</div>
							<div class="form_group">
								<select name="place">
									@foreach( $salon as $s )
										<option value="{{ $s->name }}">{{ $s->name }}</option>
									@endforeach
								</select>
								<select name="theme">
									@foreach( $reception_themes as $rt )
										<option value="{{ $rt->name }}">{{ $rt->name }}</option>
									@endforeach
								</select>
							</div>
							<textarea name="comment" placeholder="Комментарий"></textarea>
							<input type="submit" value="Записаться">
						</form>
						<a href="#" class="sign_up">Записаться</a>
						<a href="#" class="sign_up2"></a>
						<a href="#" class="hide_form"></a>
					</div>
					<!-- diagnostics end -->

					@yield('accessories')

					<div class="delivery">
						<a href="/dostavka-kontaktnyh-linz">Служба доставки контактных линз</a>
						<p>{{ $settings[2]->value }}</p>
						<p>{{ $settings[3]->value }}</p>
						<p class="worktime">{{ $settings[1]->value }}</p>
						<p class="info">Доставка в будние дни</p>
						<img src="/frontend/img/icons/delivery.png" alt="del">
					</div>
					<!-- delivery end -->

					@yield('master_services')

					@if( !in_array( Request::segment(1), ['news', 'useful-info', 'product', 'accessory'] ) )
						@include('frontend._aside_news')
					@endif

					@yield('useful_info')

					@if( !in_array( Request::segment(1), ['product', 'accessory'] ))
						<div class="offers_slider">
							@foreach( $offers as $off )
								<div class="slide">
									<img src="@if( $off->image ) /uploads/offers/{{ $off->image }} @else /frontend/img/offers_def.png @endif" alt="{{ $off->name }}">
									<p>{{ $off->name }}</p>
									<a href="/offers/{{ $off->slug }}" class="details">Подробнее</a>
								</div>
							@endforeach
						</div>
						<!-- offers slider -->
					@endif

					@yield('viewed')

				</div>
				<!-- prod right end -->
			</div>
			<!-- page_wr end -->
		</div>
		<!-- wrapper end -->
	</div>
	<!-- wrapper_1095 end -->
	@yield('users_info')

	@yield('news_subscription')
</div>
<!-- global wrapper end -->



@include('frontend._footer')

<script src="/frontend/js/app.min.js"></script>

<!-- <script src="/frontend/js/jquery-1.11.3.min.js"></script>
<script src="/frontend/js/jquery.bxslider.min.js"></script>
<script src="/frontend/js/jquery.datetimepicker.js"></script> -->

<script src="/frontend/js/jscrollpane.js"></script>

<script>
	$('.raz').on('click', function(){
    var $that = $(this),
        nc = $that.next('.del').length,
        block = nc ? $that.next('.del') : $that.parent('.del');
    block.slideToggle(function(){
        $('.raz',block).add(block.prev('.raz'))
        .text(block.is(':visible') ? 'Скрыть' : 'Показать Выгодные предложения');
    });  
});
	$('#datetimepicker').datetimepicker({
		lang: 'ru',
		step: 5
	});

	$('.sign_up, .sign_up2').click(function(){
		$('.sign_up, .sign_up2').hide();

		$('#feedback').show(100);
		$('.hide_form').css('display', 'block');
		return false;
	});

	$('.hide_form').click(function(){
		$('#feedback').hide(100);
		$(this).hide();
		$('.sign_up').show();
		$('.sign_up2').show();
		return false;
	});


	$('#feedback').submit(function() {
		$.post( "/feedback",  $("#feedback").serialize() )
		.done( function(data) { 
			$('.descr').html("<small>Вы успешно записались на прием. С вами свяжутся в ближайшее время.</small>");
			$('#feedback').hide(100);
			$('.hide_form').hide();
			$('.sign_up').show();
			$('.sign_up2').show();
		});

		return false;
	});

	$(function(){
		$('.aside_news').jScrollPane();
	});

	$('.offers_slider').bxSlider({
		pager: false,
		controls: true,
		auto: true
	});



   $('a[href="#moveup"]').click(function () {

		var elementClick = $(this).attr("href")
        var destination = $(elementClick).offset().top;
        jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 1000);
        return false;
   });

   $(window).scroll(function(){
   		if( window.scrollY > 500 )
   			$('.to_top').fadeIn(300);
   		else
   			$('.to_top').fadeOut(300);
   })

</script>

@section('scripts')
@show

</body>
</html>