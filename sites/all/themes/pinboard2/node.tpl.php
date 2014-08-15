<?php if (!$page) { ?>
<div id="node-<?php print $node->nid; ?>" class="blog <?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php print render($content['field_image_blog']); ?>
  <h3 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
  <?php print render($title_suffix); ?>
  <div class="info"><?php print $submitted ?></div>
  <?php
    hide($content['comments']);
    hide($content['links']);
    print render($content);
  ?>
  <?php if (!empty($content['links'])) { ?>
    <div class="act"><?php print render($content['links']); ?></div>
  <?php } ?>
  <div class="clr"></div>
</div>
<?php } else { ?>
  <?php
    hide($content['comments']);
    hide($content['links']);
    print render($content);
  ?>
  <div class="clr"></div>
  <?php if (!empty($content['links'])): ?>
    <div class="links"><?php print render($content['links']); ?></div>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>	
<?php } ?>