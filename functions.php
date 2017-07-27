<?php

/* theme setup */
if ( ! function_exists( 'tss_setup' ) ) :
function tss_setup() {
//	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'tss' ),
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'tss_setup' );

add_action( 'get_header', 'tss_doc_head_control' );
function tss_doc_head_control() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action ('wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}


// ******************* Sidebars ****************** //

function tss_widgets() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'tss' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Add widgets here.', 'tss' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'tss_widgets' );


// scripts and styles
function tss_scripts_styles() {
	wp_enqueue_style( 'tss-fonts', '//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic' );
	wp_enqueue_style( 'tss-styles', get_stylesheet_uri(), '', '' );
	wp_deregister_script('jquery');
	wp_enqueue_script( 'tss-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js', false, null, true );
	wp_enqueue_script( 'tss-scripts', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'tss_scripts_styles' );



// custom post and taxonomy
function register_post_tax() {

register_post_type('custom', array(
	'label' => __('Custom Post Type'),
	'singular_label' => __('Custom Post Type'),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => true,
	'query_var' => false,
	'has_archive' => true,
	'supports' => array('title', 'editor', 'author')
));

register_taxonomy( 'taxo', 'custom', array( 
'hierarchical' => true, 
'label' => 'Custom Taxonomy', 
'query_var' => true, 
'rewrite' => true )
);

}

add_action('init', 'register_post_tax');



// admin setting page
add_action('admin_menu', 'tss_admin_page');
function tss_admin_page() {
	add_menu_page('Theme General Settings', 'Theme Settings', 'administrator', 'general-settings', 'tss_settings_page' );
	add_action( 'admin_init', 'register_general_settings' );
}


function register_general_settings() {
	register_setting( 'tss-settings-group', 'new_option_name' );
	register_setting( 'tss-settings-group', 'some_other_option' );
	register_setting( 'tss-settings-group', 'option_etc' );
}

function tss_settings_page() {
?>
<div class="wrap">
<h1>General theme setting</h1>
<form method="post" action="options.php">
    <?php settings_fields( 'tss-settings-group' ); ?>
    <?php do_settings_sections( 'tss-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php }