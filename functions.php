<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});

	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$sticky = get_option( 'sticky_posts' );
		$footbox_args = array(
			'ignore_sticky_posts' => 1,
			'post__not_in' => array( $sticky),
			'posts_per_page' => 6,
			'meta_query' => array(array('key' => '_thumbnail_id'))
		);
		$context['footbox'] = Timber::get_posts($footbox_args);
		$context['footer_sidebar_1'] = Timber::get_widgets('footer_sidebar_1');
		$context['footer_sidebar_2'] = Timber::get_widgets('footer_sidebar_2');
		$context['footer_sidebar_3'] = Timber::get_widgets('footer_sidebar_3');
		$context['woo_sidebar_1'] = Timber::get_widgets('woo_sidebar_1');
		$context['woo_sidebar_2'] = Timber::get_widgets('woo_sidebar_2');

		$context['menu'] = new TimberMenu('primary');
		$context['woomenu'] = new TimberMenu('woomenu');
		$context['site'] = $this;

		return $context;
	}

	function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();


/**
 * Proper way to enqueue scripts and styles
 */


function wp_scripts_styles() {

		wp_register_script( 'modernizr', get_template_directory_uri() . '/static/js/modernizr-custom.js', array('jquery'), null, true);
		wp_enqueue_script( 'modernizr');

    wp_register_style( 'stylin_css', get_stylesheet_directory_uri() . '/static/css/stylin.css', array(), filemtime( get_stylesheet_directory() . '/static/css/stylin.css' ));
    wp_enqueue_style( 'stylin_css');

		wp_register_style( 'foundation-icons', get_stylesheet_directory_uri() . '/static/css/foundation-icons/foundation-icons.css', array(), filemtime( get_stylesheet_directory() . '/static/css/foundation-icons/foundation-icons.css' ));
		wp_enqueue_style( 'foundation-icons');

		wp_register_script( 'what-input', get_template_directory_uri() . '/static/js/what-input.js', array(), null, true);
		wp_enqueue_script( 'what-input');

    wp_register_script( 'foundation_js', get_template_directory_uri() . '/static/js/foundation.min.js', array(), null, true);
		wp_enqueue_script( 'foundation_js');

		wp_register_script( 'masonry', get_template_directory_uri() . '/static/js/masonry.min.js', array(), null, true);
		wp_enqueue_script( 'masonry');

		wp_register_script( 'sitejs', get_template_directory_uri() . '/static/js/site.js', array(), null, true);
		wp_enqueue_script( 'sitejs');

}
add_action( 'wp_enqueue_scripts', 'wp_scripts_styles' );


register_sidebar( array(
'name' => 'Footer Sidebar 1',
'id' => 'footer_sidebar_1',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array(
'name' => 'Footer Sidebar 2',
'id' => 'footer_sidebar_2',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array(
'name' => 'Footer Sidebar 3',
'id' => 'footer_sidebar_3',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => 'Right Sidebar 1',
'id' => 'right_sidebar_1',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => 'Woo Sidebar 1',
'id' => 'woo_sidebar_1',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array(
'name' => 'Woo Sidebar 2',
'id' => 'woo_sidebar_2',
'description' => 'Appears in the footer area',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );



/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function tnews_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="pagination text-center" aria-label="Pagination">
		<h3 class="card-divider"><?php esc_html_e( 'Post navigation', 'tnews' ); ?></h3>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="pagination-previous prev">%link</div>', _x( '%title', 'Previous post link', 'tnews' ) );
				next_post_link(     '<div class="pagination-next next ">%link</div>',     _x( '%title', 'Next post link',     'tnews' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

// Woocommerce wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="woo" class="single article-content woocommerce">';
}

function my_theme_wrapper_end() {
  echo '</div>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
