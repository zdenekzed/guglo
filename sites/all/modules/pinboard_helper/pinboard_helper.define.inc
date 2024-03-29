<?php
define('PINBOARD_REPLACE_PATH_PIN', 'pin'); //The given parameter must match the machine name of the content type that is used for pins. Beside changing this parameter here and in the content type it’s also necessary also to make changes to the Views that use the given content type (Gifts, Node, Pinned onto the category, Popular, Search, Taxonomy term, User Feed, Video)

define('PINBOARD_REPLACE_TITLE_NO_PINS', 'No Pins');
define('PINBOARD_REPLACE_PATH_REPIN', 'repin');
define('PINBOARD_REPLACE_TITLE_REPIN', 'Repin');
define('PINBOARD_REPLACE_TITLE_LOGIN_REPIN', 'You must login before you can repin.');
define('PINBOARD_REPLACE_PLURAL_REPIN', '1 repin');
define('PINBOARD_REPLACE_PLURAL_REPINS', '@count repins');
define('PINBOARD_REPLACE_TITLE_VIEW_ALL_PINS', 'View All Pins');
define('PINBOARD_REPLACE_PINNED_AGO_ONTO_BOARD', 'Pinned !data ago onto !board');
define('PINBOARD_REPLACE_PINNED_AGO', 'Pinned !data ago');
define('PINBOARD_REPLACE_SOURCE', 'Source: !link');
define('PINBOARD_REPLACE_PINNED_ONTO_CATEGORY', 'Pinned onto the category');
define('PINBOARD_REPLACE_ORIGINALLY_PINNED_BY', 'Originally pinned by');
define('PINBOARD_REPLACE_PINNED_ONTO_BOARD', 'Pinned onto the board');
define('PINBOARD_REPLACE_COUNT_REPINS', '!count Repins');
define('PINBOARD_REPLACE_COUNT_MORE_REPINS', '<strong>+!count</strong> more repins');
define('PINBOARD_REPLACE_COUNT_LIKES', '!count Likes');
define('PINBOARD_REPLACE_COUNT_MORE_LIKES', '<strong>+!count</strong> more likes');
define('PINBOARD_REPLACE_COMMENT', 'Comment');
define('PINBOARD_REPLACE_USERNAME_VIA_ONTO_CATEGORY', '!username via !ousername onto !category');
define('PINBOARD_REPLACE_EDIT', 'Edit');
define('PINBOARD_REPLACE_REPORT_PIN', 'Report Pin');
define('PINBOARD_REPLACE_USERNAME_ONTO_CATEGORY', '!username onto !category');
define('PINBOARD_REPLACE_SCROLL_TO_TOP', 'Scroll to top');
define('PINBOARD_REPLACE_MY_ACCOUNT', 'My account');
define('PINBOARD_REPLACE_LOG_OUT', 'Log out');
define('PINBOARD_REPLACE_LOG_IN', 'Log in');
define('PINBOARD_REPLACE_REGISTER', 'Register');
define('PINBOARD_REPLACE_LATEST_TWEETS', 'Latest tweets');
define('PINBOARD_REPLACE_VISIBLE_ADVANCED_SETTINGS', 'Visible Advanced Settings');
define('PINBOARD_REPLACE_NO_MORE_PINS_TO_LOAD', 'No more pins to load.');
define('PINBOARD_REPLACE_PROGRESS_IMG', '/sites/all/themes/pinboard2/img/load.gif');

define('PINBOARD_REPLACE_PATH_PINBOARD', 'pinboard');
define('PINBOARD_REPLACE_TITLE_PINBOARD', 'Pinboard');
define('PINBOARD_REPLACE_PATH_ADDBOARDPIN', 'addboardpin');
define('PINBOARD_REPLACE_TITLE_ADDBOARDPIN', '+ Add');
define('PINBOARD_REPLACE_PATH_PINIT', 'pinit');
define('PINBOARD_REPLACE_PATH_ADDPINIT', 'addpinit');
define('PINBOARD_REPLACE_TITLE_ADDPINIT', '"Pin It" Button');

