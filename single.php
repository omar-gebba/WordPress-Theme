<?php get_header(); ?>
    <div class='container single-post'>
            <?php 
            if(have_posts()) {
                while(have_posts()) {
                    the_post();?>
                    <div class='col-sm-12'>
                        <div class='main-post'>
                            <span class='edit'>
                                <?php edit_post_link('Edit <i class="fa fa-pencil"></i>'); ?>
                            </span>
                            <h3 class='post-title'>
                                <a href='<?php the_permalink(); ?>'>
                                   - <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php the_post_thumbnail( 'large', ['class' => 'img img-responsiv responsive--full featured-img', 'alt' => 'featured image'] ); ?>
                            <p class='content text-center'>
                            <?php the_content(); ?>
                            </p>
                            
                            <hr class='single'>
                            <p class='cats'>
                                <span>Cateegory: </span>    
                                <?php the_category($separator = ', ');?>
                             </p>
                        <!-- tags here -->
                            <?php 
                            if (has_tag(''))
                            {
                                echo "<p class='tags'>";
                                echo "<span>See Other: </span>";
                                the_tags('', '-'); // it takes theree valuse ('before', 'seperator','after')
                                echo "</p>";
                            } 
                            ?>
                        <!-- end tags -->
                                
                                <span class='post-date'>
                                    <i class="fa fa-calendar"></i> 
                                    <?php the_date(); ?>
                                </span>    
                                <div class='count-comments'> 
                                    <span class='comment-count'>
                                        <i class="fa fa-comment"></i>
                                        <?php 
                                            if (comments_open()) 
                                            {
                                                comments_popup_link('0 Comments', '1 Comment', '% Comments');

                                            } 
                                            else
                                            {
                                                comments_popup_link('0 Comments', '1 Comment', '% Comments');
                                                echo ' <span class="com-disabled">Comments Disabled</span>';
                                            }
                                        ?>
                                        <?php //comments_popup_link('No Comments', '1 Comment', '% Comments', 'coms-url', 'Comments Disabled'); ?>
                                    </span>
                                </div>
                                <hr class='single'>
                                <div class'art-auth-meta'>
                                    <span class='author-name'>
                                        <span><strong>The Author Of Article: </strong>
                                            <?php the_author_posts_link();  
                                            echo ' ' . count_user_posts(get_the_author_meta('ID')) . ' posts';
                                            ?>
                                        </span>
                                        <span><strong>Nick Name: </strong>
                                            <?php echo get_the_author_meta('nickname'); ?>
                                        </span>
                                        <span><strong>About him: </strong>
                                            <?php echo get_the_author_meta('description'); ?>
                                        </span>
                                    </span>
                                </div>
                             <!--  -->                             
                        </div> 
                    </div>
                    <div class='clearfix'></div>
                    <div class='links'>
                        <?php
                        if (get_previous_post_link())
                        {
                            echo "<span class='left'>";
                                previous_post_link('%link', '<i class="fa fa-chevron-circle-left"></i> %title');
                            echo "</span>";
                        }
                        if (get_next_post_link())
                        {
                            echo "<span class='right'>";
                                next_post_link('%link', '%title <i class="fa fa-chevron-circle-right"></i>');
                            echo "</span>";
                        }
                        ?>
                    </div>
                    <hr class='coment-sep'>
            <?php   // => add a list of posts dependes on category of the main post

                $same_cat_args = array(
                    'order'             => 'rand',
                    'category__in'      => wp_get_post_categories(get_queried_object_id()),
                    'posts_per_page'    => 10,
                    'post__not_in'      => array(get_queried_object_id()),
                );

                $posts_in_same_cat = new wp_query($same_cat_args);
                if($posts_in_same_cat->have_posts())
                {
                    echo "<div class='the-same-cat'>";
                        echo "<h4>Related</h4>";
                        while($posts_in_same_cat->have_posts())
                        {
                            $posts_in_same_cat->the_post();
                            echo "<p'>";
                                echo '<a href="' . get_the_permalink () . '">';
                                    the_title();
                                echo "</a>";
                            echo "</p>";
                        }
                    echo "</div>";
                }

            ?>
                <?php
                }
                comments_template();
            } ?>
            
    </div>
<?php get_footer(); ?>