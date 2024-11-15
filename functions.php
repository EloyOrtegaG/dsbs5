<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
function theme_styles(){
    //wp_enqueue_style('bs_css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), array(),'', 'all' );
	wp_enqueue_style( 'main', get_theme_file_uri( 'dist/styles.css' ), array(),'', 'all' ); // main.scss: Compiled Framework source + custom styles.
	wp_enqueue_style( 'InterFont', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap', array(),'', 'all' );
	wp_enqueue_style( 'md-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu', array(),'', 'all' );
}
add_action ('wp_enqueue_scripts', 'theme_styles');

function theme_js(){
	global $wp_scripts;
		
	wp_enqueue_script( 'bs_js', get_theme_file_uri( 'node_modules/dist/js/bootstrap.min.js' ), array(), '', true );
	//wp_enqueue_script( 'bsesm_js', get_theme_file_uri( 'node_modules/dist/js/bootstrap.esm.min.js' ), array(), '', true );
	//wp_enqueue_script( 'popper_js', get_theme_file_uri( 'node_modules/dist/js/popper.min.js' ), array(), '', true );
    //wp_enqueue_script( 'bsbundle_js', get_theme_file_uri( 'node_modules/dist/js/bootstrap.bundle.min.js' ), array(), '', true );


 
    //wp_enqueue_script('disablecookies_js',  get_template_directory_uri() . '/js/disablecookies.js', '','', true);
}
add_action ('wp_enqueue_scripts','theme_js');


function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/admin/admin.css');
  }
  add_action('admin_enqueue_scripts', 'admin_style');

  function new_excerpt_length($length) {

	return 20;
	
	}
	
	add_filter('excerpt_length', 'new_excerpt_length');





/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 *
 * @global WP_Post $post Global post object.
 *
 * @return bool
 */
function is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || ( is_tag() && ( 'post' === $posttype ) ) ) ? true : false );
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 *
 * @param bool $open    Comments open/closed.
 * @param int  $post_id Post ID.
 *
 * @return bool
 */
function dsbs502_filter_media_comment_status( $open, $post_id = null ) {
	$media_post = get_post( $post_id );

	if ( 'attachment' === $media_post->post_type ) {
		return false;
	}

	return $open;
}
add_filter( 'comments_open', 'dsbs502_filter_media_comment_status', 10, 2 );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Post Edit Link.
 *
 * @return string
 */
