<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();


$sticky = get_option( 'sticky_posts' );
$args = array(
    'ignore_sticky_posts' => 1,
    'post__not_in' => $sticky,
    'posts_per_page' => 6,
    'meta_query' => array(array('key' => '_thumbnail_id'))
  );
$context['posts'] = Timber::get_posts($args);

Timber::render( '404.twig', $context );
