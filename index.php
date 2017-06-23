<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();


$context['posts'] = Timber::get_posts();
$context['foo'] = 'bar';
$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'home.twig' );
}

$slider_args = array(
						'post__not_in' => get_option( 'sticky_posts' ),
            'posts_per_page' => 5,
            'meta_query' => array(array('key' => '_thumbnail_id')));
$context['slider'] = Timber::get_posts($slider_args);

$context['pagination'] = Timber::get_pagination();

Timber::render( $templates, $context );
