	<?php
    //Excerpt will show if only manual excerpt is entered in the post

    $date = strtotime($post->post_date);
    $postdate = date('Y-m-d', $date);
    $cutoffdate = date('Y-m-d', strtotime("2012-07-01"));

    if($postdate<$cutoffdate) { ?>

        <div id='post-excerpt'>		
                <?php //the_excerpt(__( 'Read More <span class="meta-nav">&raquo;</span>' ));
                the_excerpt(__( '' ));
                  ?>
            </div>

    <?php } ?>