function dsbs502_custom_edit_post_link( $link ) {
	return str_replace( 'class="post-edit-link"', 'class="post-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_post_link', 'dsbs502_custom_edit_post_link' );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Comment Edit Link.
 */
function dsbs502_custom_edit_comment_link( $link ) {
	return str_replace( 'class="comment-edit-link"', 'class="comment-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_comment_link', 'dsbs502_custom_edit_comment_link' );

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 *
 * @param string $html Inner HTML.
 *
 * @return string
 */
function dsbs502_oembed_filter( $html ) {
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'dsbs502_oembed_filter', 10 );

if ( ! function_exists( 'dsbs502_content_nav' ) ) {
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 *
	 * @param string $nav_id Navigation ID.
	 */
	function dsbs502_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<div id="<?php echo esc_attr( $nav_id ); ?>" class="d-flex mb-4 justify-content-between">
				<div><?php next_posts_link( '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Older posts', 'dsbs502' ) ); ?></div>
				<div><?php previous_posts_link( esc_html__( 'Newer posts', 'dsbs502' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?></div>
			</div><!-- /.d-flex -->
			<?php
		} else {
			echo '<div class="clearfix"></div>';
		}
	}

	/**
	 * Add Class.
	 *
	 * @since v1.0
	 *
	 * @return string
	 */
	function posts_link_attributes() {
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
	add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
}

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 *
 * @return void
 */
function dsbs502_widgets_init() {
	// Area 1.
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area (Sidebar)',
			'id'            => 'primary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

// Area 2
register_sidebar(
	array(
		'name'          => 'DS Sidebar',
		'id'            => 'ds_sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);


	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Header Widget 01 (Header 01)',
			'id'            => 'header_widget_01',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	

	// Area 4.
	/*register_sidebar(
		array(
			'name'          => 'Header Widget 02 (Header Right)',
			'id'            => 'header_widget_02',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);*/

	// Area 5.
	register_sidebar(
		array(
			'name'          => 'Footer Widget 01',
			'id'            => 'footer_widget_01',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
		// Area 6.
		register_sidebar(
			array(
				'name'          => 'Footer Widget 02',
				'id'            => 'footer_widget_02',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
}
add_action( 'widgets_init', 'dsbs502_widgets_init' );



if ( function_exists( 'register_nav_menus' ) ) {
	/**
	 * Nav menus.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',			
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp-bootstrap-navwalker-footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}

$custom_walker_puestos = __DIR__ . '/inc/wp-bootstrap-navwalker-puestos.php';
if ( is_readable( $custom_walker_puestos ) ) {
	require_once $custom_walker_puestos;
}



/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 *
 * @return void
 */


 



// Deshabilitar comentarios WP
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});




/*Custom Posts*/
/*  Carousel */
// La función no será utilizada antes del 'init'.
add_action( 'init', 'crear_post_type_carousel' );
/* Here's how to create your customized labels */
function crear_post_type_carousel() {
    $labels = array(
    'name' => _x( 'Carousel', 'post type general name' ),
        'singular_name' => _x( 'carousel', 'post type singular name' ),
        'add_new' => _x( 'Añadir nuevo', 'carousel' ),
        'add_new_item' => __( 'Añadir nuevo carousel' ),
        'edit_item' => __( 'Editar carousel' ),
        'new_item' => __( 'Nuevo carousel' ),
        'view_item' => __( 'Ver carousel' ),
        'search_items' => __( 'Buscar carouseles' ),
        'not_found' =>  __( 'No se han encontrado carouseles' ),
        'not_found_in_trash' => __( 'No se han encontrado carouseles en la papelera' ),
        'parent_item_colon' => ''
    );
 
    // Creamos un array para $args
    $args = array( 'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-slides',
        'supports' => array( 'title', 'editor', 'thumbnail' )
    );
 
    register_post_type( 'carousel', $args ); /* Registramos y a funcionar */
}
/*Fin carouseles*/
/*columnas carousel wpadmin*/
/*cargarlos*/
 // adding our table columns with this function:  
function carousel_custom_table_head( $defaults ) {  
    $defaults['orden']   = 'Orden';  
    return $defaults;  
}  
// change the _event_ part in the filter name to your CPT slug  
add_filter('manage_carousel_posts_columns', 'carousel_custom_table_head');  
  
  
// now let's fill our new columns with post meta content  
function carousel_custom_table_content( $column_name, $post_id ) {  
    if ($column_name == 'orden') { 
        echo get_post_meta( $post_id, 'meta-box-carousel-orden', true ); 
    } 
} 
// change the _event_ part in the filter name to your CPT slug 
add_action( 'manage_carousel_posts_custom_column', 'carousel_custom_table_content', 10, 2 );  

/*ORDENARLOS FILTRO*/
add_filter( 'manage_edit-carousel_sortable_columns', 'my_carousel_sortable_columns' );

function my_carousel_sortable_columns( $columns ) {

    $columns['orden'] = 'orden';

    return $columns;
}

/**/
/*Meta BOXES*/
/*Propiedades carouseles*/
/*1*/

function add_custom_meta_box_carousel()
{
    add_meta_box("carousel-meta-box", "Propiedades carousel", "custom_meta_box_carousel_markup", "carousel", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box_carousel");

/*2*/
function custom_meta_box_carousel_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
<div>    
    <!--<label for="meta-box-carousel-video">¿Vídeo?</label>
    <input name="meta-box-carousel-video" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-video", true); ?>">
    <br />-->
    <label for="meta-box-carousel-subtitu">Subititular</label>
    <input name="meta-box-carousel-subtitu" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-subtitu", true); ?>">
    <br />
    <label for="meta-box-carousel-texto-bt-01">Texto Botón 01</label>
    <input name="meta-box-carousel-texto-bt-01" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-texto-bt-01", true); ?>">
    <br />
    <label for="meta-box-carousel-url-bt-01">URL Botón 01</label>
    <input name="meta-box-carousel-url-bt-01" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-url-bt-01", true); ?>">
    <br />
    <label for="meta-box-carousel-texto-bt-02">Texto Botón 02</label>
    <input name="meta-box-carousel-texto-bt-02" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-texto-bt-02", true); ?>">
    <br />
    <label for="meta-box-carousel-url-bt-02">URL Botón 02</label>
    <input name="meta-box-carousel-url-bt-02" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-url-bt-02", true); ?>">
    <br />
    <label for="meta_box_carousel_fondo">Fondo</label>
    <select name="meta_box_carousel_fondo" id="meta_box_carousel_fondo">
        <?php $color_fondo = get_post_meta( get_the_ID(), 'meta_box_carousel_fondo', true );?>
            <option value="blanco" <?php if ($color_fondo == "blanco")  echo 'selected'; ?>>Blanco</option>                        
			<option value="oscuro" <?php if ($color_fondo == "oscuro")  echo 'selected'; ?>>Oscuro</option>            
        </select>
    <br />
    <label for="meta-box-carousel-orden">Orden</label>
    <input name="meta-box-carousel-orden" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-carousel-orden", true); ?>">
</div>
<?php  
}

/*3*/
function save_custom_meta_box_carousel($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "carousel";
    if($slug != $post->post_type)
        return $post_id;
        $meta_box_carousel_video = "";
        $meta_box_carousel_subtitu = "";
        $meta_box_carousel_texto_bt_01 = "";
        $meta_box_carousel_url_bt_01 = "";
        $meta_box_carousel_texto_bt_02 = "";
        $meta_box_carousel_url_bt_02 = ""; 
        $selected = isset( $values['meta_box_carousel_fondo'] ) ? esc_attr( $values['meta_box_carousel_fondo'][0] ) : '';   
        $meta_box_carousel_orden_value = "";

    if(isset($_POST["meta-box-carousel-video"]))
    {
        $meta_box_carousel_video = $_POST["meta-box-carousel-video"];
    }   
    update_post_meta($post_id, "meta-box-carousel-video", $meta_box_carousel_video);

    if(isset($_POST["meta-box-carousel-subtitu"]))
    {
        $meta_box_carousel_subtitu = $_POST["meta-box-carousel-subtitu"];
    }   
    update_post_meta($post_id, "meta-box-carousel-subtitu", $meta_box_carousel_subtitu);

    if(isset($_POST["meta-box-carousel-texto-bt-01"]))
    {
        $meta_box_carousel_texto_bt_01 = $_POST["meta-box-carousel-texto-bt-01"];
    }   
    update_post_meta($post_id, "meta-box-carousel-texto-bt-01", $meta_box_carousel_texto_bt_01);

    if(isset($_POST["meta-box-carousel-url-bt-01"]))
    {
        $meta_box_carousel_url_bt_01 = $_POST["meta-box-carousel-url-bt-01"];
    }   
    update_post_meta($post_id, "meta-box-carousel-url-bt-01", $meta_box_carousel_url_bt_01);

    if(isset($_POST["meta-box-carousel-texto-bt-02"]))
    {
        $meta_box_carousel_texto_bt_02 = $_POST["meta-box-carousel-texto-bt-02"];
    }   
    update_post_meta($post_id, "meta-box-carousel-texto-bt-02", $meta_box_carousel_texto_bt_02);

    if(isset($_POST["meta-box-carousel-url-bt-02"]))
    {
        $meta_box_carousel_url_bt_02 = $_POST["meta-box-carousel-url-bt-02"];
    }   
    update_post_meta($post_id, "meta-box-carousel-url-bt-02", $meta_box_carousel_url_bt_02);
    
    if( isset( $_POST['meta_box_carousel_fondo'] ) )
        update_post_meta( $post_id, "meta_box_carousel_fondo", esc_attr( $_POST['meta_box_carousel_fondo'] ) );

     if(isset($_POST["meta-box-carousel-orden"]))
    {
        $meta_box_carousel_orden_value = $_POST["meta-box-carousel-orden"];
    }   
    update_post_meta($post_id, "meta-box-carousel-orden", $meta_box_carousel_orden_value);
}

add_action("save_post", "save_custom_meta_box_carousel", 10, 3);

/*Fin MetaBoxes carousel*/


   


