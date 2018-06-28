<?php get_header() ?>
<div class='container cats-page'>
    <div class='row about-cat''>
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
                                comments_count();   // custom function => at functions.php
                                echo " Or ";
                                comments_count2();  // custom function => at functions.php
                            ?>
                            </span>
        </div>
    </div> 
    <div class='clearfix'></div>
    <div class='row'>
        <div class='col-sm-9'>

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
                        
                        <div class=' row public-post'>
                            <div class='col-sm-6 text-center public-thumbnail'>
                                <?php
                                    $img_attr = array('class' => "img-thumbnail img-responsive");
                                        
                                    echo the_post_thumbnail('size', $img_attr);
                                ?>
                            </div>
                            <div class='col-sm-6'>
                                <h3>
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title()?>
                                    </a>
                                </h3>
                                <div class='cats-content'>
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
        <div class='col-sm-3 linux-side-bar'>
            <?php
            // if (is_active_sidebar('main_sidebar'))
            // {
            //     dynamic_sidebar('main_sidebar');
            //     echo "<hr>";
            //     echo "<hr>";
            // }
            get_sidebar('Public');
            ?>
        </div>
    </div>    
    
</div>


<?php get_footer() ?>