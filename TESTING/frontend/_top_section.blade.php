<?php
if($_SERVER ['REQUEST_URI'] == '/index.htm'):
header('location: http://treviso.ua/',true,301);
endif;
if($_SERVER ['REQUEST_URI'] == '/index.html'):
header('location: http://treviso.ua/',true,301);
endif;
if($_SERVER ['REQUEST_URI'] == '/index.php'):
header('location: http://treviso.ua/',true,301);
endif;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
<?
if(isset($page->price)){
	$mtitle = $page->cat_name.' '.$page->name. ' купить в Украине | Treviso';
	$mdesc = $page->cat_name.' '.$page->name. ' описание, фото, цена. Чтобы заказать '.$page->cat_name.' '.$page->name.'  с доставкой по всей Украине, заходите на наш сайт или звоните по телефонам: +38 (050) 504-60-10, +38 (067) 271-42-19';
}
?>
<?php if ($_SERVER['REQUEST_URI'] == "/") : ?>
<title>Очки в Херсоне: купить очки для зрения в Николаеве недорого | Сеть салонов оптики Treviso</title>

<?php elseif ($_SERVER['REQUEST_URI'] == "/useful-info/kontaktnaya-korrektsiya/tsvetnye-kontaktnye-linzy-v-hersone-kupit-dlya-bystroj-smeny-imidzha") : ?>
<title>Цветные линзы в Херсоне и Николаеве – купить цветные линзы в Николаеве | Treviso</title>

<?php elseif ($_SERVER['REQUEST_URI'] == "/activities") : ?>
<title>Основные направления деятельности | Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/personal") : ?>
<title>Наши сотрудники | Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/dostavka-kontaktnyh-linz") : ?>
<title>Доставка контактных линз | Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/delivery") : ?>
<title>Оплата и доставка | Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/reviews") : ?>
<title>Отзывы клиентов центра Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/articles") : ?>
<title>Статьи – полезная информация от Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/herson") : ?>
<title>Салоны Treviso в Херсоне</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/golaya-pristan") : ?>
<title>Салон Treviso в г. Голая Пристань</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/skadovsk") : ?>
<title>Салон Treviso в Скадовске</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/oleshki-tsyurupinsk") : ?>
<title>Салон Treviso в Олешках (Цюрупинске)</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/histories") : ?>
<title>Истории наших клиентов | Treviso</title>
<?php elseif ($_SERVER['REQUEST_URI'] == "/purchase-returns") : ?>
<title>Условия возврата товара | Treviso</title>
<?php elseif (in_array( Request::segment(1), ['useful-info'] ) ) : ?>
<title>Полезная информация - {!! $page->name !!} | Treviso</title>
<?php elseif (in_array( Request::segment(1), ['dictionary'] ) ) : ?>
<title>Оптический словарь терминов – {!! $page->name !!}</title>
<?php elseif (in_array( Request::segment(1), ['news'] ) ) : ?>
<title>{!! $page->name !!} - новости сети Treviso</title>
<?php elseif (isset($page->price)) : ?>
<title><?php echo $mtitle;  ?></title>
<? else : ?>
	<title>{{{ $page->meta_title }}} @if( isset( $site_offline ) && $site_offline == 1 )OFFLINE @endif</title>
<?php endif; ?>
	<meta name="keywords" content="{{{ $page->meta_keywords }}}">

<?php if ($_SERVER['REQUEST_URI'] == "/useful-info/kontaktnaya-korrektsiya/tsvetnye-kontaktnye-linzy-v-hersone-kupit-dlya-bystroj-smeny-imidzha") : ?>
	<meta name="description" content="Цветные линзы в Херсоне и Николаеве в широком ассортименте предлагает Treviso: большой выбор оттенков, высокое качество, абсолютно безопасно для глаз. Хотите купить цветные линзы в Николаеве или Херсоне, звоните прямо сейчас: (050) 504-60-10">

<?php elseif (in_array( Request::segment(1), ['useful-info'] ) ) : ?>
	<meta name="description" content="Интересная и полезная информация от Treviso: {!! $page->name !!}. Читайте подробнее на нашем сайте.">
<?php elseif (in_array( Request::segment(1), ['news'] ) ) : ?>
	<meta name="description" content="Предлагаем Вашему вниманию актуальные новости сети Treviso: {!! $page->name !!}">
<?php elseif (isset($page->price)) : ?>
	<meta name="description" content="<?php echo $mdesc; ?>">
