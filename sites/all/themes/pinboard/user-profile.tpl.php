<?php global $base_url; 
if (arg(1)) {
  $acc = user_load(arg(1));
}
$destination = drupal_get_destination();

?>
<?php if (!(isset($_GET['mob']) and $_GET['mob'] and arg(2))) { ?>
<div id="sidebar-first" class="four columns">
  <div class="section">
      <div class="region region-sidebar-first">
        <div id="profile_bar"><div class="profile_bar_in clearfix">
          <?php if (isset($_GET['mob']) and $_GET['mob']) { ?>
        
        	  <div class="profile_image"><?php print render($user_profile['user_picture']); ?></div>
        	  <h1><?php print $acc->name; ?></h1>
        	  <p>
						  <a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWERS); ?>"><?php print pinboard_helper_count_followers($acc->uid);?><span> <?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS');?></span></a>,
						  <a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWING); ?>"><?php print pinboard_helper_count_following($acc->uid);?><span> <?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWING');?></span></a>
					  </p>
					  <div class="follow_all_button_cont"><a class="follow_all_button" href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_BOARD); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_VIEW_ALL_PINS'); ?></a></div>
        	  <?php if ($user->uid and $acc->uid != $user->uid) 
          	  if (pinboard_helper_isfollow($acc)) 
            	  print '<div class="follow_all_button_cont"><a class="follow_all_button" href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOWALL').'</a></div>';
          	  else
            	  print '<div class="follow_all_button_cont"><a class="follow_all_button" href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWALL').'</a></div>';
        	  ?>
        	
          <?php } else { ?>
        
            <h1><?php print $acc->name; ?></h1>
            <p>
          		<a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWERS); ?>"><?php print pinboard_helper_count_followers($acc->uid);?><span> <?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS');?></span></a>,
          		<a href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_FOLLOWING); ?>"><?php print pinboard_helper_count_following($acc->uid);?><span> <?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWING');?></span></a>
        		</p>
        		<div class="profile_image"><?php print str_replace(array('s=50','user_picture','width="50"','height="50"'),array('s=192','user_picture_big','width="192"',''),render($user_profile['user_picture'])); ?></div>
        		<div class="follow_all_button_cont"><a class="follow_all_button" href="<?php print url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_BOARD); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_VIEW_ALL_PINS'); ?></a></div>
        		<?php if ($user->uid and $acc->uid != $user->uid) 
          	if (pinboard_helper_isfollow($acc)) 
            	print '<div class="follow_all_button_cont"><a class="follow_all_button" href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOWALL').'</a></div>';
          	else
            	print '<div class="follow_all_button_cont"><a class="follow_all_button" href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$acc->uid, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWALL').'</a></div>';
        		?>
		    		<div class="aboutuser"><?php print render($user_profile['field_aboutuser']); ?></div>
		    		<ul class="profile_links">
          		<?php if ($field_facebook = strip_tags(render($user_profile['field_facebook']))) { ?><li id="profile_links_facebook">
			      	<a target="_blank" class="Button Button13 WhiteButton" href="<?php print $field_facebook; ?>">
				      	<strong><img alt="Link to Facebook Account" src="<?php print $base_url.'/'.path_to_theme(); ?>/img/social_icons/icon_facebook.png"></strong>
				      	<span></span>
			      	</a>
			    		</li><?php } ?>
          		<li id="profile_links_rss">
            		<a class="Button Button13 WhiteButton" href="<?php print url('user/'.$acc->uid.'/feed.rss'); ?>">
              		<strong><img alt="Link to RSS Feed" src="<?php print $base_url.'/'.path_to_theme(); ?>/img/social_icons/icon_rss.png"></strong>
              		<span></span>
            		</a>
			    		</li>
			    		<?php if ($field_twitter = strip_tags(render($user_profile['field_twitter']))) { ?><li id="profile_links_twitter">
            		<a target="_blank" class="Button Button13 WhiteButton" href="http://twitter.com/<?php print $field_twitter; ?>">
              		<strong><img alt="twitter" src="<?php print $base_url.'/'.path_to_theme(); ?>/img/social_icons/icon_twitter.png"></strong>
              		<span></span>
            		</a>
          		</li><?php } ?>
          		<?php if (false) { ?>
          		<li id="profile_links_lj">
            		<a class="Button Button13 WhiteButton" href="<?php print url('user/'.$acc->uid.'/contact'); ?>">
              		<strong><img alt="Contact" src="<?php print $base_url.'/'.path_to_theme(); ?>/img/social_icons/icon_lj.png"></strong>
              		<span></span>
            		</a>
          		</li>
          		<?php } ?>
		    		</ul>
		    		<?php if ($field_twitter) { ?>
		    			<div class="follow_all_button_cont"><a class="follow_all_button" href="http://twitter.com/<?php print $field_twitter; ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_LATEST_TWEETS'); ?></a></div>
							<div class="widget-twitter activity" data-username="<?php print $field_twitter; ?>" data-count="5" data-retweets="true">
								<div class="tweets"></div>
							</div>
						<?php } ?>
		  		<?php } ?>
      	</div>
      </div>
    </div>
  </div>
</div>
<?php } ?>	
<div id="content" class="twelve columns"><div class="section">
  <div class="region region-content">
    
      <?php print pinboard_helper_userpage_pins (); ?>
    	    
      </div>
    </div>
  </div>      
</div></div> <!-- /.section, /#content -->

<?php 

//unset($user_profile['field_about']);
//unset($user_profile['user_picture']);
//unset($user_profile['field_name']);
//unset($user_profile['userpoints']);
//unset($user_profile['field_location']);
//unset($user_profile['field_url']);
//unset($user_profile['summary']);
//unset($user_profile['simplenews']);
//unset($user_profile['field_birthdayu']);
//print '<div class="user_profile_main"><pre>'. check_plain(print_r($user, 1)) .'</pre></div>'; 

?>