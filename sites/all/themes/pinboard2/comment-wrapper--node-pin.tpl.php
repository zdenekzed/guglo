<?php 
global $user;
if ($content['#node']->comment and !($content['#node']->comment == 1 and $content['#node']->comment_count)) { ?>
<div class="comments">
  <h6><?php print t('Comments'); ?></h6>
  <?php print render($content['comments']); ?>
  <?php hide($content['comment_form']['author']); ?>
  <?php if ($comment_form = render($content['comment_form'])) { ?>
    <div class="commentform">
      <?php $author = render($content['comment_form']['author']);
      if ($user->uid) { ?>
        <?php print theme('user_picture', array('account' => $user)); ?>
        <div class="aut"><?php print $author; ?></div>
        <div class="info"><?php print t('Leave your comment bellow'); ?></div>
      <?php } else { ?>
        <h6><?php print t('Leave your comment below'); ?></h6>
        <?php print $author; ?>
      <?php } ?>
      <?php print str_replace('resizable', '', pinboard2_target_top($comment_form)); ?>              
    </div>
  <?php } ?>
</div>
<?php //print '<pre>'. check_plain(print_r($content['comment_form']['author'], 1)) .'</pre>'; ?>
<?php } ?>