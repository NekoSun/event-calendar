<?php
/*
Plugin Name: neko-calendar
Plugin URI: https://github.com/NekoSun/event-calendar
Description: Календарь событий.
Version: 1.0.2
Author: NekoSun
Author URI: https://portfolio.nekoweb.ru/
 */

load_template( dirname( __FILE__ ) . '/init-datepicker.php' );
load_template( dirname( __FILE__ ) . '/datepicker-js.php' );


// Вызываем функцию, когда активируется плагин
register_activation_hook( __FILE__, 'neko_calen_store_install' );

function neko_calen_store_install() {

  // устанавливаем параметры no умолчанию
  $hween_options_arr = array(
    'currency_sign' => '$'
  );

  // сохраняем параметры по умолчанию
  update_option( 'neko_calen_options', $hween_options_arr );

}

// Зацепка-действие для инициализации плагина
add_action( 'init', 'neko_calen_store_init' );

// функция инициализация плагина Halloween Store
function neko_calen_store_init() {

  //Регистрация пользовательского типа записи продуктов(локализация)
	$labels = array(
		'name' => __( 'Календарь событий', 'neko-calen-plugin' ),//(title)основное название для типа записи
		'singular_name' => __( 'Product', 'neko-calen-plugin' ),// название для одной записи этого типа
		'add_new' => __( 'Добавить событие', 'neko-calen-plugin' ),// для добавления новой записи
		'add_new_item' => __( 'Добавить новое событие', 'neko-calen-plugin' ),// заголовка у вновь создаваемой записи в админ-панели.
		'edit_item' => __( 'Редактировать событие', 'neko-calen-plugin' ),// для редактирования типа записи
		'new_item' => __( 'New Neko', 'neko-calen-plugin' ),// текст новой записи
		'all_items' => __( 'События', 'neko-calen-plugin' ),// для просмотра записи этого типа.
		'view_item' => __( 'View Product', 'neko-calen-plugin' ),// для поиска по этим типам записи
		'search_items' => __( 'Search Neko', 'neko-calen-plugin' ),// если в результате поиска ничего не было найдено
		'not_found' =>  __( 'Нет событий', 'neko-calen-plugin' ),// если не было найдено в корзине
		'not_found_in_trash' => __( 'No Neko found in Trash', 'neko-calen-plugin' ),// для родителей (у древовидных типов)
		'menu_name' => __( 'Календарь событий', 'neko-calen-plugin' ) //пункт меню// название меню
  );

  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => false,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
    'menu_position' => 3,
    'menu_icon' => 'dashicons-calendar-alt',
    'supports' => array( 'title'),
    'taxonomies' => array( 'neko-taxonomy', 'neko-taxonomy-cou')
  );

  register_post_type( 'neko-calen', $args );

  $labels_taxonomy_cal = array(
    'name'              => 'Категория календаря',
    'singular_name'     => 'Neko',
    'search_items'      => 'Найти календарь',
    'all_items'         => 'Все календари',
    'view_item'         => 'View Neko',
    'parent_item'       => 'Родительская рубрика',
    'parent_item_colon' => 'Родительская рубрика:',
    'edit_item'         => 'Edit Neko',
    'update_item'       => 'Обновить календарь',
    'add_new_item'      => 'Добавить календарь',
    'new_item_name'     => 'New Neko Name',
    'menu_name'         => 'Календари',
  );

  $args_taxonomy_cal = array(
    'label'                 =>  '', // определяется параметром $labels->name
    'labels'                =>  $labels_taxonomy_cal,
    'description'           => '', // описание таксономии
    'public'                => true,
    'publicly_queryable'    => null, // равен аргументу public
    'show_in_nav_menus'     => true, // равен аргументу public
    'show_ui'               => true, // равен аргументу public
    'show_in_menu'          => true, // равен аргументу show_ui
    'show_tagcloud'         => true, // равен аргументу show_ui
    'show_in_rest'          => null, // добавить в REST API
    'rest_base'             => null, // $taxonomy
    'hierarchical'          => true,
    //'update_count_callback' => '_update_post_term_count',
    'rewrite'               => true,
    //'query_var'             => $taxonomy, // название параметра запроса
    'capabilities'          => array(),
    'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
    'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    '_builtin'              => false,
    'show_in_quick_edit'    => null, // по умолчанию значение show_ui
  );

  register_taxonomy('neko-taxonomy', 'neko-calen',  $args_taxonomy_cal);

  $labels_taxonomy_cou = array(
    'name'              => 'Страны',
    'singular_name'     => 'Neko',
    'search_items'      => 'Найти страну',
    'all_items'         => 'Все страны',
    'view_item'         => 'View Neko',
    'parent_item'       => 'Родительская рубрика',
    'parent_item_colon' => 'Родительская рубрика:',
    'edit_item'         => 'Edit Neko',
    'update_item'       => 'Обновить календарь',
    'add_new_item'      => 'Добавить страну',
    'new_item_name'     => 'New Neko Name',
    'menu_name'         => 'Страны',
  );

  $args_taxonomy_cou = array(
    'label'                 =>  '', // определяется параметром $labels->name
    'labels'                =>  $labels_taxonomy_cou,
    'description'           => '', // описание таксономии
    'public'                => true,
    'publicly_queryable'    => null, // равен аргументу public
    'show_in_nav_menus'     => true, // равен аргументу public
    'show_ui'               => true, // равен аргументу public
    'show_in_menu'          => true, // равен аргументу show_ui
    'show_tagcloud'         => true, // равен аргументу show_ui
    'show_in_rest'          => null, // добавить в REST API
    'rest_base'             => null, // $taxonomy
    'hierarchical'          => true,
    //'update_count_callback' => '_update_post_term_count',
    'rewrite'               => true,
    //'query_var'             => $taxonomy, // название параметра запроса
    'capabilities'          => array(),
    'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
    'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    '_builtin'              => false,
    'show_in_quick_edit'    => null, // по умолчанию значение show_ui
  );

  register_taxonomy('neko-taxonomy-cou', 'neko-calen',  $args_taxonomy_cou);

  register_taxonomy_for_object_type( 'neko-taxonomy', 'neko-calen');
  register_taxonomy_for_object_type( 'neko-taxonomy-cou', 'neko-calen');

}

