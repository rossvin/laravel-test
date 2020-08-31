	<div class="subscribe clearfix">
		<div class="wrapper">
			<div class="subscr_slogan fleft">
				<p>Будь первым в самой гуще событий!</p>
				<span>Новые коллекции, неожиданные дизайнерские решения и самые выгодные акционные предложения</span>
			</div>
			<div class="subscr_form fright">
				<form action="subscribe" method="POST">
					{!! csrf_field() !!}
					<div class="form_group">
						<label class="subscr_name"></label><input type="text" name="name" required placeholder="Введите Ваше Имя">
					</div>
					<div class="form_group">
						<label class="subscr_email"></label><input type="email" name="email" required placeholder="Введите Ваш email">
					</div>
					<input type="submit" value="Подписаться на новостную рассылку">
				</form>
				@if( Session::has('message') )
					<p class="subscr_message">{{ Session::get('message') }}</p>
				@endif
				@if( $errors->any() )
					<p>Вы ошиблись при заполнении формы. Заполните все поля и повторите попытку</p>
				@endif
			</div>
		</div>
		<!-- wrapper end -->
	</div>
	<!-- subscribe_form end -->