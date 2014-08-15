<div class="comment_box">
<?php print pinboard_target_top($picture) ?>
<p><?php print pinboard_target_top(theme('username', array('account' => $content['comment_body']['#object']))) ?><?php print pinboard_target_top(render($content)) ?></p>
</div>
<?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>