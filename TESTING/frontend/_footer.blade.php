	<footer>
		<div class="wrapper">
			<div class="clearfix">
				<a href="/" class="logo fleft">
					<img src="/frontend/img/logo.png" alt="logo">
					<span>
						<img src="/frontend/img/rotated.png" alt="rotated">
					</span>
				</a>
				<div class="about_company fleft">
					<a class="heading" href="/activities">О компании</a>
					<ul>
						<li><a href="/opticians">Салоны оптики</a></li>
						<li><a href="/medical-center">Медицинский центр</a></li>
						<li><a href="/career">Карьера в Treviso</a></li>
						<li><a href="/partners">Партнерам</a></li>
						<li><a href="/reviews">Отзывы</a></li>
						<li><a href="/news">Новости</a></li>
					</ul>
				</div>
				<!-- about_company end -->
				<div class="shop fleft">
					<p class="heading">Интернет магазин</p>
					<ul>
						<li><a href="/dostavka-kontaktnyh-linz">Доставка и оплата</a></li>
						<li><a href="/ask">Задать вопрос</a></li>
						<li><a href="/discount-program">Дисконтная программа</a></li>
						<li><a href="/purchase-returns">Возврат товара</a></li>
					</ul>
				</div>
				<!--  shop end-->
				<div class="check_in fleft">
					<p class="heading">Записаться  к офтальмологу</p>
					<a href="/categories/kontaktnye-linzy">Купить контактные линзы</a>
					<div class="like">Понравился наш интернет-магазин?</div>

					<!-- networks -->
					<script type="text/javascript">(function() {
					  if (window.pluso)if (typeof window.pluso.start == "function") return;
					  if (window.ifpluso==undefined) { window.ifpluso = 1;
					    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
					    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
					    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
					    var h=d[g]('body')[0];
					    h.appendChild(s);
					  }})();</script>
					<div class="pluso" data-background="none;" data-options="medium,square,line,horizontal,nocounter,sepcounter=1,theme=14" data-services="vkontakte,facebook" data-url="http://{{Request::getHttpHost()}}"></div>
					<!-- networks end -->

				</div>
				<!-- check in end -->
				<div class="contacts fright">
					<p class="heading">Контакты</p>
					<p>{{ $settings[2]->value }}</p>
					<p>{{ $settings[3]->value }}</p>
					{{--<a href="/site-map">Карта сайта</a>--}}
				</div>
			</div>
			<!-- clearfix end -->
			<p class="footer_text">Этот сайт является официальным для сети салонов оптики Treviso, которая полностью отвечает за его содержимое. Все права защищены.</p>
			<div class="clearfix">
				<div class="copywrite fleft">&copy; Copyright <script>document.write(new Date().getFullYear())</script> &laquo;Treviso&raquo;</div>
				<div class="counter fright">
					<!-- Yandex.Metrika informer  <a href="https://metrika.yandex.ru/stat/?id=36382700&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/36382700/3_0_FFFFFFFF_EFEFEFFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:36382700,lang:'ru'});return false}catch(e){}" /></a> </Yandex.Metrika informer -->
				</div>
				<a href="http://dvacom.net/portfolio-shop" target="_blank" class="dvacom fright">
					Создание сайта:
					<img src="/frontend/img/icons/dvacom.png" alt="dvacom">
				</a>
			</div>
		</div>
	</footer>