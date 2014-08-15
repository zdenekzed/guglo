<?php global $user, $base_url, $language; ?>
<?php 
if (theme_get_setting('tm_value_topblank')) {
    $target = '_blank';
} else {
    $target = '_top';
}
$statistics = statistics_get($node->nid);
if (!$statistics) {  
  $statistics['totalcount'] = 0;
}
$count = format_plural($statistics['totalcount'], '1 view', '@count views');
if (isset($content['field_price'][0]['#markup']) and $content['field_price'][0]['#markup']) {
  $cur = pinboard_helper_currency_info();
  if (isset($content['field_currency'][0]['#markup']) and $content['field_currency'][0]['#markup'] and isset($cur[$content['field_currency'][0]['#markup']])) {
    if (isset($cur[$content['field_currency'][0]['#markup']]['symbol_placement']) and $cur[$content['field_currency'][0]['#markup']]['symbol_placement'] == 'after') {
      $content['field_price'][0]['#markup'] = $content['field_price'][0]['#markup'].$cur[$content['field_currency'][0]['#markup']]['symbol'];
    } else {
      $content['field_price'][0]['#markup'] = $cur[$content['field_currency'][0]['#markup']]['symbol'].$content['field_price'][0]['#markup'];
    }
  } else {
    $content['field_price'][0]['#markup'] = '$'.$content['field_price'][0]['#markup'];
  }
}
hide($content['field_currency']);
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
<?php if (!$page and !(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
<?php print pinboard2_render_block_on_pins($node); ?>	  
<div class="pin_box">
  <div class="inbox">
    <div class="photo">
      <?php if ($field_price = render($content['field_price'])) print '<strong class="price">'.$field_price.'</strong>'; ?>
      <div class="action">
        <a href="<?php print $node_url ?>" class="action-pin"></a>
        <?php if (!strip_tags(render($content['field_disable_repins']))) { ?><a class="repin" href="<?php print url(PINBOARD_REPLACE_PATH_REPIN.'/'.$node->nid); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_REPIN'); ?></a><?php } ?><?php print str_replace(array('rate','login-to-like','=node'),array('like','login-to-rate','=node/'.$node->nid),render($content['pinboard_helper_rate_like'])); ?><?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><a class="comment" href="<?php if (user_access('post comments')) { print url("node/$node->nid", array('fragment' => 'comment-form')); } else { print url("user"); } ?>"><?php print t(PINBOARD_REPLACE_COMMENT) ?></a><?php } ?>
      </div>
      <?php print render($content['field_image']); ?><?php if ($field_embed = render($content['field_embed'])) print '<a href="'.$node_url.'" class="video"></a>'.$field_embed; ?>
    </div>
    
    <div class="cont">
      <?php hide($content['field_enable_repins']); hide($content['comments']); hide($content['links']); hide($content['rate_like']); hide($content['field_url']); print render($content); ?>
	  	<div class="stat">
	  	  <span><?php print $count; ?></span>
	  		<?php $rateres = rate_get_results('node', $node->nid, 1); print '<span class="likesresult-'.$node->nid.'">'.$rateres['count'].' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_LIKES').'</span>' ?>
        <?php if ($repins = pinboard_helper_repins_count($node)) { ?><span><?php print format_plural($repins, pinboard_helper_const('PINBOARD_REPLACE_PLURAL_REPIN'), pinboard_helper_const('PINBOARD_REPLACE_PLURAL_REPINS')) ?></span><?php } ?>
        <?php if (isset($node->comment_count) and isset($node->comment) and $node->comment and !($node->comment == 1 and !$node->comment_count)) { ?><span><a href="<?php print url("node/$node->nid", array('fragment' => 'comment-form')) ?>"><?php print format_plural($node->comment_count, '1 comment', '@count comments') ?></a></span><?php } ?>
      </div>
    </div>
  </div>
  <?php if (arg(2) != PINBOARD_REPLACE_PATH_BOARD) { ?>
  <div class="user">
    <?php print $user_picture; ?>
    <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
    if (count($bid)) $bid = $bid[0]; else $bid = 0;
    $bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
    $buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
    if (count($bname)) {
    	$bname = $bname[0];
    	$did = db_select('pinboard_repins')->fields('pinboard_repins', array('did'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
    	if (count($did)) $did = $did[0]; else $did = 0;
    	$nuid = db_select('node')->fields('node', array('uid'))->condition('nid', $did, '=')->execute()->fetchCol();
      if (count($nuid)) $nuid = $nuid[0]; else $nuid = 0;
    	if ($did == $node->nid or $nuid == $node->uid) {
        print pinboard_helper_const('PINBOARD_REPLACE_USERNAME_ONTO_CATEGORY', array('!username' => $name, '!category' => l($bname, 'user/'.$buid[0].'/'.PINBOARD_REPLACE_PATH_BOARD.'/'.$bid)));
      } else {
        $nname = db_select('users')->fields('users', array('name'))->condition('uid', $nuid, '=')->execute()->fetchCol();
        if (count($nname)) $nname = $nname[0]; else $nname = '';
        print pinboard_helper_const('PINBOARD_REPLACE_USERNAME_VIA_ONTO_CATEGORY', array('!username' => $name, '!ousername' => l($nname, 'user/'.$nuid), '!category' => l($bname, 'user/'.$buid[0].'/'.PINBOARD_REPLACE_PATH_BOARD.'/'.$bid))); 
      }?>
    <?php } else { ?>
      <?php print $name; ?>
    <?php } ?>
    </div>
    <?php } else {?>
      <?php if ($url = strip_tags(render($content['field_url']))) { 
        $result = parse_url($url);
				$url = $result['host'];
        ?>  
      <div class="user"><a target="_blank" href="<?php print url($result['scheme'].'://'.$url); ?>"><?php print $url; ?></a></div>
      <?php } ?>
    <?php } ?>
    
  <?php print pinboard2_get_comments(0, $node); ?>
          
  <?php //print '<pre>'. check_plain(print_r($content  , 1)) .'</pre>'; ?>
</div>
        
    
<?php } else { 
if ($node->uid) {
  $acc = user_load($node->uid);
}
if (empty($acc->data['pinboard']['unfollowers'])) { $acc->data['pinboard']['unfollowers'] = 0; }
?>
<div class="body-pin">
  <?php print pinboard2_target_topblank($user_picture); ?>	  
  <div class="actions">
    <?php $destination = drupal_get_destination(); 
    if ($user->uid and $node->uid != $user->uid)
    if (pinboard_helper_isfollow ($node)) 
      print '<a href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$node->uid, array('query' => $destination)).'">'.($language->direction ? pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOW') : '').'<img src="'.$base_url.'/'.drupal_get_path('theme','pinboard2').'/img/button-folow.png" width="20" height="20" />'.(!$language->direction ? pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOW') : '').'</a>';
    else
      print '<a href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$node->uid, array('query' => $destination)).'">'.($language->direction ? pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOW') : '').'<img src="'.$base_url.'/'.drupal_get_path('theme','pinboard2').'/img/button-folow.png" width="20" height="20" />'.(!$language->direction ? pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOW') : '').'</a>';
    ?>
    <?php if (!strip_tags(render($content['field_disable_repins']))) { ?><a target="<?php print $target; ?>" href="<?php print url(PINBOARD_REPLACE_PATH_REPIN.'/'.$node->nid); ?>"><?php if ($language->direction) print pinboard_helper_const('PINBOARD_REPLACE_TITLE_REPIN'); ?><img src="<?php print $base_url.'/'.drupal_get_path('theme','pinboard2'); ?>/img/button-repin.png" width="20" height="20" /><?php if (!$language->direction) print pinboard_helper_const('PINBOARD_REPLACE_TITLE_REPIN'); ?></a><?php } ?>
    <?php if (user_access('edit any '.PINBOARD_REPLACE_PATH_PIN.' content') or (user_access('edit own '.PINBOARD_REPLACE_PATH_PIN.' content') and $user->uid == $node->uid)) { ?><a target="<?php print $target; ?>" href="<?php print url('node/'.$node->nid.'/edit'); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_EDIT'); ?></a><?php } ?>
  </div>  
  <?php print pinboard2_target_topblank($name); ?>
  <div class="stat"><a target="<?php print $target; ?>" href="<?php print url('user/'.$node->uid); ?>"><?php print pinboard_helper_user_boards_count($node->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_BOARDS');?></a> <a target="<?php print $target; ?>" href="<?php print url('user/'.$node->uid.'/'.PINBOARD_REPLACE_PATH_BOARD); ?>"><?php print pinboard_helper_user_pin_count($node->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_PINS');?></a> <span><?php print pinboard_helper_user_like_count($node->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_LIKES');?></span> <a target="<?php print $target; ?>" href="<?php print url('user/'.$node->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWERS); ?>"><?php print pinboard_helper_count_followers($node->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS');?></a> <a target="<?php print $target; ?>" href="<?php print url('user/'.$node->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWING); ?>"><?php print pinboard_helper_count_following($node->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWING');?></a> <span><?php if (theme_get_setting('tm_value_unfolower')) print $acc->data['pinboard']['unfollowers'].' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOWERS');?></span> <span><?php print $count; ?></span></div>
  <?php $bid = db_select('pinboard_repins')->fields('pinboard_repins', array('bid'))->condition('nid', $node->nid, '=')->condition('uid', $node->uid, '=')->execute()->fetchCol();
  if (count($bid)) $bid = $bid[0]; else $bid = 0;
  $bname = db_select('pinboard_boards')->fields('pinboard_boards', array('name'))->condition('bid', $bid, '=')->execute()->fetchCol();
  $buid = db_select('pinboard_boards')->fields('pinboard_boards', array('uid'))->condition('bid', $bid, '=')->execute()->fetchCol();
  if (count($bname)) {
    $bname = $bname[0]; ?>
    <p class="info"><?php print pinboard_helper_const('PINBOARD_REPLACE_PINNED_AGO_ONTO_BOARD', array('!data' => format_interval(time() - $node->created), '!board' => l($bname, 'user/'.$buid[0].'/'.PINBOARD_REPLACE_PATH_BOARD.'/'.$bid, array('attributes' => array('target' => $target))))); ?></p>
  <?php } else { ?>
	  <p class="info"><?php print pinboard_helper_const('PINBOARD_REPLACE_PINNED_AGO', array('!data' => format_interval(time() - $node->created))); ?></p>
	<?php } ?>
	  
  <div class="pin-image">
    <?php if ($field_price = render($content['field_price'])) print '<strong class="price">'.$field_price.'</strong>'; ?>
    <?php if ($url = strip_tags(render($content['field_url']))) { ?>  
	    <a target="_blank" href="<?php print url($url); ?>"><?php print render($content['field_image']); ?></a>
    <?php } else { ?>  
      <?php print render($content['field_image']); ?>
    <?php } ?>  
    <?php print render($content['field_embed']); ?>
  </div>
  <div class="pin-des">
    <?php if ($url = strip_tags(render($content['field_url']))) { 
      print '<p>'.pinboard_helper_const('PINBOARD_REPLACE_SOURCE', array('!link' => '<a target="_blank" href="'.url($url).'">'.pinboard2_truncate_utf8($url, 80, FALSE, TRUE).'</a>')).'</p>';
    } ?>
    <?php hide($content['field_enable_repins']); hide($content['comments']); hide($content['links']); hide($content['field_category']); hide($content['field_tags']); hide($content['sharethis']); hide($content['rate_like']); hide($content['pinboard_helper_rate_like']); print pinboard2_target_topblank(render($content)); ?>
    
    <?php if ($blocksad = block_get_blocks_by_region('sidebar_ad')) {?>
	    <div class="ad">
	     <?php print pinboard2_target_topblank(render($blocksad)); ?>
	    </div>
	  <?php } ?>
  </div>
  <?php print str_replace('</div>','</div> ',pinboard2_target_topblank(render($content['field_category']))); ?>
  <?php print str_replace('</div>','</div> ',pinboard2_target_topblank(render($content['field_tags']))); ?>
  <div class="clr"></div>
  <div class="rate-like-block"><?php print str_replace(array('rate','login-to-like'),array('like','login-to-rate'), render($content['pinboard_helper_rate_like'])); ?></div>
  <?php 
    drupal_add_js('misc/collapse.js');
    $pinboard_helper_flag_form = drupal_get_form('pinboard_helper_flag_form');
    print '<fieldset class="collapsible collapsed form-wrapper flags" id="pin-flags"><legend><span class="fieldset-legend">'.
    ($language->direction ? pinboard_helper_const('PINBOARD_REPLACE_REPORT_PIN') : '').
    '<img src="'.$base_url.'/'.drupal_get_path('theme','pinboard2').'/img/ico-flag.png" />'.
    (!$language->direction ? pinboard_helper_const('PINBOARD_REPLACE_REPORT_PIN') : '').
    '</span></legend><div class="fieldset-wrapper">'.
    t(variable_get('user_mail_register_pinboard_helper_flag_text', PINBOARD_HELPER_FLAG_PIN_TEXT)).
    render($pinboard_helper_flag_form).
    '</div></fieldset>'; 
  ?>
  <div class="clr"></div>
  <?php print render($content['sharethis']); ?>
  
  <?php if (!empty($content['links']) and false): ?>
    <div class="links"><?php print pinboard2_target_topblank(render($content['links'])); ?></div>
  <?php endif; ?>
  <?php if (!(arg(0) == 'comment' and arg(1) == 'reply')){ ?>
    <?php print pinboard2_target_topblank(render($content['comments'])); ?>
	  <?php //print '<pre>'. check_plain(print_r($content, 1)) .'</pre>'; ?>
	    
    <?php
    $view_name = 'pinned_onto_the_board';
    $display_id = 'block';
    if ($view = views_get_view($view_name)) {
      if ($view->access($display_id)) {
        $output = $view->execute_display($display_id);
        $view->destroy();
        if ($output['content']) {
          print '<div class="pin-block-category">';
          $viewargs = explode(',', $view->args[0]);
          if (empty($viewargs[0])) $viewargs[0] = 0;
          $viewurl = url('taxonomy/term/'.$viewargs[0]);
          print '<h5>'.pinboard_helper_const('PINBOARD_REPLACE_PINNED_ONTO_CATEGORY').'</h5><h4><a target="'.$target.'" href="'.$viewurl.'">'.$output['subject'].'</a></h4>';
	        print str_replace('!taxonomy_term', $viewurl, $output['content']);
	        print '</div><div class="clr"></div>';
	      }
      }
      $view->destroy();
    }
    ?>
    <?php //print '<pre>'. check_plain(print_r($view, 1)) .'</pre>'; ?>
	    
	    
	  <?php if ($node->uid and $originally_pinned = pinboard2_originally_pinned($node)) { ?>
	    <div class="pin-block-originally">
	    <?php print '<h5>'.pinboard_helper_const('PINBOARD_REPLACE_ORIGINALLY_PINNED_BY').'</h5><h4><a target="'.$target.'" href="'.url('user/'.$node->ph_uid).'">'.$node->ph_name.'</a></h4>'; ?>
	    <a target="<?php print $target; ?>" href="<?php print url('user/'.$node->ph_uid); ?>"><?php print $originally_pinned; ?></a>
	    </div>
	  <?php } ?>
	    
	    
     <?php if ($node->uid and $pinned_onto = pinboard2_pinned_onto_board($node)) { ?>
	      <div class="pin-block-board">
	      <?php print '<h5>'.pinboard_helper_const('PINBOARD_REPLACE_PINNED_ONTO_BOARD').'</h5><h4><a target="'.$target.'" href="'.url('user/'.$node->uid.'/'.PINBOARD_REPLACE_PATH_BOARD.'/'.$node->ph_bid).'">'.$node->ph_bname.'</a></h4>'; ?>
	      <a target="<?php print $target; ?>" href="<?php print url('user/'.$node->uid.'/board/'.$node->ph_bid); ?>"><?php print $pinned_onto; ?></a>
	      </div><div class="clr"></div>
	    <?php } ?>
	    

     <?php if ($repins_users = pinboard2_repins_users_out($node)) { ?>
	      <div class="pin-block-category">
	      <?php $count = pinboard2_repins_users_count($node);
	      print '<h4>'.pinboard_helper_const('PINBOARD_REPLACE_COUNT_REPINS', array('!count' => $count)).'</h4>'; ?>
	      <?php print $repins_users; ?>
	      <?php $ecount = $count - 12;
	      print ($ecount > 0 ? '<p class="more_activity">'.pinboard_helper_const('PINBOARD_REPLACE_COUNT_MORE_REPINS', array('!count' => $ecount)).'</p>' : '');
	      ?>
	      </div><div class="clr"></div>
	    <?php } ?>
	    
     <?php if ($like_box = pinboard2_like_box_out($node)) { ?>
	      <div class="pin-block-category">
	      <?php $count = pinboard2_like_box_count($node);
	      print '<h4>'.pinboard_helper_const('PINBOARD_REPLACE_COUNT_LIKES', array('!count' => $count)).'</h4>'; ?>
	      <?php print $like_box; ?>
	      <?php $ecount = $count - 12;
	      print ($ecount > 0 ? '<p class="more_activity">'.pinboard_helper_const('PINBOARD_REPLACE_COUNT_MORE_LIKES', array('!count' => $ecount)).'</p>' : '');
	      ?>
	      </div><div class="clr"></div>
	    <?php } ?>
  <?php } ?>
</div>
      <?php //print '<pre>'. check_plain(print_r($content['field_currency'], 1)) .'</pre>'; ?>	    
<?php } ?>
</div>