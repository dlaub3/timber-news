<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();

$categories = get_the_category();
$sticky = get_option( 'sticky_posts' );
$current_post_id = $post->ID;
$relatedposts = array(
	'category_name' => $categories,
	'ignore_sticky_posts' => 1,
	'post__not_in' => array( $sticky, $current_post_id),
	'posts_per_page' => 8,
	'meta_query' => array(array('key' => '_thumbnail_id'))
);
$context['relatedposts'] = Timber::get_posts($relatedposts);
$context['right_sidebar_1'] = Timber::get_widgets('right_sidebar_1');

$post = new TimberPost();
$context['post'] = $post;
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );
