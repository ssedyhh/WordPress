<?php
/**
 * WordPress Query API
 *
 * The query API attempts to get which part of WordPress the user is on. It
 * also provides functionality for getting URL query information.
 *
 * @link https://codex.wordpress.org/The_Loop More information on The Loop.
 *
 * @package WordPress
 * @subpackage Query
 */

/**
 * Retrieve variable in the WP_Query class.
 *
 * @since 1.5.0
 * @since 3.9.0 The `$default` argument was introduced.
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string $var       The variable key to retrieve.
 * @param mixed  $default   Optional. Value to return if the query variable is not set. Default empty.
 * @return mixed Contents of the query variable.
 */
function get_query_var( $var, $default = '' ) {
	global $wp_query;
	return $wp_query->get( $var, $default );
}

/**
 * Retrieve the currently-queried object.
 *
 * Wrapper for WP_Query::get_queried_object().
 *
 * @since 3.1.0
 * @access public
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return object Queried object.
 */
function get_queried_object() {
	global $wp_query;
	return $wp_query->get_queried_object();
}

/**
 * Retrieve ID of the current queried object.
 *
 * Wrapper for WP_Query::get_queried_object_id().
 *
 * @since 3.1.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return int ID of the queried object.
 */
function get_queried_object_id() {
	global $wp_query;
	return $wp_query->get_queried_object_id();
}

/**
 * Set query variable.
 *
 * @since 2.2.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string $var   Query variable key.
 * @param mixed  $value Query variable value.
 */
function set_query_var( $var, $value ) {
	global $wp_query;
	$wp_query->set( $var, $value );
}

/**
 * Sets up The Loop with query parameters.
 *
 * Note: This function will completely override the main query and isn't intended for use
 * by plugins or themes. Its overly-simplistic approach to modifying the main query can be
 * problematic and should be avoided wherever possible. In most cases, there are better,
 * more performant options for modifying the main query such as via the {@see 'pre_get_posts'}
 * action within WP_Query.
 *
 * This must not be used within the WordPress Loop.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param array|string $query Array or string of WP_Query arguments.
 * @return array List of post objects.
 */
function query_posts($query) {
	$GLOBALS['wp_query'] = new WP_Query();
	return $GLOBALS['wp_query']->query($query);
}

/**
 * Destroys the previous query and sets up a new query.
 *
 * This should be used after query_posts() and before another query_posts().
 * This will remove obscure bugs that occur when the previous WP_Query object
 * is not destroyed properly before another is set up.
 *
 * @since 2.3.0
 *
 * @global WP_Query $wp_query     Global WP_Query instance.
 * @global WP_Query $wp_the_query Copy of the global WP_Query instance created during wp_reset_query().
 */
function wp_reset_query() {
	$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
	wp_reset_postdata();
}

/**
 * After looping through a separate query, this function restores
 * the $post global to the current post in the main query.
 *
 * @since 3.0.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 */
<<<<<<< HEAD
function wp_reset_postdata() {
	global $wp_query;

	if ( isset( $wp_query ) ) {
		$wp_query->reset_postdata();
	}
=======

function is_admin () {
	if ( defined('WP_ADMIN') ) 
		return WP_ADMIN;
	return false;
>>>>>>> origin/2.3-branch
}

/*
 * Query type checks.
 */

/**
 * Is the query for an existing archive page?
 *
 * Month, Year, Category, Author, Post Type archive...
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_archive() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_archive();
}

/**
 * Is the query for an existing post type archive page?
 *
 * @since 3.1.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string|array $post_types Optional. Post type or array of posts types to check against.
 * @return bool
 */
function is_post_type_archive( $post_types = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_post_type_archive( $post_types );
}

/**
 * Is the query for an existing attachment page?
 *
 * @since 2.0.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param int|string|array|object $attachment Attachment ID, title, slug, or array of such.
 * @return bool
 */
function is_attachment( $attachment = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_attachment( $attachment );
}

/**
 * Is the query for an existing author archive page?
 *
 * If the $author parameter is specified, this function will additionally
 * check if the query is for one of the authors specified.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param mixed $author Optional. User ID, nickname, nicename, or array of User IDs, nicknames, and nicenames
 * @return bool
 */
function is_author( $author = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_author( $author );
}

/**
 * Is the query for an existing category archive page?
 *
 * If the $category parameter is specified, this function will additionally
 * check if the query is for one of the categories specified.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param mixed $category Optional. Category ID, name, slug, or array of Category IDs, names, and slugs.
 * @return bool
 */
function is_category( $category = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_category( $category );
}

/**
 * Is the query for an existing tag archive page?
 *
 * If the $tag parameter is specified, this function will additionally
 * check if the query is for one of the tags specified.
 *
 * @since 2.3.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param mixed $tag Optional. Tag ID, name, slug, or array of Tag IDs, names, and slugs.
 * @return bool
 */
function is_tag( $tag = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_tag( $tag );
}

/**
 * Is the query for an existing custom taxonomy archive page?
 *
 * If the $taxonomy parameter is specified, this function will additionally
 * check if the query is for that specific $taxonomy.
 *
 * If the $term parameter is specified in addition to the $taxonomy parameter,
 * this function will additionally check if the query is for one of the terms
 * specified.
 *
 * @since 2.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string|array     $taxonomy Optional. Taxonomy slug or slugs.
 * @param int|string|array $term     Optional. Term ID, name, slug or array of Term IDs, names, and slugs.
 * @return bool True for custom taxonomy archive pages, false for built-in taxonomies (category and tag archives).
 */
function is_tax( $taxonomy = '', $term = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_tax( $taxonomy, $term );
}

/**
 * Is the query for an existing date archive?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_date() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_date();
}

/**
 * Is the query for an existing day archive?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_day() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_day();
}

/**
 * Is the query for a feed?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string|array $feeds Optional feed types to check.
 * @return bool
 */
function is_feed( $feeds = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_feed( $feeds );
}

/**
 * Is the query for a comments feed?
 *
 * @since 3.0.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_comment_feed() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_comment_feed();
}

/**
 * Is the query for the front page of the site?
 *
 * This is for what is displayed at your site's main URL.
 *
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_on_front'.
 *
 * If you set a static page for the front page of your site, this function will return
 * true when viewing that page.
 *
 * Otherwise the same as @see is_home()
 *
 * @since 2.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool True, if front of site.
 */
function is_front_page() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_front_page();
}

