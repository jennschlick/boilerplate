<?php wp_nav_menu(array('theme_location' => 'footer', 'container' => '')); ?>

<?php if ( is_active_sidebar('footer')) : ?>
  <?php dynamic_sidebar('footer'); ?>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