if (is_admin()) {

  // колонка "ID" для рубрик, меток и т.д.
  add_action("manage_edit-neko-taxonomy_columns", 'tax_add_col');
  add_filter("manage_edit-neko-taxonomy_sortable_columns", 'tax_add_col');
  add_filter("manage_neko-taxonomy_custom_column", 'tax_show_id', 10, 3);
  add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
  function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}
  function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}
  function tax_id_style() {print '<style>#tax_id{width:3em}</style>';}
}

// подключение стилей в админку
datepicker_js();

// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
  add_meta_box( 'extra_fields', 'События. Настройки', 'extra_fields_box_func', 'neko-calen', 'normal', 'low'  );
}

function extra_fields_box_func( $post, $box ){
  $event_data = get_post_meta( $post->ID, '_event_data', true );
  $event_city = get_post_meta( $post->ID, '_event_city', true );

  ?>
  <!-- <input type="text" name="ecwd_event_date_from" id="ecwd_event_date_from" class="ecwd_event_date" value="2019/07/18" autocomplete="off"> -->
  <div style="display: flex;">
    <div>Дата проведения: <input type="text" class="datepicker" name="event_data" value="<?php echo esc_attr( $event_data ) ?>" size="10" required /></div>
    <div style="padding-left:60px;">Город проведения: <input type="text" name="event_city" value="<?php echo esc_attr( $event_city ) ?>" size="30" required /></div>
  </div>

  <?php

  // временные значения из соображений безопасности
  wp_nonce_field( plugin_basename( __FILE__ ), 'neko_save_meta_box' );
}

// сохраняем данные метаполя во время сохранения записи
add_action( 'save_post', 'neko_cl_meta_box' );
function neko_cl_meta_box( $post_id ) {

  // обрабатываем данные формы, если установлена переменная $_POST
  if( isset( $_POST['event_data'] ) ) {
    // если включено автосохранение, пропускаем этап сохранения данных метаполя
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;

    // проверяем временное значение из соображений безопасности
    check_admin_referer( plugin_basename( __FILE__ ), 'neko_save_meta_box' );

    // сохраняем данные метаполя в произвольных полях записи, используя префикс ID
    update_post_meta( $post_id, '_event_data', sanitize_text_field( $_POST['event_data'] ) );
    update_post_meta( $post_id, '_event_city', sanitize_text_field ( $_POST['event_city'] ) );
  }
}

