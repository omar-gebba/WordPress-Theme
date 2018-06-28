<?php

require_once('wp_bootstrap_nav_walker.php');
// Enable featured image support

add_theme_support( 'post-thumbnails' ); 
/*
function to add custom style
1-
get_template_directory_uri();  Gget the template path.

2-
wp_enqueue_style( string $handle, string $src = '', array $deps = array(),
string|bool|null $ver = false, bool $in_footer = false );  include the custom styles.

*/

function Add_style() 
{
    wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('fontawesom_CSS', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('main_css', get_template_directory_uri() . '/css/main.css');
}
/*
// function to add custom script
3-
wp_enqueue_script( string $handle, string $src = '', array $deps = array(),
string|bool|null $ver = false, bool $in_footer = false );  include the custom scripts.
*/
function Add_script()
{
    //  how to include the registered plugins such as jquery in footer
        // first do deregistration for jquery
            wp_deregister_script('jquery');
        // then register jquery in footer {don't forget to put true in index of in_footer}
            wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, false, true);
        // finaly enqueue jquery
            wp_enqueue_script('jquery');


    wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('main_js', get_template_directory_uri() . '/js/main.js', array(), false, true);
    
    // include html5shiv..BUT this should be in header before creating the element {in_footer==false}
    wp_enqueue_script('html5shiv-js', get_template_directory_uri() . '/js/html5shiv.min.js');
    wp_script_add_data('html5shiv-js', 'conditional', 'lt IE 9');
    // include respond .. BUT this should be in header before creating the element {in_footer==false}
    wp_enqueue_script('respond-js', get_template_directory_uri() . '/js/respond.min.js');
    wp_script_add_data('respond-js', 'conditional', 'lt IE 9');
}

/* Add custom menu */ 
function Add_custom_nav()
{
    register_nav_menus(array(
        'bootstrap-menu'  => 'nav-menu',
        'footer-menu'     => 'footer-menu',
    ));
}
function Add_nav_bar()
{
    wp_nav_menu(array(
        'theme_location'    => 'bootstrap-menu',
        'menu_class'        => 'nav navbar-nav navbar-right',
        'depth'             => 3,
        'container'         => false,
        'walker'            => new WP_Bootstrap_Navwalker(),

    ));
}
 function Add_sidebar()         // function to add sidebar
 {
     $sidebar_args = array(
         'name'         => 'side_bar',
         'id'           => 'main_sidebar',
         'description'  => 'main side bar appear every where',
         'class'        => 'main_sidebar',
         'before_widget'=> '<div class="wedgit-content">',
         'after_widget' => '</div>',
         'before_title' => '<h3 class="wedgit-title">',
         'after_title'  => '</h3>'
     );
     register_sidebar($sidebar_args);
 }
/* End custom menu */

// change length of excerpt function 
function customize_excerpt_length()
{
    if (is_author())
    {
        return 20;
    }
    elseif (is_category())
    {
        return 50;
    }
    elseif (is_category( '2' )) // not working
    {
        return 10;
    }
    else
    {
        return 30;
    }
}
// change more tag
function customize_excerpt_more()
{
    return '  ......';
} 
add_filter('excerpt_length', 'customize_excerpt_length');
add_filter('excerpt_more', 'customize_excerpt_more');


//////////////////////////////////////////////////////////////////////////////////////////////////
//add actions

    // Add Style
    add_action('wp_enqueue_scripts','Add_style');
    // Add script
    add_action('wp_enqueue_scripts','Add_script');
    // Add custom nav-bar
    add_action('init', 'Add_custom_nav');
    // add sidebar
    add_action( 'widgets_init', 'Add_sidebar' );
    // add sidebar

   
////// custom function 

  // function to echo avatar 

        // get_avatar( mixed $id_or_email, int $size = 96, string $default = '',
        //              string $alt = '', array $args = null )
  function the_avatar()
  {
    $avatar_args = array(
        'class' => 'img img-circle img-responsive img-sumbnail'
    );
      echo  get_avatar(get_the_author_meta('ID'), 40, '', 'avatar', $avatar_args);
  }

  ////// function to make pagination with wordpress codes

  function numbering_pgination()
  {
      global $wp_query;

      $all_pages    = $wp_query->max_num_pages;

      $current_page = max(1, get_query_var('paged'));  // => get current page

      if ($all_pages > 1)
      {
          return paginate_links(array(
                                    'base'               => get_pagenum_link() . '%_%',
                                    'format'             => '?paged=%#%',
                                    'total'              => $all_pages,
                                    'current'            => $current_page,
                                    'show_all'           => false,
                                    'end_size'           => 1,
                                    'mid_size'           => 2,
                                    'prev_next'          => true,
                                    'prev_text'          => __('« Previous'),
                                    'next_text'          => __('Next »'),
                                    'type'               => 'plain',
                                    'add_args'           => false,
                                    'add_fragment'       => '',
                                    'before_page_number' => '',
                                    'after_page_number'  => ''
                            ));
      }
  }
function comments_count() //   function to count comments in special category => made by Omar
{
    if (get_category(get_queried_object_id())->count != 0)
    {
        $post_ids = get_posts(array(
            'posts_per_page'    => -1, // to return all posts
            'offset'            => 0,
            'fields'            => 'ids', // Only get post IDs
            'category'          => get_cat_ID(single_cat_title($prefix = '', $display = false)),
            'category_name'     => single_cat_title($prefix = '', $display = false),
        ));

        $comments_args = array(
            'post__in'          => $post_ids,
            'count'             => true,
        );
        echo get_comments($comments_args);
    }
    else
    {
        echo 0;
    }
}
function comments_count2()//another function to count comments in special category => made by El-Zero
{
    $comment_count = 0;

    $comments_count_arrgs = array(
        'status'   => 'approve',
    );
                   
    $all_comments = get_comments($comments_count_arrgs);

    foreach ($all_comments as $comment)
    {
        $post_id = $comment->comment_post_ID;

        if (in_category(single_cat_title($prefix = '', $display = false), $post_id))
        {
            $comment_count++;
        }
        else
        {
            continue;
        }
    }
    echo $comment_count;
}