<?php elseif ($_SERVER['REQUEST_URI'] == "/dostavka-kontaktnyh-linz") : ?>
	<meta name="description" content="Предлагаем ознакомиться со способами доставки контактных линз. Во время оформления заказа просто выберите удобный для Вас способ доставки: Новая Почта, Гюнсел, Автолюкс. Также доступен самовывоз. ">
	<?php elseif ($_SERVER['REQUEST_URI'] == "/reviews") : ?>
		<meta name="description" content="Предлагаем ознакомиться с объективными отзывами наших клиентов об услугах и продукции сети Treviso. Также Вы можете оставить свой отзыв, воспользовавшись формой обратной связи. Вы делаете нас лучше!">
		<?php elseif ($_SERVER['REQUEST_URI'] == "/articles") : ?>
				<meta name="description" content="Предлагаем ознакомиться с полезной и интересной информацией в разделе статей от профессионалов Treviso. Читайте на сайте.">
	<?php elseif ($_SERVER['REQUEST_URI'] == "/delivery") : ?>
	<meta name="description" content="Предлагаем ознакомиться с условиями оплаты и доставки товара, заказанного у нас. У Вас есть возможность оплатить стоимость покупки путем перечисления на карточные счета или наложенным платежом, а также выбрать удобный способ доставки.">
<?php elseif (in_array( Request::segment(1), ['dictionary'] ) ) : ?>
	<meta name="description" content="Значение термина {!! $page->name !!} Вы найдете в нашем оптическом словаре. Заходите на сайт, чтобы узнать больше.">
	<?php elseif ($_SERVER['REQUEST_URI'] == "/activities") : ?>
		<meta name="description" content="Предлагаем ознакомиться с основными направлениями деятельности компании Treviso.  Мы предоставляем квалифицированное обслуживание и индивидуальный подход на рынке офтальмологических услуг уже не один год. ">
		<?php elseif ($_SERVER['REQUEST_URI'] == "/personal") : ?>
		<meta name="description" content="Предлагаем познакомиться с нашими сотрудниками, которые приложат все усилия, чтобы Вы остались довольны посещением Treviso. Каждый наш сотрудник – высококвалифицированный специалист в своей области. Ждем Вас!">
		<?php elseif ($_SERVER['REQUEST_URI'] == "/herson") : ?>
<meta name="description" content="Информация о расположении, графике работы и услугах салонов Treviso в Херсоне. Приходите к нам или звоните по телефонам, указанным на сайте.">
		<?php elseif ($_SERVER['REQUEST_URI'] == "/golaya-pristan") : ?>
<meta name="description" content="Контактная информация салона Treviso в г. Голая Пристань. Приходите по адресу ул. Ленина, 4 или звоните по телефону  099-230-64-63. График работы можно посмотреть на сайте.">
<?php elseif ($_SERVER['REQUEST_URI'] == "/skadovsk") : ?>
<meta name="description" content="Контактная информация салона Treviso в Скадовске. Приходите по адресу ул. Чапаева, 121 или звоните нам по телефону 099 107 85 65. График работы можно посмотреть на сайте.">
<?php elseif ($_SERVER['REQUEST_URI'] == "/oleshki-tsyurupinsk") : ?>
<meta name="description" content="Контактная информация салона Treviso в Олешках (Цюрупинске). Приходите по адресу ул. Гвардейская,17 или звоните нам по телефону 099-230-64-65. График работы можно посмотреть на сайте.">
<?php elseif ($_SERVER['REQUEST_URI'] == "/histories") : ?>
<meta name="description" content="Предлагаем ознакомиться с историями и опытом наших клиентов по использованию нашей продукции и прохождению диагностики в нашем центре. Читайте подробнее на сайте.">
<?php elseif ($_SERVER['REQUEST_URI'] == "/purchase-returns") : ?>
<meta name="description" content="Предлагаем ознакомиться с условиями, при которых Вы можете осуществить возврат товара, купленного в сети Treviso. Мы желаем Вам удачных покупок без возвратов.">
<?php elseif ($_SERVER['REQUEST_URI'] == "/categories/zapis-na-priem-k-oftalmologu") : ?>
<meta name="description" content="Узнайте больше о том, как можно записаться на прием к офтальмологу в удобное для Вас время в нашем центре. Не откладывайте, звоните прямо сейчас: +38 (050) 504-60-10, +38 (067) 271-42-19">
<? else : ?>
	@if (  isset( $page->meta_description )  )<meta name="description" content="{{{ $page->meta_description }}}">@endif