// добавление полей мета данных
remove_shortcode( 'prefix_calendar' );

add_shortcode( 'prefix_calendar', 'neko_calendar' );

$calendar_event_array = array();

function neko_calendar($atts) {

  $category_id = explode(',', $atts['category']);
  $terms = get_term($category_id[0]);

  if( !$category_id[0] ) return '<div>Не добавлена категория календаря</div>';
  if( $category_id[1] ) return '<div>Возможно добавить только один календарь</div>';

  global $post;
  $args = array( 'numberposts' => -1, 'category' => $category_id);
  $myposts = get_posts( $args );
  foreach( $myposts as $post ){ setup_postdata($post);

  ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php
    }

  wp_reset_postdata();

  function country() {
    $uuuu = get_the_terms( $post->ID, 'neko-taxonomy-cou' );
    if( is_array( $uuuu ) ){
      foreach( $uuuu as $cur_term ){
        echo  $cur_term->name;

      }
    }
  };

  function get_top_term( $taxonomy, $post_id = 0 ){
    if( isset($post_id->ID) ) $post_id = $post_id->ID;
    if( ! $post_id )          $post_id = get_the_ID();

    $terms = get_the_terms( $post_id, $taxonomy );

    if( ! $terms || is_wp_error($terms) )
      return $terms;

    // только первый
    $term = array_shift( $terms );

    // найдем ТОП
    $parent_id = $term->parent;
    while( $parent_id ){
      $term = get_term_by( 'id', $parent_id, $term->taxonomy );
      $parent_id = $term->parent;
    }

    return $term;
  }

  $args = array(
    'post_type' => 'neko-calen',
    'neko-taxonomy' => $terms->slug
  );
  $query = new WP_Query( $args );

  // Начало цикла
  while ( $query->have_posts() ) : $query->the_post();

  $title = get_the_title();
  $event_data = get_post_meta( $post->ID, '_event_data', true );
  $event_city = get_post_meta( $post->ID, '_event_city', true );

  $top_term = get_top_term( 'neko-taxonomy-cou' );

  global $calendar_event_array;

  array_push($calendar_event_array, (object)array(
    'title' => $title,
    'start' => $event_data,
    'city' => $event_city,
    'rendering'=> 'background',
    'country' => $top_term->name,
    'color'=> '#2c6a04'
  ));

  endwhile;

  // используем сброс данных записи, чтобы восстановить оригинальный запрос
  wp_reset_postdata();

  $calendars = "<div id='calendar'></div>";
  $calendars .= "<div id='modal'></div>";

  add_action( 'wp_footer', 'neko_fullcalendar_styles' );

  return $calendars;
}

function neko_fullcalendar_styles() {
  global $calendar_event_array;
  wp_enqueue_script('fullcalendar_core_js', plugins_url('/fullcalendar/core/main.js', __FILE__), false, null);
  wp_enqueue_script('fullcalendar_locales_js', plugins_url('/fullcalendar/core/locales-all.min.js', __FILE__), false, null);
  wp_enqueue_script('fullcalendar_daygrid_js', plugins_url('/fullcalendar/daygrid/main.js', __FILE__), false, null);
  wp_enqueue_script('fullcalendar_interaction_js', plugins_url('/fullcalendar/interaction/main.min.js', __FILE__), false, null);
  wp_enqueue_script( 'fullcalendar_start_js',  plugins_url('/js/fullcalendar.js', __FILE__), array('jquery', 'jquery-ui-dialog'), null);

  wp_enqueue_style('fullcalendar_core_css', plugins_url('fullcalendar/core/main.css', __FILE__), false, null );
  wp_enqueue_style('fullcalendar_core_css', plugins_url('fullcalendar/daygrid/main.css', __FILE__), false, null );

  wp_localize_script( 'fullcalendar_start_js', 'nekoObj', $calendar_event_array);
};
