<?php
/*
Plugin Name: Rankings and List Plugin
Plugin URI: http://wordpress.org
Description: For a version without credits email kurt@fantasyknuckleheads.com - Credits only show if you enable advanced features - Useful for rankings and list of anything you desire but optimized for ranking athletes and sports teams. 
Version: 3.1
Author: kutu62
Author URI: http://fantasyknuckleheads.com
*/
if ( ! function_exists('wp_ranking_post_types') ) {
// Register Custom Post Types
function wp_ranking_post_types() {
	// Register Lists
	$labels = array(
		'name'                => _x( 'Song lists', 'Post Type General Name', 'wp-ranking' ),
		'singular_name'       => _x( 'Song list', 'Post Type Singular Name', 'wp-ranking' ),
		'menu_name'           => __( 'Song lists', 'wp-ranking' ),
		'parent_item_colon'   => __( 'Parent list:', 'wp-ranking' ),
		'all_items'           => __( 'Lists', 'wp-ranking' ),
		'view_item'           => __( 'View list', 'wp-ranking' ),
		'add_new_item'        => __( 'Add New List', 'wp-ranking' ),
		'add_new'             => __( 'New List', 'wp-ranking' ),
		'edit_item'           => __( 'Edit List', 'wp-ranking' ),
		'update_item'         => __( 'Update List', 'wp-ranking' ),
		'search_items'        => __( 'Search lists', 'wp-ranking' ),
		'not_found'           => __( 'No lists found', 'wp-ranking' ),
		'not_found_in_trash'  => __( 'No lists found in Trash', 'wp-ranking' ),
	);
	$args = array(
		'label'               => __( 'player_list', 'wp-ranking' ),
		'description'         => __( 'Song list', 'wp-ranking' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'taxonomies'          => array( 'list_category' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'ranker',
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 100,
		'menu_icon'           => plugins_url('/images/icon_16.png', __FILE__),
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'player_list', $args );
	// Register Rankers
	$labels = array(
			'name'                => _x( 'Rankers', 'Post Type General Name', 'wp-ranking' ),
			'singular_name'       => _x( 'Ranker', 'Post Type Singular Name', 'wp-ranking' ),
			'menu_name'           => __( 'Ranker', 'wp-ranking' ),
			'parent_item_colon'   => __( 'Parent Ranker:', 'wp-ranking' ),
			'all_items'           => __( 'Rankers', 'wp-ranking' ),
			'view_item'           => __( 'View Ranker', 'wp-ranking' ),
			'add_new_item'        => __( 'Add New Ranker', 'wp-ranking' ),
			'add_new'             => __( 'New Ranker', 'wp-ranking' ),
			'edit_item'           => __( 'Edit Ranker', 'wp-ranking' ),
			'update_item'         => __( 'Update Ranker', 'wp-ranking' ),
			'search_items'        => __( 'Search rankers', 'wp-ranking' ),
			'not_found'           => __( 'No rankers found', 'wp-ranking' ),
			'not_found_in_trash'  => __( 'No rankers found in Trash', 'wp-ranking' ),
		);
		$args = array(
			'label'               => __( 'ranker', 'wp-ranking' ),
			'description'         => __( 'Rankers', 'wp-ranking' ),
			'labels'              => $labels,
			'supports'            => array( 'title', ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => 'ranker',
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => false,
			'menu_position'       => 5,
			'menu_icon'           => plugins_url('/images/icon_16.png', __FILE__),
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
		);
		register_post_type( 'ranker', $args );
}
// Hook into the 'init' action
add_action( 'init', 'wp_ranking_post_types', 0 );
}
if ( ! function_exists('list_category') ) {
// Register List Categoties
function list_category()  {
	$labels = array(
		'name'                       => _x( 'List categories', 'Taxonomy General Name', 'wp-ranking' ),
		'singular_name'              => _x( 'List category', 'Taxonomy Singular Name', 'wp-ranking' ),
		'menu_name'                  => __( 'List Categories', 'wp-ranking' ),
		'all_items'                  => __( 'All List Categories', 'wp-ranking' ),
		'parent_item'                => __( 'Parent List Category', 'wp-ranking' ),
		'parent_item_colon'          => __( 'Parent List Category:', 'wp-ranking' ),
		'new_item_name'              => __( 'New List Category Name', 'wp-ranking' ),
		'add_new_item'               => __( 'Add New List Category', 'wp-ranking' ),
		'edit_item'                  => __( 'Edit List Category', 'wp-ranking' ),
		'update_item'                => __( 'Update List Category', 'wp-ranking' ),
		'separate_items_with_commas' => __( 'Separate list categories with commas', 'wp-ranking' ),
		'search_items'               => __( 'Search list categories', 'wp-ranking' ),
		'add_or_remove_items'        => __( 'Add or remove list categories', 'wp-ranking' ),
		'choose_from_most_used'      => __( 'Choose from the most used list categories', 'wp-ranking' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'list_category', 'player_list', $args );
}
register_taxonomy_for_object_type( 'list_category', 'player_list' );
// Hook into the 'init' action
add_action( 'init', 'list_category', 0 );
}


function rankings_check_user_rights() {
	return current_user_can( 'edit_pages' );
}

// Adding a shortocde [ranker id="id" show_composite="0"]
function ranker_shortcode( $atts ) {
	$id = $atts['id']; // Get ranker id
	$show_composite = isset($atts['show_composite']) ? $atts['show_composite'] : rankings_check_user_rights() ; // settings for composite
	
	$target_user = isset($atts['user_id']) ? $atts['user_id'] : false ; // Get user id
	
	$rankings = get_post_meta($id, '_rankings'); // Get rankings
	$rankings = $rankings[0];
	foreach ($rankings as $author => $ranking) {
		$rankings[$author]['data'] = array_flip($ranking['data']); //Flip the array from rank->player_id to player_id->rank for faster player search
	}
	$rankings = shuffle_assoc($rankings); //randomize user rankings
	$list_id = get_post_meta($id, '_list', true); // Get list id
	$players = get_post_meta($list_id, '_players'); // Get players from list
	$players = $players[0];
	$composite_position = get_option( 'composite-position' );
	$show_comments = get_option( 'show-comments' );
	$show_avatars = get_option( 'show-avatars' );

	if (isset($atts['limit_users'])) {
		$limit_users = $atts['limit_users'];
	} else {
		$limit_users = get_option( 'limit-users' );
	}

	if (isset($atts['limit_players'])) {
		$limit_players = $atts['limit_players'];
	} else {
		$limit_players = get_option( 'limit-players' );
	}

	$current_user = get_current_user_id();
	$rankings_count = count($rankings);

	global $rankers_counter;
	if (!isset($rankers_counter)) {
		$rankers_counter = 0;
	} 

	global $add_ranker_scripts;
	$add_ranker_scripts = true; //set this global variable so the styles and scripts will be loaded on this page

	ob_start();
	
	$rankers_counter++;
	echo '<table id="ranker' . $rankers_counter . '" class="rankings">';
	echo '<thead>';
	echo '<tr>';
	echo '<th colspan="3"></th>';

	
	if ($rankings_count > 1 AND $composite_position == 'left' AND $show_composite AND !$target_user) {
		show_composite_rankings_header();
	}

	show_ranked_authors($rankings, $current_user, $limit_users, $target_user);

	if ($rankings_count > 1 AND $show_composite AND !$target_user AND ($composite_position == 'right' OR $composite_position === false)) {
		show_composite_rankings_header();
	}
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	
	foreach ($players as $player) {
			$row = '';
			$row['player-id'] = $player['id'];
			$row['player-name'] = $player['name'];
			$row['player-team'] = $player['team'];
			$row['player-position'] = $player['position'];
			$row['player-link'] = $player['link'];
			$row['player-image'] = $player['image'];

			$total = 0;
			$votes = 0;
			foreach ($rankings as $author => $ranking) {
				
				if (isset($ranking['data'][$player['id']])) {
					$position = $ranking['data'][$player['id']] + 1;
					$votes++;
					$total += $position;
				}
				else {
					$position = '-';
				}

				$positions[$author] = $position;
				
			}
			$row['total'] = $total;
			$row['votes'] = $votes;
			$row['composite'] = 0;
			if ($votes != 0 AND $show_composite) {
				$row['composite'] = get_composite_rankings($total, $votes);
			}
			
			
			
			foreach ($positions as $author => $position) {
				$row['positions'][$author] = $position;
			}

		$table[] = $row;

	}

	//usort($table, "sort_by_composite");

	$row_counter = 1;
	foreach ($table as $row) {
		if ($row_counter <= $limit_players OR $limit_players == 0) {
			if ($player_counter % 2 == 0) {
				$class = 'even';
			}
			else {
				$class = 'odd';
			}
			if ($row['votes'] > 0) {
	 			$output = '<tr class="' . $class . '" id="player' . $row['player-id'] . '">';
				$output .= '<td class="player">';
				$output .= $row['player-name']; // name
				$output .= '</td>';
				$output .= '<td class="player">';
				$output .= $row['player-team']; // team
				$output .= '</td>';
				$output .= '<td class="player">';
				
				if ($row['player-position']) {
					$link_text = $row['player-position'];
				}
				else {
					$link_text = 'Buy CD';
				}
				
				if ($row['player-image']) {
					if ($row['player-link']) {
						$output .= '<a href="' . $row['player-link'] . '"><img class="ranking-cover" src="' . $row['player-image']. '" /><br>' . $link_text . '</a>'; // link to album
					}
					else {
						$output .= '<img class="ranking-cover"  src="' . $row['player-image']. '" /><br>' . $link_text;
					}
				}
				else {
					if ($row['player-link']) {
						$output .= '<a href="' . $row['player-link'] . '">' . $link_text . '</a>'; // link to album
					}
					else {
						$output .= $link_text; 
					}
				}
				$output .= '</td>';

				if ($rankings_count > 1 AND $show_composite AND !$target_user AND $composite_position == 'left') {
					$output .= '<td>';
						$output .= $row_counter;
					$output .= '</td>';
				}

				$counter = 0;
				if ($target_user) {

					$output .= '<td>';
					$output .= $row['positions'][$target_user];
					$output .= '</td>';
					$counter++;	
				}
				else {
					if ($current_user != 0 AND isset($rankings[$current_user])) {
						$output .= '<td class="position">';
						$output .= $row['positions'][$current_user];
						$output .= '</td>';
						$counter++;
					}

					foreach ($row['positions'] as $author => $position) {
						if ($counter < $limit_users OR $limit_users == 0) {
							if ($author != $current_user) {
								$output .= '<td>';
								$output .= $position;
								$output .= '</td>';
								$counter++;	
							}
						}	
					}
				}
				
				if ($rankings_count > 1 AND $show_composite AND !$target_user AND $composite_position == 'right') {
					$output .= '<td>';
						$output .= $row_counter;
					$output .= '</td>';
				}
				
				$output .= '</tr>';
				echo $output;
				$row_counter++;
			}
		}
		
	}
	echo '</tbody>';
	echo '</table>';

	if ($show_comments) {
		foreach ($rankings as $author => $data) {
			if ($data['comment'] != ''){
				echo '<div class="author-comment">';
				echo get_avatar( $author, 60 );
				echo $data['comment'];
				echo '</div>';
			}
		}
	}

	$rankings_user_roles = get_option( 'rankings-user-roles' );
	$comments_user_roles = get_option( 'comments-user-roles' );

	if ($show_comments OR $show_avatars OR !empty($rankings_user_roles) OR !empty($comments_user_roles) OR $limit_users > 0 OR $limit_players > 0 OR $composite_position != 0) {
		echo '<br><p style="font-size:65%;">Make Your Own Rankings <a href="http://wordpress.org/plugins/sports-rankings-lists/">WP Plugin</a>. Powered by: <a href="http://fantasyknuckleheads.com/" title="Fantasy Football for all you Knuckleheads">Fantasy Knuckleheads</a></p>';
	}
	
	$output = ob_get_contents();
	ob_end_clean();

	return $output ;
}
add_shortcode( 'ranker', 'ranker_shortcode' );

function show_ranked_authors($rankings, $current_user, $limit_users, $target_user = false) {
	$counter = 0;
	if ($target_user) {
		if (isset($rankings[$target_user]))
			show_author_thumbnail($target_user, $rankings[$target_user]['time']);
	}
	else {
		if ($current_user != 0 AND isset($rankings[$current_user])) {
			show_author_thumbnail($current_user, $rankings[$current_user]['time']);
			$counter++;
		}
		foreach ($rankings as $author => $data) {

			if (($limit_users == '0' OR $counter < $limit_users) AND $author != $current_user) {
				show_author_thumbnail($author, $data['time']);	
				$counter++;
			}
		}
	}
}

function show_author_thumbnail($user_id, $user_ranking_time) {
	echo '<th class="author" title="' . __( 'Click to sort by this author', 'wp-ranking' ) . '">';
	if (get_option( 'show-avatars' )) echo get_avatar( $user_id, 60 );
	$user_info = get_userdata($user_id);
	$timestamp = date("M d, H:i", $user_ranking_time);
	echo '<br>';
	echo '<span class="ranked-user">' . $user_info->display_name . '</span>';
	echo '<br>';
	echo '<span class="ranked-timestamp">' . $timestamp . '</span>';
	echo '</th>';
}

function show_composite_rankings_header() {
	echo '<th class="author" title="' . __( 'Click to sort by composite ranking', 'wp-ranking' ) . '">' . __( 'Composite', 'wp-ranking' ) . '</th>';	
}

function get_composite_rankings($total, $rankings_count) {
	return round($total / $rankings_count * 100);
}

function shuffle_assoc($list) { 
	if (!is_array($list)) return $list; 

	$keys = array_keys($list); 
	shuffle($keys); 
	$random = array(); 
	foreach ($keys as $key) { 
	$random[$key] = $list[$key]; 
	}
	return $random; 
} 

function sort_by_composite($a, $b) {
  	return $a["composite"] - $b["composite"];
}





function wp_ranking_register_styles() {
	wp_register_script('table-sorter', plugins_url( '/js/jquery.tablesorter.min.js' , __FILE__ ), 'jquery');
	wp_register_script('ranker-script', plugins_url( '/js/scripts.js' , __FILE__ ));
    wp_register_style( 'wp-ranking-style', plugins_url('/css/wp-ranking.css', __FILE__) );
}
add_action('init', 'wp_ranking_register_styles');

function wp_ranking_print_styles() {
	global $add_ranker_scripts;

	if ($add_ranker_scripts === true) { //print styles and scripts only if shortcode was used on current page
		wp_print_scripts('table-sorter');
		wp_print_scripts('ranker-script');
    	wp_print_styles('wp-ranking-style');
	}
    
}
add_action('wp_footer', 'wp_ranking_print_styles');

include( plugin_dir_path( __FILE__ ) . 'admin.php');
if (function_exists('load_plugin_textdomain'))
	{
		load_plugin_textdomain('wp-ranking', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}
?>
