<?php
/**
 * VexVox functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.1
 */

require get_template_directory() . '/lib/VexVox_Filters.php';
require get_template_directory() . '/lib/VexVox_Template_Tags.php';

add_filter( 'wp_page_menu_args', array( 'VexVox_Filters', 'wp_page_menu_args' ) );

add_filter( 'wp_title', array( 'VexVox_Filters', 'wp_title' ), 10, 2 );

add_action( 'after_setup_theme', array( 'VexVox_Filters', 'after_setup_theme' ) );

add_action( 'widgets_init', array( 'VexVox_Filters', 'widgets_init' ) );

add_action( 'wp_enqueue_scripts', array( 'VexVox_Filters', 'wp_enqueue_scripts' ) );
