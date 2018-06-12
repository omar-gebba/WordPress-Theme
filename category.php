<?php get_header() ?>
<div class='container cats-page'>
    <div class='row about-cat'>
        <h1 class="col-sm-4 text-center">
            <?php
                single_cat_title( $prefix = '', $display = true );   
                
            ?>
         </h1>
        <div class="col-sm-4 text-center"><?php echo category_description() ?></div>
        <div class="col-sm-4 text-center">
            Posts: <span><?php echo get_category(get_queried_object_id())->count; ?></span> |
            Comments: <span>
                            <?php 
                                $comments_args = array(
                                    'post__in'          => get_queried_object_id(),
                                    'count'             => true,
                                );
                                echo get_comments($comments_args);
                            ?>
                            </span>
    </div>
    </div> 
    <div class='clearfix'></div>
        <?php
            // use wp_query to fetch count of posts in a category
            $count_args = array(
                'category__in'      => get_queried_object_id(),
                'posts_per_page'    => 25,
                'order'             => 'rand',
            );

            $cat_posts = new wp_query($count_args);

            if ($cat_posts->have_posts())
            {
                while ($cat_posts->have_posts())
                {
                    $cat_posts->the_post();
                    ?>
                    <div class='cats-post'>
                        <h3 class='text-center'>
                            <a href="<?php the_permalink() ?>">
                                <?php the_title()?>
                            </a>
                        </h3>
                        <div class='info text-center'>
                            By: <span><?php the_author_posts_link() ?></span> |
                            On: <span><?php the_date() ?></span> |
                            <i class="fa fa-comment"></i> 
                            <span><?php comments_popup_link('No comments', 'One Comment', '% Comments') ?></span>
                        </div>
                        <div class='text-center cat-post'>
                            <div class='text-center post-thumb'>
                            <?php
                                $img_attr = array(
                                    'class'	=> "img-thumbnail img-responsive",
                                );
                                echo the_post_thumbnail('size', $img_attr);
                            ?>
                            </div>
                            <div class='text-center cats-content'>
                                <?php the_excerpt();  ?>
                            </div>
                        </div>
                        
                    </div>
                    <hr>    
                    <?php
                }
            }
        ?>
    
</div>


<?php get_footer() ?>