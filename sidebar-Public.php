<div class='wedgit-public'>
    <div class='wedgit-title'>
        Wedgit Title    : <?php single_cat_title($prefix = '', $display = true) ?>
    </div>
    <div class='wedgit-content'>
        <p>
            Posts Count   : <?php echo get_queried_object()->count ?>    <br>
            Comments Count: <?php comments_count(); ?>
        </p>
    </div>
</div>
<div class='wedgit-public'>
    <div class='wedgit-title'>
        get_queried_object parameters
    </div>
    <div class='wedgit-content'>
        <p>
        
            <?php
                echo get_queried_object()->count;
                echo "<pre>";
                print_r (get_queried_object()); 
                echo "</pre>";
            ?>
        </p>
    </div>
</div>
<div class='wedgit-public'>
    <div class='wedgit-title'>
        Hot Post By comments Number
    </div>
    <div class='wedgit-content'>
        <p>
            <?php
                $hot_args = array(
                    'orderby'   => 'comment_count'
                );

                $hot_post = new wp_query($hot_args);

                if ($hot_post->have_posts())
                {
                    while ($hot_post->have_posts())
                    {
                        $hot_post->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <span class='hot-comment'><?php comments_popup_link('No comments', 'One Comment', '% Comments') ?></span>
                        <?php
                    }
                }
            ?>
        </p>
    </div>
</div>