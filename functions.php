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
/* End custom menu */

// change length of excerpt function 
function customize_excerpt_length()
{
    if (is_author())
    {
        return 20;
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
