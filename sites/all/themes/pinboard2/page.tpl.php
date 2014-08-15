<?php 
if ((isset($_GET['mob']) and $_GET['mob']) or arg(0) == 'nodes_mobile') {
  if ($_GET['mob'] == 'pgv3') {
    print '<div class="body-mobile">'.$messages;
    //if (arg(0) == 'user' and (arg(1) == '' or arg(1) == 'register')) 
    if (arg(0) != 'node') print '<h3 class="title">'.$title.'</h3>';
    print str_replace(array('target="_blank"', 'target="_top"'), array('', ''), render($page['content'])).'</div>';  
  } else {
    print '<div id="toolbar" class="top-mobile toolbar overlay-displace-top clearfix"><div id="toolbar-menu-i" class="toolbar-menu clearfix">'.pinboard_helper_mobile_top_out().'</div></div>'; 
    //print '<div class="body-mobile">'.$messages.render($page['content']).'</div>';
    print '<div class="body-mobile">'.$messages;
    //if (arg(0) == 'user' and (arg(1) == '' or arg(1) == 'register')) print '<h1 class="title">'.$title.'</h1>';
    print render($page['content']).'</div>';  
  }
} elseif (isset($_GET['ovr'])) {
  print '<div class="ovr"><div class="node_pin_page"><div class="pin-node">'.render($page['content']).'</div></div></div>';
} else {
print render($page['header']); 
global $base_url;
if (arg(1)) $arg1 = arg(1); else $arg1 = 0;
//if (!isset($page['content']['system_main']['nodes'][$arg1]['#node']->type)) $page['content']['system_main']['nodes'][$arg1]['#node']->type = '';
if (!(isset($page['content']['system_main']['nodes'][$arg1]) and isset($page['content']['system_main']['nodes'][$arg1]['#node']->type))) {
  $page['content']['system_main']['nodes'][$arg1]['#node'] = new stdClass;
  $page['content']['system_main']['nodes'][$arg1]['#node']->type = '';
}
?>

    <div class="header">
      <div class="top">
        <div class="inn"> 
          <div class="left soc">
            <?php echo render($page['sidebar_top_button']); ?>
          </div>
          <?php if ($user->uid) { ?>
            <div class="center l">
              <ul class="menu">
                <li class="first leaf"><a href="<?php echo url('youfollow'); ?>"><?php echo t('You Follow'); ?></a></li>
                <li class="leaf"><a href="<?php echo url('user/'.$user->uid); ?>"><?php echo pinboard_helper_const('PINBOARD_REPLACE_MY_ACCOUNT'); ?></a></li>
                <li class="last leaf"><a href="<?php echo url('user/logout'); ?>"><?php echo pinboard_helper_const('PINBOARD_REPLACE_LOG_OUT'); ?></a></li>
              </ul>
            </div>
          <?php } else { ?>
            <div class="center">
              <ul class="menu">
                <li class="first leaf"><a href="<?php echo url('user'); ?>"><?php echo pinboard_helper_const('PINBOARD_REPLACE_LOG_IN'); ?></a></li>
                <li class="last leaf"><a href="<?php echo url('user/register'); ?>"><?php echo pinboard_helper_const('PINBOARD_REPLACE_REGISTER'); ?></a></li>
              </ul>
            </div>
          <?php } ?>
          <div class="right">
            <?php echo render($page['sidebar_top_left']); ?>
          </div>
        </div>
      </div>
      <div class="nav">
        <div class="inn">
          <div class="left">
            <?php if (theme_get_setting('default_logo')) { ?>
              <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"><img src="<?php print $base_url.'/'.drupal_get_path('theme','pinboard2').'/img/logo-'.theme_get_setting('tm_value_3').'.png'; ?>" alt="<?php print $site_name; ?>" /></a>
            <?php } else { ?>
              <a href="<?php print check_url($front_page); ?>" title="<?php print $site_name; ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" /></a>
            <?php } ?>
          </div>
          <?php if (user_access('create '.PINBOARD_REPLACE_PATH_PIN.' content')) { ?>
            <div class="center">
              <a href="<?php print url(PINBOARD_REPLACE_PATH_ADDBOARDPIN); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_ADDBOARDPIN'); ?></a>
            </div>
          <?php } else {?>
            <div class="center">
              <a href="<?php print url('user'); ?>"><?php print pinboard_helper_const('PINBOARD_REPLACE_TITLE_ADDBOARDPIN'); ?></a>
            </div>
          <?php } ?>
          <div class="right">
            <?php if ($language->direction) { ?>
              <div class="search-b">
                <?php echo render($page['sidebar_top_right']); ?>
              </div>
              <div class="or-b"><?php print t('or'); ?></div>
            <?php } ?>
            <?php if ((arg(0) == 'taxonomy' and arg(1) == 'term')) { echo str_replace('>'.t('Category').'<','>'.t('Category').'<span class="cat-menu-title">: '.$title.'</span><',render($page['sidebar_top_menu'])); } else {echo render($page['sidebar_top_menu']);} ?> 
            <?php if (!$language->direction) { ?>
              <div class="or-b">or</div>
              <div class="search-b">
                <?php echo render($page['sidebar_top_right']); ?>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="main">
      <?php if ($welcome = render($page['sidebar_welcome'])) { echo '<div class="top-content-block">'.$welcome.'</div>'; } ?>
      <?php if (
        (arg(0) == 'node' and !arg(1)) or
        (arg(0) == 'taxonomy' and arg(1) == 'term') or
        (arg(0) == 'popular') or
        (arg(0) == 'video') or
        (arg(0) == 'gifts') or
        (arg(0) == 'source') or
        (arg(0) == 'search') or
        (arg(0) == 'youfollow')
      ) { ?>
        <?php if (isset($messages) and $messages) { print '<div class="tab-block">'.$messages.'</div>'; } ?>
        <?php if($tabs and false) { print '<div class="tab-block">'.render($tabs).'</div>'; } ?>
        <div class="pin_page">
          <?php print render($page['content']); ?>
        </div>
      <?php } elseif (
        arg(0) == 'user' and is_numeric(arg(1)) and 
        (
          !arg(2) or 
          arg(2) == PINBOARD_REPLACE_PATH_BOARD or 
          arg(2) == PINBOARD_REPLACE_PATH_FOLLOWERS or 
          arg(2) == PINBOARD_REPLACE_PATH_FOLLOWING
        )
      ) { ?>
        <?php if (isset($messages) and $messages) { print '<div class="tab-block">'.$messages.'</div>'; } ?>
        <?php if($tabs) { print '<div class="tab-block">'.render($tabs).'</div>'; } ?>
        <?php print render($page['content']); ?>
      <?php } elseif ($page['content']['system_main']['nodes'][$arg1]['#node']->type == PINBOARD_REPLACE_PATH_PIN) { ?>
        <?php if (isset($messages) and $messages) { print '<div class="tab-block">'.$messages.'</div>'; } ?>
        <?php if($tabs) { print '<div class="tab-block">'.render($tabs).'</div>'; } ?>
        <div class="node_pin_page">
          <div class="left pin-node">
            <?php print render($page['content']); ?>
          </div>        
          <div class="right">
            <div class="inn">
              <?php if (isset($page['sidebar_right'])) { echo render($page['sidebar_right']); } ?>
            </div>
          </div>  
        </div>
      <?php } elseif (arg(0) == 'blog' or arg(0) == PINBOARD_REPLACE_PATH_ADDBOARDPIN or arg(0) == PINBOARD_REPLACE_PATH_ADDPINIT) { ?>
        <?php if (isset($messages) and $messages) { print '<div class="tab-block">'.$messages.'</div>'; } ?>
        <?php if($tabs and $tabs['#primary']) { print '<div class="tab-block">'.render($tabs).'</div>'; } ?>
        <?php //print '<pre>'. check_plain(print_r($tabs, 1)) .'</pre>'; ?>	
        <div class="node_pin_page">
          <?php if ($action_links) {print '<ul class="action-page-links">'.render($action_links).'</ul>';}?>
          <h1 class="title"><?php print $title; ?></h1>
          <div class="left pin-node">
            <?php print render($page['content']); ?>
          </div>        
          <div class="right">
            <div class="inn">
              <?php print render($page['sidebar_right']); ?>  
            </div>
          </div>  
        </div>
      <?php } else { ?>
        <?php if (isset($messages) and $messages) { print '<div class="tab-block">'.$messages.'</div>'; } ?>
        <div class="node_pin_page">
          <?php if($tabs) { print '<div class="tab-block right">'.render($tabs).'</div>'; } ?>
          <?php if ($action_links) {print '<ul class="action-page-links">'.render($action_links).'</ul>';}?>
          <h1 class="title"><?php print $title; ?></h1>
          <div class="left pin-node">
            <div class="blog">
              <?php print render($page['content']); ?>    
            </div> 
            <div class="clr"></div>
          </div>        
          <div class="right">
            <div class="inn">
              <?php print render($page['sidebar_right']); ?>  
            </div>
          </div>  
        </div>
      <?php } ?>
      
    </div>
    <div class="footer">
      <div class="inn">
        <div class="left">
          <?php print render($page['footer_copyright']); ?>
        </div>
        <div class="right">
          <a href="http://www.themesnap.com/">Drupal theme by ThemeSnap.com</a>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="scroll_top"><a href="#"><?php print pinboard_helper_const('PINBOARD_REPLACE_SCROLL_TO_TOP'); ?><img src="<?php print $base_url.'/'.drupal_get_path('theme','pinboard2')?>/img/button-up.png" width="20" height="20" /></a></div>
<?php //print '<pre>'. check_plain(print_r($page['content'], 1)) .'</pre>'; ?>
<?php //print '<pre>'. check_plain(print_r(theme_get_setting('default_logo'), 1)) .'</pre>'; 
}
?>