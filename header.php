<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title(' | ', 'true', 'right'); ?><?php bloginfo('name'); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<a href="<?php echo site_url(); ?>"><img src="" alt="<?php echo get_bloginfo('name'); ?>"></a>

<?php wp_nav_menu(array('theme_location' => 'main', 'container' => '')); ?>

<?php if ( is_active_sidebar('header')) : ?>
  <?php dynamic_sidebar('header'); ?>
<?php endif; ?>
