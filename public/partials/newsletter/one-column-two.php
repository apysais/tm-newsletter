<?php if ( $posts ) : ?>
  <?php if ( count($posts) > 1 ) : ?>
    <?php
      $first_post[] = $posts[0];
      $data['posts'] = $first_post;
    ?>

    <?php TNL_NewsLetter_TemplateColumn::get_instance()->showOneColumn($data); ?>

    <?php
      unset($posts[0]);
      $data['posts'] = $posts;
      TNL_NewsLetter_TemplateColumn::get_instance()->showTwoColumn($data);
    ?>

  <?php endif; ?>
<?php endif; ?>
