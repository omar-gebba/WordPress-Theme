<?php get_header(); ?>
    <div class='container posts'>
        <div class='row'>
            <?php 
            if(have_posts()) {
                while(have_posts()) {
                    the_post();?>
                    <div class='col-sm-6'>
                        <div class='main-post'>
                            <h3 class='post-title'>
                                <a href='<?php the_permalink(); ?>'>
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <span class='author-name'>
                                <i class="fa fa-user"></i>
                                <?php the_author_posts_link(); ?>, 
                            </span>
                            <span class='post-date'>
                                <i class="fa fa-calendar"></i> 
                                <?php the_date() ?>, 
                            </span>
                            <span class='comment-count'>
                                <i class="fa fa-comment"></i>
                                <?php 
                                    if (comments_open()) 
                                    {
                                        if(get_comments_number() == 0)
                                        {
                                            echo '0';
                                        }
                                        elseif (get_comments_number() == 1)
                                        {
                                        echo get_comments_number();
                                        }
                                        elseif(get_comments_number() > 1)
                                        {
                                            echo get_comments_number() . ' Comments';
                                        }

                                    } 
                                    else
                                    {
                                        comments_popup_link('No comments', 'One Comment', '% Comments');
                                        echo ' <span class="com-disabled">Comments Disabled</span>';
                                    }
                                ?>
                                <?php //comments_popup_link('No Comments', '1 Comment', '% Comments', 'coms-url', 'Comments Disabled'); ?>
                            </span>
                            <?php the_post_thumbnail( 'large', ['class' => 'img img-responsiv img-thumbnail responsive--full text-center', 'alt' => 'featured image'] ); ?>
                            <p class='content'>
                                    <?php the_excerpt(); //the_content('See the full article .. .');  ?>
                            </p>
                            <p class='cats'>
                                <i class="fa fa-location-arrow fa-lg"></i>    
                                <?php the_category($separator = ', ');?>
                             </p>
                             <p class='tags'>
                                <?php 
                                if (has_tag('files'))
                                {
                                    the_tags(null, '-'); 
                                } 
                                else
                                {
                                    echo 'no  tags here';
                                }?>
                             </p>
                             
                        </div>
                        <div class='clearfix'></div>
                </div>
                <?php
                }
            } ?>
        </div>
        <div class='clearfix'></div>
        
            <?php
                if (have_posts())
                {
                    echo "<div class='pagination text-center'>";
                        echo "<div class='pgai-pagi'>"; 
                        // previous page
                                if(get_previous_posts_link())
                                {
                                    previous_posts_link('<span><i class="fa fa-chevron-circle-left fa-3x"></i></span>');
                                }
                                else
                                {
                                    echo '<span><i class="fa fa-chevron-circle-left fa-3x"></i></span>';
                                }
                        // next page      
                                if(get_next_posts_link())
                                {
                                    next_posts_link('<span><i class="fa fa-chevron-circle-right fa-3x"></i></span>');
                                }
                                else
                                {
                                    echo '<span><i class="fa fa-chevron-circle-right fa-3x next"></i></span>';
                                }
                    echo "</div>";
                echo "</div>";
                }
                echo "<div class='text-center'>";
                echo numbering_pgination();
                echo "</div>";
            ?>
        
    </div>
<?php get_footer(); ?>