<?php endif; ?>

<?
	if(strstr($_SERVER['REQUEST_URI'],'/ask?page=1') or
		strstr($_SERVER['REQUEST_URI'],'/ask?page=2') or
		strstr($_SERVER['REQUEST_URI'],'/ask?page=3') or
		strstr($_SERVER['REQUEST_URI'],'/ask?page=4')){
	echo '<link rel="canonical" href="http://treviso.ua/ask" >';
	}

	if(strstr($_SERVER['REQUEST_URI'],'/news?page=1') or
		strstr($_SERVER['REQUEST_URI'],'/news?page=2') or
		strstr($_SERVER['REQUEST_URI'],'/news?page=3') or
		strstr($_SERVER['REQUEST_URI'],'/news?page=4') or
		strstr($_SERVER['REQUEST_URI'],'/news?page=5') or
		strstr($_SERVER['REQUEST_URI'],'/news?page=6')){
	echo '<link rel="canonical" href="http://treviso.ua/news" >';
	}

	if(strstr($_SERVER['REQUEST_URI'],'/useful-info/medical-glasses?page=1') or
		strstr($_SERVER['REQUEST_URI'],'/useful-info/medical-glasses?page=2')){
	echo '<link rel="canonical" href="http://treviso.ua/useful-info/medical-glasses" >';
	}

	if(strstr($_SERVER['REQUEST_URI'],'/useful-info/o-solntsezaschitnyh-ochkah?page=1') or
		strstr($_SERVER['REQUEST_URI'],'/useful-info/o-solntsezaschitnyh-ochkah?page=2')){
	echo '<link rel="canonical" href="http://treviso.ua/useful-info/o-solntsezaschitnyh-ochkah" >';
	}

	if(strstr($_SERVER['REQUEST_URI'],'/useful-info/kontaktnaya-korrektsiya?page=1') or
		strstr($_SERVER['REQUEST_URI'],'/useful-info/kontaktnaya-korrektsiya?page=2')){
	echo '<link rel="canonical" href="http://treviso.ua/useful-info/kontaktnaya-korrektsiya" >';
	}

?>


	<link rel="stylesheet" href="/frontend/css/app.min.css">
	<link rel="stylesheet" href="/public/favicon.ico">

	<meta name="yandex-verification" content="c3b4bcd8551d7a21" />

	<meta name="yandex-verification" content="22b66032e191d087" />
	<meta name="google-site-verification" content="aoVRvPVuEDiu3PXDb9ybk2MupDQfJFRYNuub03AMmHo" />

	<meta name="google-site-verification" content="7cr3YI6AN-F5RpvqaFJirRmMdJyjL3TeXy4_D90WMvA" />

<!-- 	<link rel="stylesheet" href="/frontend/css/reset.css">
	<link href="/frontend/css/jquery.bxslider.css" rel="stylesheet">
	<link type="text/css" href="/frontend/css/jscrollpane.css" rel="stylesheet">
	<link type="text/css" href="/frontend/css/jquery.datetimepicker.css" rel="stylesheet">
	<link href="/frontend/css/style.css" type="text/css" rel="stylesheet"> -->

	@section('styles')
	@show

	<!--[if lt IE 9]>
		<script src="/frontend/js/html5shiv.js"></script>
	<![endif]-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125290840-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125290840-1');

</script>
	<!-- Google Analytics -->
	<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-125290840-1', 'auto');
ga('send', 'pageview');
</script>
	<!-- End Google Analytics -->
