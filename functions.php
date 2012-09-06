<?php

/*

functions.php for wordpress with custom functions

*/ 

/* Adds a additional meta box to post edit page. Need to install ACF plugin for this to work. */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => '50400dc671166',
		'title' => 'Excerpt Display Control',
		'fields' => 
		array (
			0 => 
			array (
				'label' => 'Excerpt Dsiplay',
				'name' => 'excerpt-display',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => 'Select this option to control the display of excerpt on an article page. Unchecked is desabled.',
				'key' => 'field_50400d473c18e',
				'order_no' => '0',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
}

/* Add Breadcrumbs */


function breadcrumbs() {

	$theFullUrl = $_SERVER["REQUEST_URI"];
	
	$urlArray=explode("/",$theFullUrl);
	//echo 'You Are Here: <a href="/">Home</a>';
	echo "<div class='breadcrumbs_div'>";
	echo "<div class='breadcrumbs'><ul>";
	while (list($j,$text) = each($urlArray)) {
		$dir='';
		if ($j > 1) {
			$i=1;
			while ($i < $j) {
				$dir .= '/' . $urlArray[$i];
				$text = $urlArray[$i];
				$i++;
			}
			if($j < count($urlArray)-1) echo ' <li><a href="'.$dir.'">' . str_replace("-", " ", $text) . '</a></li>';
		}
	}
	echo "</ul></div>";
	echo "<div class='current'>".wp_title('', false).'<img class="current_img" width="11" height="17" border="0" src="/wp-content/themes/crikey/img/left_arrow.png" alt="&gt;">'."</div></div>";
	echo '<div class="clear"></div>';

}

/* Gives a post count per category. WP does not have a built in fuction for this as of 3.4.1 */

function get_post_count($categories) {
	global $wpdb;
	$post_count = 0;

		foreach($categories as $cat) :
			$querystr = "
				SELECT count
				FROM $wpdb->term_taxonomy, $wpdb->posts, $wpdb->term_relationships
				WHERE $wpdb->posts.ID = $wpdb->term_relationships.object_id
				AND $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
				AND $wpdb->term_taxonomy.term_id = $cat
				AND $wpdb->posts.post_status = 'publish'
			";
			$result = $wpdb->get_var($querystr);
  		$post_count += $result;
   endforeach; 

   return $post_count;
}


/* Filter out the posts which are 'links' from category list pages. BUT this cause Elsewhere Pod to fail as there are no links to display */

/*add_action( 'pre_get_posts', 'foo_modify_query_exclude_category' );
function foo_modify_query_exclude_category( $query ) {
 	$query->set( 'category__not_in', '16648' );
}*/

?>