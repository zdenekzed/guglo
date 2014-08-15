<?php

function pinboard2_form_system_theme_settings_alter(&$form, $form_state) {

  $form['advansed_theme_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced Theme Settings'),
  );

  $form['advansed_theme_settings']['tm_value_3'] = array(
    '#type' => 'select',
    '#title' => t('Theme Skin'),
    '#default_value' => theme_get_setting('tm_value_3'),
    '#options' => array (
      'blue' => t('Blue'),
	    'gray' => t('Gray'),
	    'green' => t('Green'),
	    'orange' => t('Orange'),
      'red' => t('Red'),
      //'custom' => t('Custom'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_4'] = array(
    '#type' => 'select',
    '#title' => t('Theme Font'),
    '#default_value' => theme_get_setting('tm_value_4'),
    '#options' => array (
      'helvetica' => t('Helvetica Neue'),
      'aller' => t('Aller'),
	    'cabin' => t('Cabin'),
      'carto' => t('Carto'),
      'copse' => t('Copse'),
      'delicious' => t('Delicious'),
      'fontin' => t('Fontin'),
      'mavenpro' => t('Maven Pro'),
      'mido' => t('Mido'),
      'museo' => t('Museo'),
      'ptsans' => t('PT Sans'),
      'qlassik' => t('Qlassik'),
      'quicksand' => t('Quicksand'),
      'titillium' => t('Titillium'),
      'vegur' => t('Vegur'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_5'] = array(
    '#type' => 'select',
    '#title' => t('Theme Background'),
    '#default_value' => theme_get_setting('tm_value_5'),
    '#options' => array (
      '1' => t('Background 1'),
	    '2' => t('Background 2'),
      '3' => t('Background 3'),
      '4' => t('Background 4'),
      '5' => t('Background 5'),
      '6' => t('Background 6'),
      '7' => t('Background 7'),
      '8' => t('Background 8'),
      '9' => t('Background 9'),
      '10' => t('Background 10'),
      '11' => t('Background 11'),
      '12' => t('Background 12'),
      '13' => t('Background 13'),
      '14' => t('Background 14'),
      '15' => t('Background 15'),
      '16' => t('Background 16'),
      '17' => t('Background 17'),
      '18' => t('Background 18'),
      '19' => t('Background 19'),
      '20' => t('Background 20'),
      '21' => t('Background 21'),
      '22' => t('Background 22'),
      '23' => t('Background 23'),
      '24' => t('Background 24'),
      '25' => t('Background 25'),
      '26' => t('Background 26'),
      '27' => t('Background 27'),
      '28' => t('Background 28'),
      '29' => t('Background 29'),
      '30' => t('Background 30'),
      '31' => t('Background 31'),
      '32' => t('Background 32'),
      '33' => t('Background 33'),
      '34' => t('Background 34'),
      '35' => t('Background 35'),
      '36' => t('Background 36'),
      '37' => t('Background 37'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_6'] = array(
    '#type' => 'select',
    '#title' => t('The built in mechanism of animated .gif processing.'),
    '#default_value' => theme_get_setting('tm_value_6'),
    '#description' => t('If you are using another module then disable it. The given function is activated only for effects "Scale" and "Scale and crop" on condition that the given is the only effect for the style.'),
    '#options' => array (
      '0' => t('Disable'),
	    '1' => t('Enable processing'),
	    '2' => t('Enable without processing'),
    ),
  );

  $form['advansed_theme_settings']['tm_value_pinovr'] = array(
    '#type' => 'checkbox',
    '#title' => t('Activate overlay for Pin view'),
    '#default_value' => theme_get_setting('tm_value_pinovr'),
  );
    
  $form['advansed_theme_settings']['tm_value_unfolower'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display Unfollowers on user and pin pages'),
    '#default_value' => theme_get_setting('tm_value_unfolower'),
  ); 

  $form['advansed_theme_settings']['tm_value_repinpromote'] = array(
    '#type' => 'checkbox',
    '#title' => t('Promote repins to front page'),
    '#default_value' => theme_get_setting('tm_value_repinpromote'),
  ); 
  
  $form['advansed_theme_settings']['tm_value_topblank'] = array(
    '#type' => 'checkbox',
    '#title' => t('Open all links from pin page in a new window'),
    '#default_value' => theme_get_setting('tm_value_topblank'),
  ); 

  $form['advansed_theme_settings']['tm_value_repinlink'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add "repin" onto the end of repin page link URL'),
    '#default_value' => theme_get_setting('tm_value_repinlink'),
  ); 
  
  $form['advansed_theme_settings']['tm_value_0'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#default_value' => theme_get_setting('tm_value_0'),
    '#size' => 32,
  );

  $form['advansed_theme_settings']['tm_value_bufferPx'] = array(
    '#type' => 'textfield',
    '#title' => t('bufferPx'),
    '#default_value' => theme_get_setting('tm_value_bufferPx'),
    '#description' => t('Increase this number if you want infscroll to fire quicker'),
    '#size' => 32,
  );
  
  $form['advansed_theme_settings_headlines'] = array(
    '#type' => 'fieldset',
    '#title' => t('Headlines'),
    '#collapsible' => TRUE,
		'#collapsed' => TRUE,
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_no_pins'] = array(
    '#type' => 'textarea',
    '#title' => t('No Pins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_no_pins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_repin'] = array(
    '#type' => 'textarea',
    '#title' => t('Repin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_repin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_login_repin'] = array(
    '#type' => 'textarea',
    '#title' => t('You must login before you can repin.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_login_repin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_plural_repin'] = array(
    '#type' => 'textarea',
    '#title' => t('1 repin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_plural_repin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_plural_repins'] = array(
    '#type' => 'textarea',
    '#title' => t('@count repins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_plural_repins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_view_all_pins'] = array(
    '#type' => 'textarea',
    '#title' => t('View All Pins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_view_all_pins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinned_ago_onto_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinned !data ago onto !board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinned_ago_onto_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinned_ago'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinned !data ago'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinned_ago'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_source'] = array(
    '#type' => 'textarea',
    '#title' => t('Source: !link'),
    '#default_value' => pinboard_helper_const('pinboard_replace_source'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinned_onto_category'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinned onto the category'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinned_onto_category'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_originally_pinned_by'] = array(
    '#type' => 'textarea',
    '#title' => t('Originally pinned by'),
    '#default_value' => pinboard_helper_const('pinboard_replace_originally_pinned_by'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinned_onto_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinned onto the board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinned_onto_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_count_repins'] = array(
    '#type' => 'textarea',
    '#title' => t('!count Repins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_count_repins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_count_more_repins'] = array(
    '#type' => 'textarea',
    '#title' => t('<strong>+!count</strong> more repins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_count_more_repins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_count_likes'] = array(
    '#type' => 'textarea',
    '#title' => t('!count Likes'),
    '#default_value' => pinboard_helper_const('pinboard_replace_count_likes'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_count_more_likes'] = array(
    '#type' => 'textarea',
    '#title' => t('<strong>+!count</strong> more likes'),
    '#default_value' => pinboard_helper_const('pinboard_replace_count_more_likes'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_comment'] = array(
    '#type' => 'textarea',
    '#title' => t('Comment'),
    '#default_value' => pinboard_helper_const('pinboard_replace_comment'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_username_via_onto_category'] = array(
    '#type' => 'textarea',
    '#title' => t('!username via !ousername onto !category'),
    '#default_value' => pinboard_helper_const('pinboard_replace_username_via_onto_category'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_edit'] = array(
    '#type' => 'textarea',
    '#title' => t('Edit'),
    '#default_value' => pinboard_helper_const('pinboard_replace_edit'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_report_pin'] = array(
    '#type' => 'textarea',
    '#title' => t('Report Pin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_report_pin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_username_onto_category'] = array(
    '#type' => 'textarea',
    '#title' => t('!username onto !category'),
    '#default_value' => pinboard_helper_const('pinboard_replace_username_onto_category'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_scroll_to_top'] = array(
    '#type' => 'textarea',
    '#title' => t('Scroll to top'),
    '#default_value' => pinboard_helper_const('pinboard_replace_scroll_to_top'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_my_account'] = array(
    '#type' => 'textarea',
    '#title' => t('My account'),
    '#default_value' => pinboard_helper_const('pinboard_replace_my_account'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_log_out'] = array(
    '#type' => 'textarea',
    '#title' => t('Log out'),
    '#default_value' => pinboard_helper_const('pinboard_replace_log_out'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_log_in'] = array(
    '#type' => 'textarea',
    '#title' => t('Log in'),
    '#default_value' => pinboard_helper_const('pinboard_replace_log_in'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_register'] = array(
    '#type' => 'textarea',
    '#title' => t('Register'),
    '#default_value' => pinboard_helper_const('pinboard_replace_register'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_latest_tweets'] = array(
    '#type' => 'textarea',
    '#title' => t('Latest tweets'),
    '#default_value' => pinboard_helper_const('pinboard_replace_latest_tweets'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_visible_advanced_settings'] = array(
    '#type' => 'textarea',
    '#title' => t('Visible Advanced Settings'),
    '#default_value' => pinboard_helper_const('pinboard_replace_visible_advanced_settings'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_loading_next_posts'] = array(
    '#type' => 'textarea',
    '#title' => t('Loading the next set of posts...'),
    '#default_value' => pinboard_helper_const('pinboard_replace_loading_next_posts'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_no_more_pins_to_load'] = array(
    '#type' => 'textarea',
    '#title' => t('No more pins to load.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_no_more_pins_to_load'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_pinboard'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinboard'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_pinboard'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_addboardpin'] = array(
    '#type' => 'textarea',
    '#title' => t('+ Add'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_addboardpin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_addpinit'] = array(
    '#type' => 'textarea',
    '#title' => t('"Pin It" Button'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_addpinit'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_create_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Create a Board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_create_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_edit_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Edit board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_edit_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('Board Name'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_updated_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('Updated board %name.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_updated_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_create_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('The board !board is created. You can edit board settings <a href="!link">here</a>'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_create_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_delete1_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('Are you sure you want to delete the board %title?'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_delete1_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_delete2_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('Deleting a board will delete all the pins in it. This action cannot be undone.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_delete2_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_delete3_board_name'] = array(
    '#type' => 'textarea',
    '#title' => t('Deleted board %name.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_delete3_board_name'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_follow'] = array(
    '#type' => 'textarea',
    '#title' => t('Follow'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_follow'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_followall'] = array(
    '#type' => 'textarea',
    '#title' => t('Follow All'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_followall'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_unfollow'] = array(
    '#type' => 'textarea',
    '#title' => t('Unfollow'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_unfollow'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_unfollowall'] = array(
    '#type' => 'textarea',
    '#title' => t('Unfollow All'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_unfollowall'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_youfollow'] = array(
    '#type' => 'textarea',
    '#title' => t('You Follow'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_youfollow'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_youunfollow'] = array(
    '#type' => 'textarea',
    '#title' => t('You Unfollow'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_youunfollow'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_followers'] = array(
    '#type' => 'textarea',
    '#title' => t('Followers'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_followers'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_following'] = array(
    '#type' => 'textarea',
    '#title' => t('Following'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_following'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_follower'] = array(
    '#type' => 'textarea',
    '#title' => t('Follower'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_follower'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_unfollower'] = array(
    '#type' => 'textarea',
    '#title' => t('Unfollower'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_unfollower'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_description_board'] = array(
    '#type' => 'textarea',
    '#title' => t('Select the name of the board from the drop down list or type its name to create a new board. The new board will be created automatically according to the name you entered in the field'),
    '#default_value' => pinboard_helper_const('pinboard_replace_description_board'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_flag_this_pin'] = array(
    '#type' => 'textarea',
    '#title' => t('Flag This Pin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_flag_this_pin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_pin_flag'] = array(
    '#type' => 'textarea',
    '#title' => t('Flag This Pin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_pin_flag'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_description_category_default'] = array(
    '#type' => 'textarea',
    '#title' => t('This category will be used for all the pins to be added to this board, if you do not specify a pin for any other category.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_description_category_default'),
  );
  
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_board_help'] = array(
    '#type' => 'textarea',
    '#title' => t('Help'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_board_help'),
  ); 
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_description_board_help'] = array(
    '#type' => 'textarea',
    '#title' => t('<h3>Secret boards</h3><p>You can use secret boards to keep track of holiday gifts, plan a special event, or work on a project you aren’t yet ready to share with the rest of the world. You can keep your secret boards to yourself or invite family and friends to pin with you.</p><p>To create a secret board from the web, visit your profile and select board for editing. Then, click Edit and fill the fields on the bottom of the page using instructions in comments.</p><p>When you add a pin to a secret board, it won’t show up anywhere else on PinBoard—the only place you can see it is on your secret board.  Right now, you can’t make existing boards secret because other people may have already repinned from your board. You can make only newly created boards secret.</p>'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_description_board_help'),
  );  
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_who_can_pin'] = array(
    '#type' => 'textarea',
    '#title' => t('Who can create pins on my board?'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_who_can_pin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_description_who_can_pin'] = array(
    '#type' => 'textarea',
    '#title' => t('<ul><li>Me only. Leave field empty.</li><li>My friends. Create friends list entering their user profile names.</li></ul>'),
    '#default_value' => pinboard_helper_const('pinboard_replace_description_who_can_pin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_who_can_view'] = array(
    '#type' => 'textarea',
    '#title' => t('Who can view my board?'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_who_can_view'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_description_who_can_view'] = array(
    '#type' => 'textarea',
    '#title' => t('<ul><li>All. Leave field empty.</li><li>Me only. Enter your user profile name.</li><li>Me and my friends. Create friends list entering their user profile names.</li></ul>'),
    '#default_value' => pinboard_helper_const('pinboard_replace_description_who_can_view'),
  );
  
  $form['advansed_theme_settings_headlines']['pinboard_replace_error_img_embed'] = array(
    '#type' => 'textarea',
    '#title' => t('You must add an image or a link to the embedded video page'),
    '#default_value' => pinboard_helper_const('pinboard_replace_error_img_embed'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message1'] = array(
    '#type' => 'textarea',
    '#title' => t('Cancel'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message1'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message2'] = array(
    '#type' => 'textarea',
    '#title' => t('We need to remove the StumbleUpon toolbar before you can pin anything. Click OK to do this or Cancel to stay here.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message2'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message3'] = array(
    '#type' => 'textarea',
    '#title' => t('Unfortunately, this website doesn\'t allow pinning. You can contact the website owner with any questions you may have regarding their stance on pinning.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message3'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message4'] = array(
    '#type' => 'textarea',
    '#title' => t('Sorry, can\'t pin directly from %privateDomain%.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message4'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message5'] = array(
    '#type' => 'textarea',
    '#title' => t('Sorry, but we cannot see any big images or videos on this page to pin.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message5'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message6'] = array(
    '#type' => 'textarea',
    '#title' => t('The pinning bookmarklet is now installed! You can click the \"Pin It\" button from your bookmarks to pin images from around the web.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message6'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message7'] = array(
    '#type' => 'textarea',
    '#title' => t('Sorry, cannot pin this image.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message7'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message8'] = array(
    '#type' => 'textarea',
    '#title' => t('Sorry, can\'t pin from non-HTML pages. If you\'re trying to upload an image, please visit !url'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message8'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_pinit_js_message9'] = array(
    '#type' => 'textarea',
    '#title' => t('Pinning is not allowed from this page.\n\n%s% provided the following reason:'),
    '#default_value' => pinboard_helper_const('pinboard_replace_pinit_js_message9'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addboardpin_title1'] = array(
    '#type' => 'textarea',
    '#title' => t('"Pin It" Button'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addboardpin_title1'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addboardpin_title2'] = array(
    '#type' => 'textarea',
    '#title' => t('Upload a Pin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addboardpin_title2'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addboardpin_title3'] = array(
    '#type' => 'textarea',
    '#title' => t('Create a Board'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addboardpin_title3'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message1'] = array(
    '#type' => 'textarea',
    '#title' => t('Drag me to the bookmarks bar'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message1'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message2'] = array(
    '#type' => 'textarea',
    '#title' => t('Pin It'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message2'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message3'] = array(
    '#type' => 'textarea',
    '#title' => t('Add this link to your Bookmarks Bar'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message3'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message4'] = array(
    '#type' => 'textarea',
    '#title' => t('To install the "Pin It" button in your Browser:'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message4'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message5'] = array(
    '#type' => 'textarea',
    '#title' => t('Display your Bookmarks Bar by clicking View &gt; Toolbars &gt; Bookmarks Toolbar'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message5'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message6'] = array(
    '#type' => 'textarea',
    '#title' => t('Drag the "Pin It" button to your Bookmarks Toolbar'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message6'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message7'] = array(
    '#type' => 'textarea',
    '#title' => t('When you are browsing the web, push the "Pin It" button to pin an image'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message7'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_addpinit_message8'] = array(
    '#type' => 'textarea',
    '#title' => t('Once installed in your browser, the "Pin It" button lets you grab an image from any website and add it to one of your pinboards. When you pin from a website, we automatically grab the source link so we can credit the original creator.'),
    '#default_value' => pinboard_helper_const('pinboard_replace_addpinit_message8'),
  );
  
  
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_boards'] = array(
    '#type' => 'textarea',
    '#title' => t('Boards'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_boards'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_likes'] = array(
    '#type' => 'textarea',
    '#title' => t('Likes'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_likes'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_pins'] = array(
    '#type' => 'textarea',
    '#title' => t('Pins'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_pins'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_contact'] = array(
    '#type' => 'textarea',
    '#title' => t('Contact'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_contact'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_unfollowers'] = array(
    '#type' => 'textarea',
    '#title' => t('Unfollowers'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_unfollowers'),
  );
 
 
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_addapin'] = array(
    '#type' => 'textarea',
    '#title' => t('Add a Pin'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_addapin'),
  );
  $form['advansed_theme_settings_headlines']['pinboard_replace_title_addapin_url'] = array(
    '#type' => 'textarea',
    '#title' => t('URL'),
    '#default_value' => pinboard_helper_const('pinboard_replace_title_addapin_url'),
  );
}
