<?php

//  codes used in project
/*

get_queried_object_id()           => to get post ID                                  => single page
global $post                    => another way to get post ID echo $post->ID         => single page
wp_get_post_categories(post ID) => to get the categories of an post                  => single page
get_query_var('paged')          => to get page number---- pagination                 => functions page
paginate_links()                => to make pagination                                => functions page
get_pagenum_link()              => to get the link of n page                         => functions page
%_% and %#%                     => wild card                                         => functions page
register_sidebar(args)          => to register sidebar                               => functions page 
is_active_sidebar('#id')        => check status of sidebar                           => linux page
dynamic_sidebar('#id')          => to add sidebar to special page                    => linux page
get_sidebar('cat-name')         => to custom sidebar                                 => public page
wpautop() 