define('PINBOARD_REPLACE_PATH_BOARD', 'board');
define('PINBOARD_REPLACE_TITLE_BOARD', 'Board');
define('PINBOARD_REPLACE_TITLE_CREATE_BOARD', 'Create a Board');
define('PINBOARD_REPLACE_TITLE_EDIT_BOARD', 'Edit board');
define('PINBOARD_REPLACE_TITLE_BOARD_NAME', 'Board Name');
define('PINBOARD_REPLACE_TITLE_UPDATED_BOARD_NAME', 'Updated board %name.');
define('PINBOARD_REPLACE_TITLE_CREATE_BOARD_NAME', 'The board !board is created. You can edit board settings <a href="!link">here</a>');
define('PINBOARD_REPLACE_TITLE_DELETE1_BOARD_NAME', 'Are you sure you want to delete the board %title?');
define('PINBOARD_REPLACE_TITLE_DELETE2_BOARD_NAME', 'Deleting a board will delete all the pins in it. This action cannot be undone.');
define('PINBOARD_REPLACE_TITLE_DELETE3_BOARD_NAME', 'Deleted board %name.');

define('PINBOARD_REPLACE_PATH_FOLLOW', 'follow');
define('PINBOARD_REPLACE_TITLE_FOLLOW', 'Follow');
define('PINBOARD_REPLACE_TITLE_FOLLOWALL', 'Follow All');
define('PINBOARD_REPLACE_PATH_UNFOLLOW', 'unfollow');
define('PINBOARD_REPLACE_TITLE_UNFOLLOW', 'Unfollow');
define('PINBOARD_REPLACE_TITLE_UNFOLLOWALL', 'Unfollow All');
define('PINBOARD_REPLACE_PATH_YOUFOLLOW', 'youfollow');
define('PINBOARD_REPLACE_TITLE_YOUFOLLOW', 'You Follow');
define('PINBOARD_REPLACE_TITLE_YOUUNFOLLOW', 'You Unfollow');
define('PINBOARD_REPLACE_PATH_FOLLOWERS', 'followers');
define('PINBOARD_REPLACE_TITLE_FOLLOWERS', 'Followers');
define('PINBOARD_REPLACE_PATH_FOLLOWING', 'following');
define('PINBOARD_REPLACE_TITLE_FOLLOWING', 'Following');
define('PINBOARD_REPLACE_TITLE_FOLLOWER', 'Follower');
define('PINBOARD_REPLACE_TITLE_UNFOLLOWER', 'Unfollower');

define('PINBOARD_REPLACE_DESCRIPTION_BOARD', 'Select the name of the board from the drop down list or type its name to create a new board. The new board will be created automatically according to the name you entered in the field');
define('PINBOARD_REPLACE_TITLE_FLAG_THIS_PIN', 'Flag This Pin');
define('PINBOARD_REPLACE_TITLE_PIN_FLAG', 'Pin Flag');
define('PINBOARD_REPLACE_DESCRIPTION_CATEGORY_DEFAULT', 'This category will be used for all the pins to be added to this board, if you do not specify a pin for any other category.');
define('PINBOARD_REPLACE_TITLE_WHO_CAN_PIN', 'Who can create pins on my board?');
define('PINBOARD_REPLACE_ERROR_IMG_EMBED', 'You must add an image or a link to the embedded video page');

define('PINBOARD_REPLACE_PINIT_JS_MESSAGE1', 'Cancel');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE2', 'We need to remove the StumbleUpon toolbar before you can pin anything. Click OK to do this or Cancel to stay here.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE3', 'Unfortunately, this website doesn\'t allow pinning. You can contact the website owner with any questions you may have regarding their stance on pinning.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE4', 'Sorry, can\'t pin directly from %privateDomain%.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE5', 'Sorry, but we cannot see any big images or videos on this page to pin.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE6', 'The pinning bookmarklet is now installed! You can click the \"Pin It\" button from your bookmarks to pin images from around the web.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE7', 'Sorry, cannot pin this image.');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE8', 'Sorry, can\'t pin from non-HTML pages. If you\'re trying to upload an image, please visit !url');
define('PINBOARD_REPLACE_PINIT_JS_MESSAGE9', 'Pinning is not allowed from this page.\n\n%s% provided the following reason:');

define('PINBOARD_REPLACE_ADDBOARDPIN_IMG1', 'img/pinitbutton.png');
define('PINBOARD_REPLACE_ADDBOARDPIN_IMG2', 'img/createpin.png');
define('PINBOARD_REPLACE_ADDBOARDPIN_IMG3', 'img/board.png');
define('PINBOARD_REPLACE_ADDBOARDPIN_TITLE1', '"Pin It" Button');
define('PINBOARD_REPLACE_ADDBOARDPIN_TITLE2', 'Upload a Pin');
define('PINBOARD_REPLACE_ADDBOARDPIN_TITLE3', 'Create a Board');

