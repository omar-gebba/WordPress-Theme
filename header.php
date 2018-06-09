<!DOCTYPE html>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title>
      <?php wp_title('=>', 'true', 'right') ?>
      <?php bloginfo('name'); ?>
    </title>
    <link rel="pingback" href="<?php bloginfo('pingpack_url') ?>" />
    <?php wp_head(); ?>
</head>
    <body>

    <!-- navbar version 4.1-->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class='container'>
  <a class="navbar-brand" href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <?php Add_nav_bar(); ?>
  </div>
  </div>
</nav>
        