/**
 * Determines if the query is for the blog homepage.
 *
 * The blog homepage is the page that shows the time-based blog content of the site.
 *
 * is_home() is dependent on the site's "Front page displays" Reading Settings 'show_on_front'
 * and 'page_for_posts'.
 *
 * If a static page is set for the front page of the site, this function will return true only
 * on the page you set as the "Posts page".
 *
 * @since 1.5.0
 *
 * @see is_front_page()
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool True if blog view homepage, otherwise false.
 */
function is_home() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_home();
}

/**
 * Is the query for an existing month archive?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_month() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_month();
}

/**
 * Is the query for an existing single page?
 *
 * If the $page parameter is specified, this function will additionally
 * check if the query is for one of the pages specified.
 *
 * @see is_single()
 * @see is_singular()
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param int|string|array $page Optional. Page ID, title, slug, or array of such. Default empty.
 * @return bool Whether the query is for an existing single page.
 */
function is_page( $page = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_page( $page );
}

/**
 * Is the query for paged result and not for the first page?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_paged() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_paged();
}

/**
 * Is the query for a post or page preview?
 *
 * @since 2.0.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_preview() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_preview();
}

/**
 * Is the query for the robots file?
 *
 * @since 2.1.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_robots() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_robots();
}

/**
 * Is the query for a search?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_search() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_search();
}

/**
 * Is the query for an existing single post?
 *
 * Works for any post type, except attachments and pages
 *
 * If the $post parameter is specified, this function will additionally
 * check if the query is for one of the Posts specified.
 *
 * @see is_page()
 * @see is_singular()
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param int|string|array $post Optional. Post ID, title, slug, or array of such. Default empty.
 * @return bool Whether the query is for an existing single post.
 */
function is_single( $post = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_single( $post );
}

/**
 * Is the query for an existing single post of any post type (post, attachment, page,
 * custom post types)?
 *
 * If the $post_types parameter is specified, this function will additionally
 * check if the query is for one of the Posts Types specified.
 *
 * @see is_page()
 * @see is_single()
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param string|array $post_types Optional. Post type or array of post types. Default empty.
 * @return bool Whether the query is for an existing single post of any of the given post types.
 */
function is_singular( $post_types = '' ) {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_singular( $post_types );
}

/**
 * Is the query for a specific time?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_time() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_time();
}

/**
 * Is the query for a trackback endpoint call?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_trackback() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_trackback();
}

/**
 * Is the query for an existing year archive?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_year() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_year();
}

/**
 * Is the query a 404 (returns no results)?
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_404() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_404();
}

/**
 * Is the query for an embedded post?
 *
 * @since 4.4.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool Whether we're in an embedded post or not.
 */
function is_embed() {
	global $wp_query;

	if ( ! isset( $wp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $wp_query->is_embed();
}

/**
 * Is the query the main query?
 *
 * @since 3.3.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function is_main_query() {
	if ( 'pre_get_posts' === current_filter() ) {
		$message = sprintf(
			/* translators: 1: pre_get_posts 2: WP_Query->is_main_query() 3: is_main_query() 4: link to codex is_main_query() page. */
			__( 'In %1$s, use the %2$s method, not the %3$s function. See %4$s.' ),
			'<code>pre_get_posts</code>',
			'<code>WP_Query->is_main_query()</code>',
			'<code>is_main_query()</code>',
			__( 'https://codex.wordpress.org/Function_Reference/is_main_query' )
		);
		_doing_it_wrong( __FUNCTION__, $message, '3.7.0' );
	}

	global $wp_query;
	return $wp_query->is_main_query();
}

/*
 * The Loop. Post loop control.
 */

/**
 * Whether current WordPress query has results to loop over.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function have_posts() {
	global $wp_query;
	return $wp_query->have_posts();
}

/**
 * Whether the caller is in the Loop.
 *
 * @since 2.0.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool True if caller is within loop, false if loop hasn't started or ended.
 */
function in_the_loop() {
	global $wp_query;
	return $wp_query->in_the_loop;
}

/**
 * Rewind the loop posts.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 */
function rewind_posts() {
	global $wp_query;
	$wp_query->rewind_posts();
}

/**
 * Iterate the post index in the loop.
 *
 * @since 1.5.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 */
function the_post() {
	global $wp_query;
	$wp_query->the_post();
}

/*
 * Comments loop.
 */

/**
 * Whether there are comments to loop over.
 *
 * @since 2.2.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return bool
 */
function have_comments() {
	global $wp_query;
	return $wp_query->have_comments();
}

/**
 * Iterate comment index in the comment loop.
 *
 * @since 2.2.0
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @return object
 */
function the_comment() {
	global $wp_query;
	return $wp_query->the_comment();
}

