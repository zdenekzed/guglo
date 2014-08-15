<?php global $base_url, $user; 
if (arg(1)) {
  $acc = user_load(arg(1));
}
if (empty($acc->data['pinboard']['unfollowers'])) { $acc->data['pinboard']['unfollowers'] = 0; }
$destination = drupal_get_destination();
$field_twitter = strip_tags(render($user_profile['field_twitter']));
//if (isset($_GET['mob']) and $_GET['mob']) { 
?>
<?php if (!(isset($_GET['mob']) and $_GET['mob'] and arg(2))) { ?>
<div class="top-profile-block">
  <div class="left"> 
    <?php print render($user_profile['user_picture']); ?> 
  </div>
    <?php if (isset($user_profile['field_twitter_widget']['#items'][0]['value'])) { ?>
    <div class="right">
			<?php print $user_profile['field_twitter_widget']['#items'][0]['value']; ?>
    </div>
  <?php } ?>
  <div class="center">
    <h1><?php print $acc->name; ?></h1>
    <div class="stat"><a href="<?php print url('user/'.$acc->uid); ?>"><?php print pinboard_helper_user_boards_count($acc->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_BOARDS');?></a><a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_BOARD); ?>"><?php print pinboard_helper_user_pin_count($acc->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_PINS');?></a><span><?php print pinboard_helper_user_like_count($acc->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_LIKES');?></span><a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWERS); ?>"><?php print pinboard_helper_count_followers($acc->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS');?></a><a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWING); ?>"><?php print pinboard_helper_count_following($acc->uid).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWING');?></a><span><?php if (theme_get_setting('tm_value_unfolower')) print $acc->data['pinboard']['unfollowers'].' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOWERS');?></span></div>
    <div class="actions">
      <?php if (isset($acc) and $user->uid and $acc->uid != $user->uid) 
        if (pinboard_helper_isfollow($acc)) 
          print '<a href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOWALL').'</a>';
        else
          print '<a href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWALL').'</a>';
      ?>
      <a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_BOARD); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_VIEW_ALL_PINS'); ?></a>
      <?php if (isset($acc) and $user->uid and $acc->uid != $user->uid) { ?><a href="<?php print url('user/'.$acc->uid.'/contact'); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_CONTACT'); ?></a><?php } ?>
      <?php if ($field_facebook = strip_tags(render($user_profile['field_facebook']))) { ?><a href="<?php print $field_facebook; ?>"><?php print t('Facebook'); ?></a><?php } ?>
      <?php if ($field_twitter) { ?><a href="http://twitter.com/<?php print $field_twitter; ?>"><?php print t('Twitter'); ?></a><?php } ?>
      <a href="<?php print url('user/'.$acc->uid.'/feed.rss'); ?>"><?php print t('RSS'); ?></a>
    </div> 
    <p><?php print render($user_profile['field_aboutuser']); ?></p> 
  </div>

</div>
<div class="clr"></div>
<?php } ?>
<?php print pinboard2_userpage_pins (); ?>

<?php 

// unset($user_profile['field_about']);
// unset($user_profile['user_picture']);
// unset($user_profile['field_name']);
// unset($user_profile['userpoints']);
// unset($user_profile['field_location']);
// unset($user_profile['field_url']);
// unset($user_profile['summary']);
// unset($user_profile['simplenews']);
// unset($user_profile['field_birthdayu']);
// print '<div class="user_profile_main"><pre>'. check_plain(print_r($user_profile['field_twitter_widget'], 1)) .'</pre></div>'; 

?>