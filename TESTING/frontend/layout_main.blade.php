@include('frontend._top_section')

@yield('main')

@yield('news_subscription')

</div>
<!-- global wrapper end -->

@include('frontend._footer')

<script src="/frontend/js/app.min.js"></script>

<!-- <script src="/frontend/js/jquery-1.11.3.min.js"></script>
<script src="/frontend/js/jquery.bxslider.min.js"></script>
<script src="/frontend/js/jquery.datetimepicker.js"></script> -->

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
	$('.bxslider').bxSlider({
		controls: false,
		auto: true,
		speed: 700,
		pause: 5000,
	});

	$('.offers_slider').bxSlider({
		slideWidth: 310,
		minSlides: 3,
		maxSlides: 3,
		slideMargin: 11,
		pager: false,
		auto: true,
		speed: 1000,
		pause: 11000,
		controls: true
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
   });

</script>
@section('scripts')
@show

</body>
</html>