<div class="tm-loop-container">
  <div class="list-unstyled list-item-container <?php echo isset($data['template']) ? $data['template']:'';?>">

    <?php
      //tnl_dd($data);
      //tnl_debug_print($data);
      TNL_NewsLetter_TemplateColumn::get_instance()->showByColumns($data);
    ?>

  </div>
</div>
