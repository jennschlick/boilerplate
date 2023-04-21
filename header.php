<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php if (!is_page('home')) : ?><?php wp_title(''); ?> | <?php endif; ?><?php bloginfo('name'); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url(); ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url(); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url(); ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo site_url(); ?>/site.webmanifest">
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<div class="header">
	<a href="<?php echo site_url(); ?>">
		<?php echo get_bloginfo('name'); ?>
	</a>
	<?php wp_nav_menu(array('theme_location' => 'main', 'container' => '')); ?>
</div>