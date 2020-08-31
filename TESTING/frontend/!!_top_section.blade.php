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

<?php if ($_SERVER['REQUEST_URI'] == "/") : ?>
<title>Очки в Херсоне: купить очки для зрения в Николаеве недорого | Сеть салонов оптики Treviso</title>
<?php elseif (in_array( Request::segment(1), ['useful-info'] ) ) : ?>
<title>Полезная информация - {!! $page->name !!} | Treviso</title>
<?php elseif (in_array( Request::segment(1), ['dictionary'] ) ) : ?>
<title>Полезная информация - {!! $page->name !!} | Treviso</title>
<? else : ?>
	<title>{{{ $page->meta_title }}} @if( isset( $site_offline ) && $site_offline == 1 )OFFLINE @endif</title>
<?php endif; ?>
	<meta name="keywords" content="{{{ $page->meta_keywords }}}">
<?php if (in_array( Request::segment(1), ['useful-info'] ) ) : ?>
	<meta name="description" content="Интересная и полезная информация от Treviso: {!! $page->name !!}. Читайте подробнее на нашем сайте.">
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
			{!! HTML::pages( $main_pages_tree ) !!}
		</div>
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