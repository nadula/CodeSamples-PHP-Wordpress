<?php

/*

Creates a side column widget to display specific category posts.
Can be used in /themes/themename/plugins/

*/

function crikey_elsewhere_catbox_by_category($title, $catid, $howmany) {

	//$recent = new WP_Query("cat={$catid},16648&posts_per_page=&order=DESC&orderby=date"); 
	$recent = new WP_Query(array('category__and' => array( $catid, 16648 ), 'order' => 'DESC', 'orderby' => 'date')); 
	//$recent = new WP_Query("cat={$catid}"); 
	
	if($recent->have_posts()) {
?>
        <div class="pod pod-generic-by-category pod-elsewhere" id='elsewhere-pod' align="center">
            <a href="/elsewhere/" id='pod-elsewhere-link'>
                <span class="elswhere-category-title"><?php echo $title." elsewhere"; ?></span>
                <img alt="Crikey Elsewhere" src="<?php echo get_stylesheet_directory_uri() ?>/img/pod-elsewhere-category.jpg" />
            </a>
    
            <ul id="elsewhere-scroller-by-category" >
            
<?php	
            $count = 0;		
            while($recent->have_posts()) : $recent->the_post();
                $permalink = get_permalink( get_the_ID() );
    
                $info = parse_url($permalink);
                $host = $info['host'];			
                
				//this may work to get the host name without www, but may not work for domains like com.au
				$host_names = explode(".", $host);
				$bottom_host_name = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
                
                if(!strpos($permalink,"crikey")) {
                    ?><li><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <a href="<?php echo $info['scheme']."://".$info['host']; ?>" target="_blank"><?php echo $host; ?></a></li><?php
                    $count+=1;				
                    if($count==$howmany) { break 2; }				
                }
            endwhile;
					
?>				
            </ul>
    
        </div><!-- .pod-elsewhere -->
<?php
    
        if($count==0) { 
            ?>
            <script type="text/javascript"> 
				//$(document).ready(function() {
					$('#elsewhere-pod').hide(); 
				//});
            </script>
            <?php
        }
	}
}

?>