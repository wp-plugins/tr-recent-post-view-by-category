<?php  

/**
 * Plugin Name: TR Recent Post View By Category
 * Plugin URI: http://themeroad.net/
 * Description: TR Recent Post View By Category is amazinng.You can see your recent view post by category just install this plugin and use very easy shortcode.you can use this shortcode in your page post or widgets.very light weight and easy to use.
 * Version:  1.0.0
 * Author: Theme Road
 * Author URI: http://themeroad.net/
 * License:  GPL2
 *Text Domain: tmrd
 *  Copyright 2015 GIN_AUTHOR_NAME  (email : BestThemeRoad@gmail.com
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License, version 2, as
 *	published by the Free Software Foundation.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

if(!defined('ABSPATH')) exit;      // Prevent Direct Browsing


function tr_recent_post_cat($atts) {
			extract( shortcode_atts( array(
		'category'=>'',

	), $atts) );



// the query
$query = new WP_Query( array( 'category_name' => $category, 'posts_per_page' => -1 ) ); 

// The Loop
if ( $query->have_posts() ) {
	$html .= '<ul class="tr_post_cat widget_recent_entries">';
	while ( $query->have_posts() ) {
		$query->the_post();
			if ( has_post_thumbnail() ) {
			$html .= '<li>';
			$html .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
			} else { 
			// if no featured image is found
			$html .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			}
			}
	} else {
	// no posts found
}
$html .= '</ul>';

return $html;

/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('rec_post_cat', 'tr_recent_post_cat');

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');


function recent_post_style(){?>

<style type="text/css">

ul.tr_post_cat {
list-style-type: none;
text-decoration: none;
}

ul.tr_post_cat li a{

text-decoration: none;
}
.tr_post_cat img {
float:left; 
padding:3px;
margin:3px;
border: 3px solid #EEE;
}


</style>

<?php 

}
add_action('wp_head','recent_post_style');