define('PINBOARD_REPLACE_ADDPINIT_MESSAGE1', 'Drag me to the bookmarks bar');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE2', 'Pin It');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE3', 'Add this link to your Bookmarks Bar');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE4', 'To install the "Pin It" button in your Browser:');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE5', 'Display your Bookmarks Bar by clicking View &gt; Toolbars &gt; Bookmarks Toolbar');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE6', 'Drag the "Pin It" button to your Bookmarks Toolbar');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE7', 'When you are browsing the web, push the "Pin It" button to pin an image');
define('PINBOARD_REPLACE_ADDPINIT_MESSAGE8', 'Once installed in your browser, the "Pin It" button lets you grab an image from any website and add it to one of your pinboards. When you pin from a website, we automatically grab the source link so we can credit the original creator.');

define('NOTIFY_REPIN_SUBJECT', 'Message from site !site_name about a new repin');
define('NOTIFY_REPIN_MESSAGE', 'User !user !user_url made a repin !repin_url of your pin !pin_url');
define('NOTIFY_FOLLOW_SUBJECT', 'Message from site !site_name about a new follower');
define('NOTIFY_FOLLOW_MESSAGE', 'User !user !user_url has followed your boards');
define('NOTIFY_UNFOLLOW_SUBJECT', 'Message from site !site_name about an unfollower');
define('NOTIFY_UNFOLLOW_MESSAGE', 'User !user !user_url has unfollowed your boards');
define('NOTIFY_COMMENT_SUBJECT', 'Message from site !site_name about a new comment');
define('NOTIFY_COMMENT_MESSAGE', 'User !user !user_url has posted a comment !comment_url');
define('PINBOARD_HELPER_FLAG_TYPES', "Sexual Content\nViolent or Repulsive Content\nHateful or Abusive Content\nHarmful Dangerous Acts\nSpam\nInfringes My Rights");
define('PINBOARD_HELPER_FLAG_PIN_TEXT', '<h4>Report This Pin as Inappropriate</h4>Please select the category that most closely reflects your concern about the Pin, so that we can review it and determine if it violates our Community Guidelines or isn\'t appropriate for all viewers. Abusing this feature is also a violation of the Community Guidelines, so don\'t do it.');


/****************************************************************************************/
define('PINBOARD_REPLACE_TITLE_BOARDS', 'Boards');
define('PINBOARD_REPLACE_TITLE_LIKES', 'Likes');
define('PINBOARD_REPLACE_TITLE_PINS', 'Pins');
define('PINBOARD_REPLACE_TITLE_CONTACT', 'Contact');
define('PINBOARD_REPLACE_TITLE_LIKE', 'Like');

/****************************************************************************************/
define('PINBOARD_REPLACE_TITLE_UNFOLLOWERS', 'Unfollowers');

/****************************************************************************************/
define('PINBOARD_REPLACE_TITLE_BOARD_HELP', 'Help');
define('PINBOARD_REPLACE_TITLE_DESCRIPTION_BOARD_HELP', '<h3>Secret boards</h3><p>You can use secret boards to keep track of holiday gifts, plan a special event, or work on a project you aren’t yet ready to share with the rest of the world. You can keep your secret boards to yourself or invite family and friends to pin with you.</p><p>To create a secret board from the web, visit your profile and select board for editing. Then, click Edit and fill the fields on the bottom of the page using instructions in comments.</p><p>When you add a pin to a secret board, it won’t show up anywhere else on PinBoard—the only place you can see it is on your secret board.  Right now, you can’t make existing boards secret because other people may have already repinned from your board. You can make only newly created boards secret.</p>');
define('PINBOARD_REPLACE_TITLE_WHO_CAN_VIEW', 'Who can view my board?');
define('PINBOARD_REPLACE_DESCRIPTION_WHO_CAN_VIEW', '<ul><li>All. Leave field empty.</li><li>Me only. Enter your user profile name.</li><li>Me and my friends. Create friends list entering their user profile names.</li></ul>');
define('PINBOARD_REPLACE_DESCRIPTION_WHO_CAN_PIN', '<ul><li>Me only. Leave field empty.</li><li>My friends. Create friends list entering their user profile names.</li></ul>');
define('PINBOARD_REPLACE_LOADING_NEXT_POSTS', 'Loading the next set of posts...');

/****************************************************************************************/
define('PINBOARD_REPLACE_PATH_ADDAPIN', 'addapin');
define('PINBOARD_REPLACE_TITLE_ADDAPIN', 'Add a Pin');
define('PINBOARD_REPLACE_TITLE_ADDAPIN_URL', 'URL');
?>