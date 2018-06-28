<?php $all_cats = get_the_category();?>

<div class='breadcrumb-holder'>
    <div class='container'>
        <ol class='breadcrumb'>
            <li>
                <a href="<?php bloginfo('url');?>"><?php bloginfo('name') ?></a> <span> / </span>
            </li>
            <li>
                <a href="<?php echo esc_url(get_category_link($all_cats[0]->term_id)); ?>"><?php echo esc_html($all_cats[0]->name); ?> </a><span> / </span>
            </li>
            <li class='active'>
                <?php the_title(); ?>
            </li>
        </ol>
    </div>
</div>