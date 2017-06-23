<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
$data['right_sidebar_1'] = Timber::get_widgets('right_sidebar_1');

Timber::render( array( 'sidebar.twig' ), $data );
