<?php
function datepicker_js(){
	// подключаем все необходимые скрипты: jQuery, jquery-ui, datepicker
	wp_enqueue_script('jquery-ui-datepicker');

	// подключаем нужные css стили
	wp_enqueue_style('jqueryui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, null );

	// инициализируем datepicker
	if( is_admin() )
		add_action('admin_footer', 'init_datepicker', 99 ); // для админки
	else
		add_action('wp_footer', 'init_datepicker', 99 ); // для админки
}