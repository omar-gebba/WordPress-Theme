<?php get_header(); ?>
    <div class='container auth-page'>
        
        <div class='row'>
            <div class='col-sm-3 text-center avatar'>
                <?php echo get_avatar(get_the_author_meta('ID')); ?> 
                <p class='text-center'><?php echo ucfirst(get_the_author_meta('first_name')); ?></p>
            </div>
            <div class='col-sm-9 info'>
                <p class='name'>
                <span>Name: </span>
                    <?php echo ucfirst(get_the_author_meta('first_name')); ?>
                    <?php echo ucfirst(get_the_author_meta('last_name')); ?>
                </p>
                <p class='nick-name'>
                <span>Nick-name: </span>
                    <?php echo ucfirst(get_the_author_meta('first_name')); ?>
                </p>
                <hr>
                <p class='description'>
                    <?php 
                        if (get_the_author_meta('description'))
                        {
                            echo ucfirst(get_the_author_meta('description'));
                        }
                        else
                        {
                            echo 'There is no biograghy';
                        }
                    ?>
                </p>
            </div>
        </div> <!-- end 1st row -->
        <hr>
        <div class='row text-center stats'>
            <div class='col-sm-3'>
                <div class='stat'>
                    Posts Count
                    <span>
                    <?php echo count_user_posts(get_the_author_meta('ID')); ?>
                    </span>
                </div>
            </div>
            <div class='col-sm-3'>
                <div class='stat'>
                    Comments Count
                    <span>
                        <?php
                            $comments_count_arrgs = array(
                                'user_id'   => get_the_author_meta('ID'),
                                'count'     => true,   // to count the comments as a number
                            );
                            
                            echo get_comments($comments_count_arrgs);
                        ?>
                    </span>
                </div>
            </div>
            <div class='col-sm-3'>
                <div class='stat'>
                    Total Posts Veiw
                    <span>0</span>
                </div>
            </div>
            <div class='col-sm-3'>
                <div class='stat'>
                    Testing
                    <span>0</span>
                </div>
            </div>
        </div> <!-- end 2nd row -->
        <div class='clearfix'></div>
        <hr>
<!-- /////////////////////// start to add posts -->
        <?php 

            $number_of_posts = 5;
            $query_args = array(
                'author'         => get_the_author_meta('ID'),
                'posts_per_page' => $number_of_posts,
            );
            $author_posts = new wp_query($query_args);

            if($author_posts->have_posts())
            {
                echo "<div class='text-center user-posts'><span class='user-posts'>";
                if(count_user_posts(get_the_author_meta('ID')) > $number_of_posts )
                {
                    if ($number_of_posts > 1)
                    {
                        echo 'Latest ' . $number_of_posts . ' posts of ' . ucfirst( get_the_author_meta('nickname'));
                    }
                    elseif($number_of_posts == 1)
                    {
                        echo 'Latest post of ' . ucfirst( get_the_author_meta('nickname'));
                    }
                }
                else
                {
                    echo 'Latest posts of ' . ucfirst( get_the_author_meta('nickname'));
                }
                echo "</span></div>";
                while ($author_posts->have_posts())
                {
                    $author_posts->the_post();
                    ?>
                    <div class='row auth-post'>
                        <div class='col-sm-3 text-center'>
                        <?php the_post_thumbnail( 'large', [
                                                            'class' => 'img img-responsiv img-thumbnail',
                                                             'alt' => 'featured image'] ); ?>
                        </div>
                        <div class='col-sm-9 hr'>
                            <h4 class='post-title'>
                                <a href='<?php the_permalink(); ?>'>
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                            <span class='post-date'>
                                <i class="fa fa-calendar"></i> 
                                <?php the_date(); ?>, 
                            </span>
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
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            
                            <hr class='post-sep'>
                        </div>
                        
                    </div>          <!-- end 3rd row -->
                    <div class='clearfix'></div>
                    
                    <?php
                }
                wp_reset_postdata();
////////////////////////////////////////// start to add comments 
                $maximum_number_of_comments = 10;

                $comments_arrgs = array(
                    'number'        => $maximum_number_of_comments,
                    'user_id'       => get_the_author_meta('ID'),
                    'status'        => 'approve',
                    'post_type'     => 'post',
                    'post_status'   => 'publish',
                );

               $comments = get_comments($comments_arrgs);
               if ($comments)
               {
                ?>
                    <div class='auth-comments'>
                        <div class='text-center user-comments'>
                            <i class="fa fa-comment fa-1x"></i>
                            Latest comments of <?php echo get_the_author_meta('nickname'); ?> 
                        </div>
                    </div>
                    
                <?php
                    foreach ($comments as $comment)
                    {
                        // $comment->comment_ID;
                    ?>
                        <div class='fetch_user-coment'>
                            
                            
                            <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                           
                                <?php echo get_the_title($comment->comment_post_ID); ?>
                            </a>
                             <!-- mysql2date( $format, $date, $translate ) => this is the way to convert the date -->
                            <span
                                class='date'><i class='fa fa-calendar'></i>
                                <?php echo 'Added on ' .  mysql2date( 'D, M, Y', $comment->comment_date, true ); ?>
                            </span>
                            <p>
                                <?php echo $comment->comment_content ?>
                            </p>                            
                        </div>
                    <?php  
                   }
               }
               else
               {
                   echo 'No Coments';
               }
            }
            else
            {
                the_author_meta('nickname'); echo " dosen't has posts";
            }
        ?>
    </div>
<?php get_footer(); ?>