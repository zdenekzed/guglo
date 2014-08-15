<?php if ($content['#node']->comment and !($content['#node']->comment == 1 and $content['#node']->comment_count)) { ?>
<div class="comments">
  <?php print render($content['comments']); ?>
  <?php if ($comment_form = render($content['comment_form'])) { ?>
  <div id="comment-form" class="comment-form comment_box">
    <h4><?php print t('Leave a Comment'); ?></h4>
    <?php print str_replace('resizable', '', pinboard_target_top($comment_form)); ?>
  </div>
  <?php } ?>
</div>
<?php } ?>