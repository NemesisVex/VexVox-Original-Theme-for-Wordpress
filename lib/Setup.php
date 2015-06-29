<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 9:31 PM
 */

namespace VigilantMedia\WordPress\Themes\VexVox;


class Setup {

	public function __construct() {

	}

	public static function init() {
		add_filter( 'wp_page_menu_args', array( __CLASS__, 'wp_page_menu_args' ) );

		add_filter( 'wp_title', array( __CLASS__, 'wp_title' ), 10, 2 );

		add_action( 'after_setup_theme', array( __CLASS__, 'after_setup_theme' ) );

		add_action( 'widgets_init', array( __CLASS__, 'widgets_init' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_scripts' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_styles' ), 20 );
	}

	public static function after_setup_theme() {
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );


	}

	public static function widgets_init() {
		register_widget( __NAMESPACE__ . '\Widgets\About' );
		register_widget( __NAMESPACE__ . '\Widgets\YearlyArchive' );

		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Main sidebar that appears on the left.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Content Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Additional sidebar that appears on the right.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer Widget Area', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears in the footer section of the site.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}

	public static function wp_enqueue_scripts() {
		wp_enqueue_script( 'bootstrap-js', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array( 'jquery' ) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	public static function wp_enqueue_styles() {
		wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css' );

		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.2' );

		wp_enqueue_style( WP_TEXT_DOMAIN, get_stylesheet_uri() );
	}

	public static function wp_page_menu_args( $args ) {
		$args['show_home'] = false;
		$args['container'] = false;
		$args['menu_class'] = 'nav navbar-nav';
		return $args;
	}

	public static function wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', WP_TEXT_DOMAIN ), max( $paged, $page ) );
		}

		return $title;
	}
}