<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array( 'search.twig');
$context = Timber::get_context();

$context['posts'] = Timber::get_posts();

$sticky = get_option( 'sticky_posts' );
$args = array(
    'ignore_sticky_posts' => 1,
    'post__not_in' => $sticky,
    'posts_per_page' => 6,
    'meta_query' => array(array('key' => '_thumbnail_id'))
  );
$context['search'] = Timber::get_posts($args);


Timber::render( $templates, $context );
