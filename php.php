<!-- Show field -->
<?php the_field('field'); ?>

<!-- If/else field -->
<?php if (get_field('field')): ?>
<?php endif; ?>

<?php if (get_field('field')): ?>
<?php else: ?>
<?php endif; ?>

<!-- If/else radio -->
<?php if (get_field('field') == 'radio_value'): ?>
<?php endif; ?>

<?php if (get_field('field') == 'radio_value'): ?>
<?php else: ?>
<?php endif; ?>

<!-- If content is not empty -->
<?php if (!empty(get_the_content())): ?>
<?php endif; ?>

<!-- True/false field -->
<?php if (get_field('field')): ?>
  True
<?php else: ?>
  False
<?php endif; ?>
