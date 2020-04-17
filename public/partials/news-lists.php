<div class="shortcod-news-article-container bootstrap-iso">

  <div class="container-fluid">

      <?php
        TNL_NewsLetter_TemplateColumn::get_instance()->showByColumns([
    			'template' => $template,
    			'posts' => $posts
    		]);
      ?>

  </div>

</div>
