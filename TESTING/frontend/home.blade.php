@extends('frontend.layout_main')

@section('main')

<div class="wrapper">

		<div class="post_menu clearfix">
			<div class="slider fleft">
				<ul class="bxslider">
					@foreach( $main_slides as $ms )
						<li><a href="{{ $ms->link }}"><img src="/uploads/main_slides/{{ $ms->image }}" alt="slider"></a>
					@endforeach
				</ul>
			</div>
			<!-- slider end -->
			<div class="post_menu_right fright">
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
					<a href="#" class="sign_up" onclick="yaCounter36382700.reachGoal('zapisnapriem');ga('send', 'event', 'запись', 'прием')">Записаться</a>
					<a href="#" class="sign_up2"></a>
					<a href="#" class="hide_form"></a>
				</div>
				<!-- diagnostics end -->
				<div class="delivery">
					<a href="/dostavka-kontaktnyh-linz">Служба доставки контактных линз</a>
					<p>{{ $settings[2]->value }}</p>
					<p>{{ $settings[3]->value }}</p>
					<p class="worktime">{{ $settings[1]->value }}</p>
					<p class="info">Доставка в будние дни</p>
					<img src="/frontend/img/icons/delivery.png" alt="del">
				</div>
				<!-- delivery end -->
			</div>
		</div>
		<!-- post_menu end -->

		<div class="comments_section">
			<ul class="clearfix">
				<li>
					<div class="comments">
						<p class="title">Что говорят об оптике TREVISO?</p>
						<div class="image">
							<img src="@if( $last_review->image ) /uploads/reviews/{{ $last_review->image }} @else /frontend/img/rev_def.png @endif" alt="dsfs">
						</div>
						<p class="com_text">{{ $last_review->body }}</p>
						<p class="com_author">{{ $last_review->name }} @if( $last_review->age ) , {{ $last_review->age }} @endif</p>
						<a href="/reviews">Читать еще отзывы</a>
					</div>
				</li>
				<li class="solution">
					<p class="title">Оптимальные решения Ваших проблем!</p>
					<img src="@if( $article->image )/uploads/articles/{{ $article->image }} @else /frontend/img/news_def.png @endif" alt="{{ $article->name }}">
					<div class="solution_descr">
						<p class="heading">{{ $article->name }}</p>
						<p class="glasses">{{ $article->descr }}</p>
						<a href="/articles">Еще</a>
					</div>
				</li>
				<li class="history">
					<a href="/histories">
						<span>Истории клиентов «Видеть мир другими глазами»</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- comments_section end -->

		@include('frontend._home_slider')

		<div class="news">
			<div class="title">Наши новости</div>
			<a href="/news" class="all_news">Все новости</a>

			@foreach( $last_news as $ln )
				<div class="news_item clearfix">
					<div class="n_image fleft">
						<a href="/news/{{ $ln->slug }}">
							<img src="@if( $ln->image ) /uploads/news/thumbs/{{ $ln->image }} @else /frontend/img/news_def.png @endif" alt="{{ $ln->name }}">
						</a>
						<div class="networks">
							<script type="text/javascript">(function() {
							  if (window.pluso)if (typeof window.pluso.start == "function") return;
							  if (window.ifpluso==undefined) { window.ifpluso = 1;
							    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
							    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
							    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
							    var h=d[g]('body')[0];
							    h.appendChild(s);
							  }})();</script>
							<div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook" data-url="http://{{Request::getHttpHost()}}/news/{{ $ln->slug }}" data-title="{{ $ln->name }}" data-description="{{ $ln->descr }}"></div>
						</div>
					</div>

					<div class="n_descr fright">
						<a href="/news/{{ $ln->slug }}">{{ $ln->name }}</a>
						<p class="date">@if($ln->published_at != ''){{ date('d-m-Y', $ln->published_at) }}@else{{ $ln->created_at->format('d-m-Y') }}@endif</p>
						{!! $ln->descr !!}
					</div>
				</div>
			@endforeach
		</div>
		<!-- news end -->
	</div>
	<!-- wrapper end -->

	@include('frontend._news_subscription')

	<div class="wrapper">
		<div class="cont_top_line"></div>
		<div class="about">
			<div class="m_content clearfix">
				{!! $page->body !!}
			</div>
			<!-- content end -->
			<div class="cont_bottom_line"></div>
			<div class="advantages clearfix">{!! $settings[11]->value !!}</div>
			<!-- advantages end -->
			<div class="services">
				<ul>
					<li><a href="/categories/zapis-na-priem-k-oftalmologu">
							<span>1 <br>шаг</span>
							<p>Запись на прием к офтальмологу</p>
						</a>
					<li><a href="/categories/diagnostika-zreniya">
							<span>2 <br>шаг</span>
							<p>Диагностика зрения</p>
						</a>
					<li><a href="/categories/korrektsiya-zreniya">
							<span>3 <br>шаг</span>
							<p>Выбор очков и контактных линз</p>
						</a>
					<li><a href="/categories/izgotovlenie">
							<span>4 <br>шаг</span>
							<p>Изготовление очков</p>
						</a>
					<li><a href="/garantijnoe-obsluzhivanie">
							<span>5 <br>шаг</span>
							<p>Готовые очки и гарантия</p>
						</a>
				</ul>
			</div>
		</div>
		<!-- about end -->
		<div class="about_bottom_line"></div>
	</div>
	<!-- wrapper end -->

	<div class="useful_info">
		<div class="wrapper">
			<p class="heading">Полезная информация в рубриках</p>
			<ul>
				@foreach( $useful_info as $ui )
					<li>
						<a href="/useful-info/{{ $ui->slug }}">
							<img src="/uploads/usefulInfo/{{ $ui->image }}" alt="{{ $ui->name }}">
							<span>{{ $ui->name }}</span>
						</a>
				@endforeach
			</ul>
		</div>
	</div>

	<!-- useful_info end -->

@endsection

@section('scripts')

<script>
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
</script>
@endsection