</head>
<body>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter36382700 = new Ya.Metrika({ id:36382700, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/36382700" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<div class="global_wr">

	<a id="ask_question" href="/ask">Задать вопрос</a>
	<a href="#moveup" class="to_top"></a>

	<nav>


<div class="wrapper">
			<ul class="clearfix">
				<li><a href="/about">О компании</a>
					<ul class="clearfix">
						<li><a href="/activities">Деятельность</a></li>
						<li><a href="/personal">Сотрудники</a></li>
					</ul>
				</li>
				<li><a href="/opticians">Салоны оптики</a>
					<ul class="clearfix">
						<li><a href="/herson">Херсон</a></li>
						<li><a href="/golaya-pristan">Голая Пристань</a></li>
						<li><a href="/skadovsk">Скадовск</a></li>
						<li><a href="/oleshki-tsyurupinsk">Олешки (Цюрупинск)</a></li>
						<li><a href="/nikolaev-">Николаев </a></li>
					</ul>
				</li>
				<li><a href="/medical-center">Медицинский центр</a>
					<ul class="clearfix">
						<li><a href="/apparatnoe-lechenie">Аппаратное лечение</a></li>
						<li><a href="/detskaya-oftalmologiya">Детская офтальмология</a></li>
						<li><a href="/korrektsiya-blizorukosti">Коррекция близорукости</a></li>
						<li><a href="/korrektsiya-dalnozorkosti">Коррекция дальнозоркости</a></li>
						<li><a href="/korrektsiya-astigmatizma-">Коррекция астигматизма </a></li>
						<!--<li><a href="/medical-center-nikolaev">Офтальмологическая клиника Николаев</a></li>-->
					</ul>
				</li>
				<li><a href="/garantijnoe-obsluzhivanie">Гарантийное обслуживание</a></li>
				<li><a href="/discount-program">Дисконтная программа</a></li>
				<li><a href="/career">Карьера</a></li>
				<li><a href="/partners">Партнерам</a></li>
				<li><a href="/shop">Условия доставки</a>
					<ul class="clearfix">
						<li><a href="/dostavka-kontaktnyh-linz">Доставка контактных линз</a></li>
						<li><a href="/delivery">Доставка и оплата</a></li>
					</ul>
				</li>
				<li><a href="/personal-area">Личный кабинет/ регистрация</a></li>
				<!--<li><a href="/apparatnoe-lechenie-v-nikolaeve">Аппаратное лечение глаз в Николаеве</a></li>-->
			</ul>

		</div>
<!--		<div class="wrapper">
			{!! HTML::pages( $main_pages_tree ) !!}
		</div>
-->
	</nav>
	<!-- nav end -->

	<header>
		<div class="wrapper clearfix">

			<a href="/" class="logo fleft" id="moveup">
				<img src="/frontend/img/logo.png" alt="logo">
				<span>
					<img src="/frontend/img/rotated.png" alt="rotated">
				</span>
			</a>
			<div class="fleft">

				<div class="clearfix right_top">
					<div class="slogan fleft">{{ $settings[12]->value }}</div>
					<div class="fleft phones">
						<p>{{ $settings[2]->value }}</p>
						<p>{{ $settings[3]->value }}</p>
						<p class="worktime">{{ $settings[1]->value }}</p>
					</div>
					<div class="fright cart">
						<a class="fleft" href="/cart">
							<img src="/frontend/img/icons/cart.png" alt="cart">
						</a>
						<div class="c_info">
							<p>Корзина</p>
							<span class="cart_quant">{{ $count_in_cart }} {{ Lang::choice('товар|товара|товаров', $count_in_cart , array(), 'ru') }}</span>
							<span class="cart_pr">{{ $total_price }} грн</span>
						</div>
					</div>
				</div>
				<!-- header right top section end -->

				<div class="clearfix">
					<div class="search_form fleft">
						<form method="POST" action="/search">
							{!! csrf_field() !!}
							<input type="text" required name="search" placeholder="Поиск">
							<input type="image" src="/frontend/img/icons/len.png" alt="search">
						</form>
					</div>
					<!-- search form end -->
					<div class="fright networks">
						<span>Мы в социальных сетях:</span>
						<a href="{{ $settings[7]->value }}" target="_blank"><img src="/frontend/img/icons/vk.png" alt="vk"></a>
						<a href="{{ $settings[8]->value }}" target="_blank"><img src="/frontend/img/icons/fb.png" alt="fb"></a>
						<a href="{{ $settings[9]->value }}" target="_blank"><img src="/frontend/img/icons/google.png" alt="google"></a>
						<a href="{{ $settings[10]->value }}" target="_blank"><img src="/frontend/img/icons/ok.png" alt="ok"></a>
					</div>
				</div>
				<!-- header right bottom section end -->

			</div>

		</div>
	</header>
	<!-- header end -->

	<menu>
		<div class="wrapper">
			<ul>
				@foreach( $categories as $cat )
					<li><a href="/categories/{{ $cat->slug }}">{{ $cat->name }}</a></li>
				@endforeach
			</ul>
		</div>
	</menu>
	<!-- menu end  -->