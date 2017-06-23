<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $post;
$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['comment_form'] = TimberHelper::get_comment_form();


$categories = get_the_category();
$sticky = get_option( 'sticky_posts' );
$current_post_id = $post->ID;
$relatedposts = array(
	'category_name' => $categories[0]->name,
	'ignore_sticky_posts' => 1,
	'post__not_in' => array( $sticky, $current_post_id),
	'posts_per_page' => 8,
	'meta_query' => array(array('key' => '_thumbnail_id'))
);
$context['relatedposts'] = Timber::get_posts($relatedposts);
$context['right_sidebar_1'] = Timber::get_widgets('right_sidebar_1');

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