/**
 * Redirect old slugs to the correct permalink.
 *
 * Attempts to find the current slug from the past slugs.
 *
 * @since 2.1.0
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 */
function wp_old_slug_redirect() {
	if ( is_404() && '' !== get_query_var( 'name' ) ) {
		global $wpdb;

<<<<<<< HEAD
		// Guess the current post_type based on the query vars.
		if ( get_query_var( 'post_type' ) ) {
			$post_type = get_query_var( 'post_type' );
		} elseif ( get_query_var( 'attachment' ) ) {
			$post_type = 'attachment';
		} elseif ( get_query_var( 'pagename' ) ) {
			$post_type = 'page';
=======
class WP_Query {
	var $query;
	var $query_vars = array();
	var $queried_object;
	var $queried_object_id;
	var $request;

	var $posts;
	var $post_count = 0;
	var $current_post = -1;
	var $in_the_loop = false;
	var $post;

	var $comments;
	var $comment_count = 0;
	var $current_comment = -1;
	var $comment;

	var $found_posts = 0;
	var $max_num_pages = 0;

	var $is_single = false;
	var $is_preview = false;
	var $is_page = false;
	var $is_archive = false;
	var $is_date = false;
	var $is_year = false;
	var $is_month = false;
	var $is_day = false;
	var $is_time = false;
	var $is_author = false;
	var $is_category = false;
	var $is_tag = false;
	var $is_search = false;
	var $is_feed = false;
	var $is_comment_feed = false;
	var $is_trackback = false;
	var $is_home = false;
	var $is_404 = false;
	var $is_comments_popup = false;
	var $is_admin = false;
	var $is_attachment = false;
	var $is_singular = false;
	var $is_robots = false;
	var $is_posts_page = false;

	function init_query_flags() {
		$this->is_single = false;
		$this->is_page = false;
		$this->is_archive = false;
		$this->is_date = false;
		$this->is_year = false;
		$this->is_month = false;
		$this->is_day = false;
		$this->is_time = false;
		$this->is_author = false;
		$this->is_category = false;
		$this->is_tag = false;
		$this->is_search = false;
		$this->is_feed = false;
		$this->is_comment_feed = false;
		$this->is_trackback = false;
		$this->is_home = false;
		$this->is_404 = false;
		$this->is_paged = false;
		$this->is_admin = false;
		$this->is_attachment = false;
		$this->is_singular = false;
		$this->is_robots = false;
		$this->is_posts_page = false;
	}

	function init () {
		unset($this->posts);
		unset($this->query);
		$this->query_vars = array();
		unset($this->queried_object);
		unset($this->queried_object_id);
		$this->post_count = 0;
		$this->current_post = -1;
		$this->in_the_loop = false;

		$this->init_query_flags();
	}

	// Reparse the query vars.
	function parse_query_vars() {
		$this->parse_query('');
	}

	function fill_query_vars($array) {
		$keys = array(
			'error'
			, 'm'
			, 'p'
			, 'subpost'
			, 'subpost_id'
			, 'attachment'
			, 'attachment_id'
			, 'name'
			, 'hour'
			, 'static'
			, 'pagename'
			, 'page_id'
			, 'second'
			, 'minute'
			, 'hour'
			, 'day'
			, 'monthnum'
			, 'year'
			, 'w'
			, 'category_name'
			, 'tag'
			, 'tag_id'
			, 'author_name'
			, 'feed'
			, 'tb'
			, 'paged'
			, 'comments_popup'
			, 'preview'
		);

		foreach ($keys as $key) {
			if ( !isset($array[$key]))
				$array[$key] = '';
		}

		$array_keys = array('category__in', 'category__not_in', 'category__and',
			'tag__in', 'tag__not_in', 'tag__and', 'tag_slug__in', 'tag_slug__and');

		foreach ( $array_keys as $key ) {
			if ( !isset($array[$key]))
				$array[$key] = array();
		}
		return $array;
	}

	// Parse a query string and set query type booleans.
	function parse_query ($query) {
		if ( !empty($query) || !isset($this->query) ) {
			$this->init();
			if ( is_array($query) )
				$this->query_vars = $query;
			else
				parse_str($query, $this->query_vars);
			$this->query = $query;
		}

		$this->query_vars = $this->fill_query_vars($this->query_vars);
		$qv = &$this->query_vars;

		if ( ! empty($qv['robots']) )
			$this->is_robots = true;

		$qv['p'] =  (int) $qv['p'];
		$qv['page_id'] =  (int) $qv['page_id'];
		$qv['year'] = (int) $qv['year'];
		$qv['monthnum'] = (int) $qv['monthnum'];
		$qv['day'] = (int) $qv['day'];
		$qv['w'] = (int) $qv['w'];
		$qv['m'] =  (int) $qv['m'];
		if ( '' !== $qv['hour'] ) $qv['hour'] = (int) $qv['hour'];
		if ( '' !== $qv['minute'] ) $qv['minute'] = (int) $qv['minute'];
		if ( '' !== $qv['second'] ) $qv['second'] = (int) $qv['second'];

		// Compat.  Map subpost to attachment.
		if ( '' != $qv['subpost'] )
			$qv['attachment'] = $qv['subpost'];
		if ( '' != $qv['subpost_id'] )
			$qv['attachment_id'] = $qv['subpost_id'];

		$qv['attachment_id'] = (int) $qv['attachment_id'];

		if ( ('' != $qv['attachment']) || !empty($qv['attachment_id']) ) {
			$this->is_single = true;
			$this->is_attachment = true;
		} elseif ( '' != $qv['name'] ) {
			$this->is_single = true;
		} elseif ( $qv['p'] ) {
			$this->is_single = true;
		} elseif ( ('' !== $qv['hour']) && ('' !== $qv['minute']) &&('' !== $qv['second']) && ('' != $qv['year']) && ('' != $qv['monthnum']) && ('' != $qv['day']) ) {
			// If year, month, day, hour, minute, and second are set, a single
			// post is being queried.
			$this->is_single = true;
		} elseif ( '' != $qv['static'] || '' != $qv['pagename'] || !empty($qv['page_id']) ) {
			$this->is_page = true;
			$this->is_single = false;
		} elseif ( !empty($qv['s']) ) {
			$this->is_search = true;
		} else {
		// Look for archive queries.  Dates, categories, authors.

			if ( '' !== $qv['second'] ) {
				$this->is_time = true;
				$this->is_date = true;
			}

			if ( '' !== $qv['minute'] ) {
				$this->is_time = true;
				$this->is_date = true;
			}

			if ( '' !== $qv['hour'] ) {
				$this->is_time = true;
				$this->is_date = true;
			}

			if ( $qv['day'] ) {
				if (! $this->is_date) {
					$this->is_day = true;
					$this->is_date = true;
				}
			}

			if ( $qv['monthnum'] ) {
				if (! $this->is_date) {
					$this->is_month = true;
					$this->is_date = true;
				}
			}

			if ( $qv['year'] ) {
				if (! $this->is_date) {
					$this->is_year = true;
					$this->is_date = true;
				}
			}

			if ( $qv['m'] ) {
				$this->is_date = true;
				if (strlen($qv['m']) > 9) {
					$this->is_time = true;
				} else if (strlen($qv['m']) > 7) {
					$this->is_day = true;
				} else if (strlen($qv['m']) > 5) {
					$this->is_month = true;
				} else {
					$this->is_year = true;
				}
			}

			if ('' != $qv['w']) {
				$this->is_date = true;
			}

			if ( empty($qv['cat']) || ($qv['cat'] == '0') ) {
				$this->is_category = false;
			} else {
				if (strpos($qv['cat'], '-') !== false) {
					$this->is_category = false;
				} else {
					$this->is_category = true;
				}
			}

			if ( '' != $qv['category_name'] ) {
				$this->is_category = true;
			}

			if ( !is_array($qv['category__in']) || empty($qv['category__in']) ) {
				$qv['category__in'] = array();
			} else {
				$qv['category__in'] = array_map('intval', $qv['category__in']);
				$this->is_category = true;
			}

			if ( !is_array($qv['category__not_in']) || empty($qv['category__not_in']) ) {
				$qv['category__not_in'] = array();
			} else {
				$qv['category__not_in'] = array_map('intval', $qv['category__not_in']);
			}

			if ( !is_array($qv['category__and']) || empty($qv['category__and']) ) {
				$qv['category__and'] = array();
			} else {
				$qv['category__and'] = array_map('intval', $qv['category__and']);
				$this->is_category = true;
			}

			if (  '' != $qv['tag'] )
				$this->is_tag = true;

			$qv['tag_id'] = (int) $qv['tag_id'];
			if (  !empty($qv['tag_id']) )
				$this->is_tag = true;

			if ( !is_array($qv['tag__in']) || empty($qv['tag__in']) ) {
				$qv['tag__in'] = array();
			} else {
				$qv['tag__in'] = array_map('intval', $qv['tag__in']);
				$this->is_tag = true;
			}

			if ( !is_array($qv['tag__not_in']) || empty($qv['tag__not_in']) ) {
				$qv['tag__not_in'] = array();
			} else {
				$qv['tag__not_in'] = array_map('intval', $qv['tag__not_in']);
			}

			if ( !is_array($qv['tag__and']) || empty($qv['tag__and']) ) {
				$qv['tag__and'] = array();
			} else {
				$qv['tag__and'] = array_map('intval', $qv['tag__and']);
				$this->is_category = true;
			}

			if ( !is_array($qv['tag_slug__in']) || empty($qv['tag_slug__in']) ) {
				$qv['tag_slug__in'] = array();
			} else {
				$qv['tag_slug__in'] = array_map('sanitize_title', $qv['tag_slug__in']);
				$this->is_tag = true;
			}

			if ( !is_array($qv['tag_slug__and']) || empty($qv['tag_slug__and']) ) {
				$qv['tag_slug__and'] = array();
			} else {
				$qv['tag_slug__and'] = array_map('sanitize_title', $qv['tag_slug__and']);
				$this->is_tag = true;
			}

			if ( empty($qv['author']) || ($qv['author'] == '0') ) {
				$this->is_author = false;
			} else {
				$this->is_author = true;
			}

			if ( '' != $qv['author_name'] ) {
				$this->is_author = true;
			}

			if ( ($this->is_date || $this->is_author || $this->is_category || $this->is_tag ) )
				$this->is_archive = true;
		}

		if ( '' != $qv['feed'] )
			$this->is_feed = true;

		if ( '' != $qv['tb'] )
			$this->is_trackback = true;

		if ( '' != $qv['paged'] )
			$this->is_paged = true;

		if ( '' != $qv['comments_popup'] )
			$this->is_comments_popup = true;

		// if we're previewing inside the write screen
		if ('' != $qv['preview'])
			$this->is_preview = true;

		if ( is_admin() )
			$this->is_admin = true;

		if ( false !== strpos($qv['feed'], 'comments-') ) {
			$qv['feed'] = str_replace('comments-', '', $qv['feed']);
			$qv['withcomments'] = 1;
		}

		$this->is_singular = $this->is_single || $this->is_page || $this->is_attachment;

		if ( $this->is_feed && ( !empty($qv['withcomments']) || ( empty($qv['withoutcomments']) && $this->is_singular ) ) )
			$this->is_comment_feed = true;

		if ( !( $this->is_singular || $this->is_archive || $this->is_search || $this->is_feed || $this->is_trackback || $this->is_404 || $this->is_admin || $this->is_comments_popup ) )
			$this->is_home = true;

		// Correct is_* for page_on_front and page_for_posts
		if ( $this->is_home && ( empty($this->query) || $qv['preview'] == 'true' ) && 'page' == get_option('show_on_front') && get_option('page_on_front') ) {
			$this->is_page = true;
			$this->is_home = false;
			$qv['page_id'] = get_option('page_on_front');
		}

		if ( '' != $qv['pagename'] ) {
			$this->queried_object =& get_page_by_path($qv['pagename']);
			if ( !empty($this->queried_object) )
				$this->queried_object_id = (int) $this->queried_object->ID;
			else
				unset($this->queried_object);

			if  ( 'page' == get_option('show_on_front') && isset($this->queried_object_id) && $this->queried_object_id == get_option('page_for_posts') ) {
				$this->is_page = false;
				$this->is_home = true;
				$this->is_posts_page = true;
			}
		}

		if ( $qv['page_id'] ) {
			if  ( 'page' == get_option('show_on_front') && $qv['page_id'] == get_option('page_for_posts') ) {
				$this->is_page = false;
				$this->is_home = true;
				$this->is_posts_page = true;
			}
		}

		if ( !empty($qv['post_type']) )
			$qv['post_type'] = sanitize_user($qv['post_type'], true);

		if ( !empty($qv['post_status']) )
			$qv['post_status'] = sanitize_user($qv['post_status'], true);

		if ( $this->is_posts_page && !$qv['withcomments'] )
			$this->is_comment_feed = false;

		$this->is_singular = $this->is_single || $this->is_page || $this->is_attachment;
		// Done correcting is_* for page_on_front and page_for_posts

		if ('404' == $qv['error'])
			$this->set_404();

		if ( !empty($query) )
			do_action_ref_array('parse_query', array(&$this));
	}

	function set_404() {
		$is_feed = $this->is_feed;

		$this->init_query_flags();
		$this->is_404 = true;

		$this->is_feed = $is_feed;
	}

	function get($query_var) {
		if (isset($this->query_vars[$query_var])) {
			return $this->query_vars[$query_var];
		}

		return '';
	}

	function set($query_var, $value) {
		$this->query_vars[$query_var] = $value;
	}

	function &get_posts() {
		global $wpdb, $pagenow, $user_ID;

		do_action_ref_array('pre_get_posts', array(&$this));

		// Shorthand.
		$q = &$this->query_vars;

		$q = $this->fill_query_vars($q);

		// First let's clear some variables
		$distinct = '';
		$whichcat = '';
		$whichauthor = '';
		$whichpage = '';
		$result = '';
		$where = '';
		$limits = '';
		$join = '';
		$search = '';
		$groupby = '';

		if ( !isset($q['post_type']) )
			$q['post_type'] = 'post';
		$post_type = $q['post_type'];
		if ( !isset($q['posts_per_page']) || $q['posts_per_page'] == 0 )
			$q['posts_per_page'] = get_option('posts_per_page');
		if ( isset($q['showposts']) && $q['showposts'] ) {
			$q['showposts'] = (int) $q['showposts'];
			$q['posts_per_page'] = $q['showposts'];
		}
		if ( (isset($q['posts_per_archive_page']) && $q['posts_per_archive_page'] != 0) && ($this->is_archive || $this->is_search) )
			$q['posts_per_page'] = $q['posts_per_archive_page'];
		if ( !isset($q['nopaging']) ) {
			if ($q['posts_per_page'] == -1) {
				$q['nopaging'] = true;
			} else {
				$q['nopaging'] = false;
			}
		}
		if ( $this->is_feed ) {
			$q['posts_per_page'] = get_option('posts_per_rss');
			$q['nopaging'] = false;
		}
		$q['posts_per_page'] = (int) $q['posts_per_page'];
		if ( $q['posts_per_page'] < -1 )
			$q['posts_per_page'] = abs($q['posts_per_page']);
		else if ( $q['posts_per_page'] == 0 )
			$q['posts_per_page'] = 1;

		if ( $this->is_home && (empty($this->query) || $q['preview'] == 'true') && ( 'page' == get_option('show_on_front') ) && get_option('page_on_front') ) {
			$this->is_page = true;
			$this->is_home = false;
			$q['page_id'] = get_option('page_on_front');
		}

		if (isset($q['page'])) {
			$q['page'] = trim($q['page'], '/');
			$q['page'] = (int) $q['page'];
			$q['page'] = abs($q['page']);
		}

		$add_hours = intval(get_option('gmt_offset'));
		$add_minutes = intval(60 * (get_option('gmt_offset') - $add_hours));
		$wp_posts_post_date_field = "post_date"; // "DATE_ADD(post_date, INTERVAL '$add_hours:$add_minutes' HOUR_MINUTE)";

		// If a month is specified in the querystring, load that month
		if ( $q['m'] ) {
			$q['m'] = '' . preg_replace('|[^0-9]|', '', $q['m']);
			$where .= ' AND YEAR(post_date)=' . substr($q['m'], 0, 4);
			if (strlen($q['m'])>5)
				$where .= ' AND MONTH(post_date)=' . substr($q['m'], 4, 2);
			if (strlen($q['m'])>7)
				$where .= ' AND DAYOFMONTH(post_date)=' . substr($q['m'], 6, 2);
			if (strlen($q['m'])>9)
				$where .= ' AND HOUR(post_date)=' . substr($q['m'], 8, 2);
			if (strlen($q['m'])>11)
				$where .= ' AND MINUTE(post_date)=' . substr($q['m'], 10, 2);
			if (strlen($q['m'])>13)
				$where .= ' AND SECOND(post_date)=' . substr($q['m'], 12, 2);
		}

		if ( '' !== $q['hour'] )
			$where .= " AND HOUR(post_date)='" . $q['hour'] . "'";

		if ( '' !== $q['minute'] )
			$where .= " AND MINUTE(post_date)='" . $q['minute'] . "'";

		if ( '' !== $q['second'] )
			$where .= " AND SECOND(post_date)='" . $q['second'] . "'";

		if ( $q['year'] )
			$where .= " AND YEAR(post_date)='" . $q['year'] . "'";

		if ( $q['monthnum'] )
			$where .= " AND MONTH(post_date)='" . $q['monthnum'] . "'";

		if ( $q['day'] )
			$where .= " AND DAYOFMONTH(post_date)='" . $q['day'] . "'";

		if ('' != $q['name']) {
			$q['name'] = sanitize_title($q['name']);
			$where .= " AND post_name = '" . $q['name'] . "'";
		} else if ('' != $q['pagename']) {
			if ( isset($this->queried_object_id) )
				$reqpage = $this->queried_object_id;
			else {
				$reqpage = get_page_by_path($q['pagename']);
				if ( !empty($reqpage) )
					$reqpage = $reqpage->ID;
				else
					$reqpage = 0;
			}

			if  ( ('page' != get_option('show_on_front') ) || ( $reqpage != get_option('page_for_posts') ) ) {
				$q['pagename'] = str_replace('%2F', '/', urlencode(urldecode($q['pagename'])));
				$page_paths = '/' . trim($q['pagename'], '/');
				$q['pagename'] = sanitize_title(basename($page_paths));
				$q['name'] = $q['pagename'];
				$where .= " AND (ID = '$reqpage')";
			}
		} elseif ('' != $q['attachment']) {
			$q['attachment'] = str_replace('%2F', '/', urlencode(urldecode($q['attachment'])));
			$attach_paths = '/' . trim($q['attachment'], '/');
			$q['attachment'] = sanitize_title(basename($attach_paths));
			$q['name'] = $q['attachment'];
			$where .= " AND post_name = '" . $q['attachment'] . "'";
		}

		if ( $q['w'] )
			$where .= " AND WEEK(post_date, 1)='" . $q['w'] . "'";

		if ( intval($q['comments_popup']) )
			$q['p'] = intval($q['comments_popup']);

		// If an attachment is requested by number, let it supercede any post number.
		if ( $q['attachment_id'] )
			$q['p'] = $q['attachment_id'];

		// If a post number is specified, load that post
		if ( $q['p'] )
			$where = ' AND ID = ' . $q['p'];

		if ( $q['page_id'] ) {
			if  ( ('page' != get_option('show_on_front') ) || ( $q['page_id'] != get_option('page_for_posts') ) ) {
				$q['p'] = $q['page_id'];
				$where = ' AND ID = ' . $q['page_id'];
			}
		}

		// If a search pattern is specified, load the posts that match
		if ( !empty($q['s']) ) {
			// added slashes screw with quote grouping when done early, so done later
			$q['s'] = stripslashes($q['s']);
			if ($q['sentence']) {
				$q['search_terms'] = array($q['s']);
			}
			else {
				preg_match_all('/".*?("|$)|((?<=[\\s",+])|^)[^\\s",+]+/', $q[s], $matches);
				$q['search_terms'] = array_map(create_function('$a', 'return trim($a, "\\"\'\\n\\r ");'), $matches[0]);
			}
			$n = ($q['exact']) ? '' : '%';
			$searchand = '';
			foreach((array)$q['search_terms'] as $term) {
				$term = addslashes_gpc($term);
				$search .= "{$searchand}((post_title LIKE '{$n}{$term}{$n}') OR (post_content LIKE '{$n}{$term}{$n}'))";
				$searchand = ' AND ';
			}
			$term = addslashes_gpc($q['s']);
			if (!$q['sentence'] && count($q['search_terms']) > 1 && $q['search_terms'][0] != $q['s'] )
				$search .= " OR (post_title LIKE '{$n}{$term}{$n}') OR (post_content LIKE '{$n}{$term}{$n}')";

			if ( !empty($search) )
				$search = " AND ({$search}) ";
		}

		// Category stuff

		if ( empty($q['cat']) || ($q['cat'] == '0') ||
				// Bypass cat checks if fetching specific posts
				$this->is_singular ) {
			$whichcat = '';
		} else {
			$q['cat'] = ''.urldecode($q['cat']).'';
			$q['cat'] = addslashes_gpc($q['cat']);
			$cat_array = preg_split('/[,\s]+/', $q['cat']);
			foreach ( $cat_array as $cat ) {
				$cat = intval($cat);
				$in = ($cat > 0);
				$cat = abs($cat);
				if ( $in ) {
					$q['category__in'][] = $cat;
					$q['category__in'] = array_merge($q['category__in'], get_term_children($cat, 'category'));
				} else {
					$q['category__not_in'][] = $cat;
					$q['category__not_in'] = array_merge($q['category__not_in'], get_term_children($cat, 'category'));
				}
			}
		}

		if ( !empty($q['category__in']) || !empty($q['category__not_in']) || !empty($q['category__and']) ) {
			$groupby = "{$wpdb->posts}.ID";
		}

		if ( !empty($q['category__in']) ) {
			$join = " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ";
			$whichcat .= " AND $wpdb->term_taxonomy.taxonomy = 'category' ";
			$include_cats = "'" . implode("', '", $q['category__in']) . "'";
			$whichcat .= " AND $wpdb->term_taxonomy.term_id IN ($include_cats) ";
		}

		if ( !empty($q['category__not_in']) ) {
			$ids = get_objects_in_term($q['category__not_in'], 'category');
			if ( is_wp_error( $ids ) ) 
				return $ids;
			if ( is_array($ids) && count($ids > 0) ) {
				$out_posts = "'" . implode("', '", $ids) . "'";
				$whichcat .= " AND $wpdb->posts.ID NOT IN ($out_posts)";
			}
		}

		// Category stuff for nice URLs
		if ( '' != $q['category_name'] ) {
			$reqcat = get_category_by_path($q['category_name']);
			$q['category_name'] = str_replace('%2F', '/', urlencode(urldecode($q['category_name'])));
			$cat_paths = '/' . trim($q['category_name'], '/');
			$q['category_name'] = sanitize_title(basename($cat_paths));

			$cat_paths = '/' . trim(urldecode($q['category_name']), '/');
			$q['category_name'] = sanitize_title(basename($cat_paths));
			$cat_paths = explode('/', $cat_paths);
			$cat_path = '';
			foreach ( (array) $cat_paths as $pathdir )
				$cat_path .= ( $pathdir != '' ? '/' : '' ) . sanitize_title($pathdir);

			//if we don't match the entire hierarchy fallback on just matching the nicename
			if ( empty($reqcat) )
				$reqcat = get_category_by_path($q['category_name'], false);

			if ( !empty($reqcat) )
				$reqcat = $reqcat->term_id;
			else
				$reqcat = 0;

			$q['cat'] = $reqcat;

			$join = " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ";
			$whichcat = " AND $wpdb->term_taxonomy.taxonomy = 'category' ";
			$in_cats = array($q['cat']);
			$in_cats = array_merge($in_cats, get_term_children($q['cat'], 'category'));
			$in_cats = "'" . implode("', '", $in_cats) . "'";
			$whichcat .= "AND $wpdb->term_taxonomy.term_id IN ($in_cats)";
			$groupby = "{$wpdb->posts}.ID";
		}

		// Tags
		if ( '' != $q['tag'] ) {
			if ( strpos($q['tag'], ',') !== false ) {
				$tags = preg_split('/[,\s]+/', $q['tag']);
				foreach ( (array) $tags as $tag ) {
					$tag = sanitize_term_field('slug', $tag, 0, 'post_tag', 'db');
					$q['tag_slug__in'][] = $tag;
				}
			} else if ( preg_match('/[+\s]+/', $q['tag']) ) {
				$tags = preg_split('/[+\s]+/', $q['tag']);
				foreach ( (array) $tags as $tag ) {
					$tag = sanitize_term_field('slug', $tag, 0, 'post_tag', 'db');
					$q['tag_slug__and'][] = $tag;
				}
			} else {
				$q['tag'] = sanitize_term_field('slug', $q['tag'], 0, 'post_tag', 'db');
				$reqtag = is_term( $q['tag'], 'post_tag' );
				if ( !empty($reqtag) )
					$reqtag = $reqtag['term_id'];
				else
					$reqtag = 0;

				$q['tag_id'] = $reqtag;
				$q['tag__in'][] = $reqtag;
			}
		}

		if ( !empty($q['tag__in']) || !empty($q['tag__not_in']) || !empty($q['tag__and']) ||
			!empty($q['tag_slug__in']) || !empty($q['tag_slug__and']) ) {
			$groupby = "{$wpdb->posts}.ID";
		}

		if ( !empty($q['tag__in']) ) {
			$join = " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) ";
			$whichcat .= " AND $wpdb->term_taxonomy.taxonomy = 'post_tag' ";
			$include_tags = "'" . implode("', '", $q['tag__in']) . "'";
			$whichcat .= " AND $wpdb->term_taxonomy.term_id IN ($include_tags) ";
			$reqtag = is_term( $q['tag__in'][0], 'post_tag' );
			if ( !empty($reqtag) )
				$q['tag_id'] = $reqtag['term_id'];
		}

		if ( !empty($q['tag_slug__in']) ) {
			$join = " INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) INNER JOIN $wpdb->terms ON ($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id) ";
			$whichcat .= " AND $wpdb->term_taxonomy.taxonomy = 'post_tag' ";
			$include_tags = "'" . implode("', '", $q['tag_slug__in']) . "'";
			$whichcat .= " AND $wpdb->terms.slug IN ($include_tags) ";
			$reqtag = is_term( $q['tag_slug__in'][0], 'post_tag' );
			if ( !empty($reqtag) )
				$q['tag_id'] = $reqtag['term_id'];
		}

		if ( !empty($q['tag__not_in']) ) {
			$ids = get_objects_in_term($q['tag__not_in'], 'post_tag');
			if ( is_array($ids) && count($ids > 0) ) {
				$out_posts = "'" . implode("', '", $ids) . "'";
				$whichcat .= " AND $wpdb->posts.ID NOT IN ($out_posts)";
			}
		}

		// Tag and slug intersections.
		$intersections = array('category__and' => 'category', 'tag__and' => 'post_tag', 'tag_slug__and' => 'post_tag');
		foreach ($intersections as $item => $taxonomy) {
			if ( empty($q[$item]) ) continue;

			if ( $item != 'category__and' ) {
				$reqtag = is_term( $q[$item][0], 'post_tag' );
				if ( !empty($reqtag) )
					$q['tag_id'] = $reqtag['term_id'];
			}

			$taxonomy_field = $item == 'tag_slug__and' ? 'slug' : 'term_id';

			$q[$item] = array_unique($q[$item]);
			$tsql = "SELECT p.ID FROM $wpdb->posts p INNER JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id) INNER JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) INNER JOIN $wpdb->terms t ON (tt.term_id = t.term_id)";
			$tsql .= " WHERE tt.taxonomy = '$taxonomy' AND t.$taxonomy_field IN ('" . implode("', '", $q[$item]) . "')";
			$tsql .= " GROUP BY p.ID HAVING count(p.ID) = " . count($q[$item]);

			$post_ids = $wpdb->get_col($tsql);

			if ( count($post_ids) )
				$whichcat .= " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
			else {
				$whichcat = " AND 0 = 1";
				break;
			}
		}

		// Author/user stuff

		if ( empty($q['author']) || ($q['author'] == '0') ) {
			$whichauthor='';
		} else {
			$q['author'] = ''.urldecode($q['author']).'';
			$q['author'] = addslashes_gpc($q['author']);
			if (strpos($q['author'], '-') !== false) {
				$eq = '!=';
				$andor = 'AND';
				$q['author'] = explode('-', $q['author']);
				$q['author'] = ''.intval($q['author'][1]);
			} else {
				$eq = '=';
				$andor = 'OR';
			}
			$author_array = preg_split('/[,\s]+/', $q['author']);
			$whichauthor .= ' AND (post_author '.$eq.' '.intval($author_array[0]);
			for ($i = 1; $i < (count($author_array)); $i = $i + 1) {
				$whichauthor .= ' '.$andor.' post_author '.$eq.' '.intval($author_array[$i]);
			}
			$whichauthor .= ')';
		}

		// Author stuff for nice URLs

		if ('' != $q['author_name']) {
			if (strpos($q['author_name'], '/') !== false) {
				$q['author_name'] = explode('/',$q['author_name']);
				if ($q['author_name'][count($q['author_name'])-1]) {
					$q['author_name'] = $q['author_name'][count($q['author_name'])-1];#no trailing slash
				} else {
					$q['author_name'] = $q['author_name'][count($q['author_name'])-2];#there was a trailling slash
				}
			}
			$q['author_name'] = sanitize_title($q['author_name']);
			$q['author'] = $wpdb->get_var("SELECT ID FROM $wpdb->users WHERE user_nicename='".$q['author_name']."'");
			$whichauthor .= ' AND (post_author = '.intval($q['author']).')';
		}

		$where .= $search.$whichcat.$whichauthor;

		if ( empty($q['order']) || ((strtoupper($q['order']) != 'ASC') && (strtoupper($q['order']) != 'DESC')) )
			$q['order'] = 'DESC';

		// Order by
		if ( empty($q['orderby']) ) {
			$q['orderby'] = 'post_date '.$q['order'];
		} else {
			// Used to filter values
			$allowed_keys = array('author', 'date', 'category', 'title', 'modified', 'menu_order');
			$q['orderby'] = urldecode($q['orderby']);
			$q['orderby'] = addslashes_gpc($q['orderby']);
			$orderby_array = explode(' ',$q['orderby']);
			if ( empty($orderby_array) )
				$orderby_array[] = $q['orderby'];
			$q['orderby'] = '';
			for ($i = 0; $i < count($orderby_array); $i++) {
				// Only allow certain values for safety
				$orderby = $orderby_array[$i];
				if ( 'menu_order' != $orderby )
					$orderby = 'post_' . $orderby;
				if ( in_array($orderby_array[$i], $allowed_keys) )
					$q['orderby'] .= (($i == 0) ? '' : ',') . "$orderby {$q['order']}";
			}
			if ( empty($q['orderby']) )
				$q['orderby'] = 'post_date '.$q['order'];
		}

		if ( $this->is_attachment ) {
			$where .= " AND post_type = 'attachment'";
		} elseif ($this->is_page) {
			$where .= " AND post_type = 'page'";
		} elseif ($this->is_single) {
			$where .= " AND post_type = 'post'";
>>>>>>> origin/2.3-branch
		} else {
			$post_type = 'post';
		}

		if ( is_array( $post_type ) ) {
			if ( count( $post_type ) > 1 ) {
				return;
			}
			$post_type = reset( $post_type );
		}

		// Do not attempt redirect for hierarchical post types
		if ( is_post_type_hierarchical( $post_type ) ) {
			return;
		}

		$query = $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta, $wpdb->posts WHERE ID = post_id AND post_type = %s AND meta_key = '_wp_old_slug' AND meta_value = %s", $post_type, get_query_var( 'name' ) );

		// if year, monthnum, or day have been specified, make our query more precise
		// just in case there are multiple identical _wp_old_slug values
		if ( get_query_var( 'year' ) ) {
			$query .= $wpdb->prepare(" AND YEAR(post_date) = %d", get_query_var( 'year' ) );
		}
		if ( get_query_var( 'monthnum' ) ) {
			$query .= $wpdb->prepare(" AND MONTH(post_date) = %d", get_query_var( 'monthnum' ) );
		}
		if ( get_query_var( 'day' ) ) {
			$query .= $wpdb->prepare(" AND DAYOFMONTH(post_date) = %d", get_query_var( 'day' ) );
		}

		$id = (int) $wpdb->get_var( $query );

		if ( ! $id ) {
			return;
		}

		$link = get_permalink( $id );

		if ( get_query_var( 'paged' ) > 1 ) {
			$link = user_trailingslashit( trailingslashit( $link ) . 'page/' . get_query_var( 'paged' ) );
		} elseif( is_embed() ) {
			$link = user_trailingslashit( trailingslashit( $link ) . 'embed' );
		}

		/**
		 * Filters the old slug redirect URL.
		 *
		 * @since 4.4.0
		 *
		 * @param string $link The redirect URL.
		 */
		$link = apply_filters( 'old_slug_redirect_url', $link );

		if ( ! $link ) {
			return;
		}

		wp_redirect( $link, 301 ); // Permanent redirect
		exit;
	}
}

/**
 * Set up global post data.
 *
 * @since 1.5.0
 * @since 4.4.0 Added the ability to pass a post ID to `$post`.
 *
 * @global WP_Query $wp_query Global WP_Query instance.
 *
 * @param WP_Post|object|int $post WP_Post instance or Post ID/object.
 * @return bool True when finished.
 */
function setup_postdata( $post ) {
	global $wp_query;

	if ( ! empty( $wp_query ) && $wp_query instanceof WP_Query ) {
		return $wp_query->setup_postdata( $post );
	}

	return false;
}
