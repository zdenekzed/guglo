<?php
// $Id$
function pinboard2_preprocess_html(&$variables) {
  global $base_url, $language;
  //drupal_set_message('<pre>'. check_plain(print_r($language, 1)) .'</pre>');
  drupal_add_css(path_to_theme().'/type/'.theme_get_setting('tm_value_4').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  drupal_add_css(path_to_theme().'/color/'.theme_get_setting('tm_value_3').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  drupal_add_js('misc/form.js');
  drupal_add_js('misc/collapse.js');
  if (isset($_GET['mob']) and $_GET['mob']) {
    drupal_add_css(drupal_get_path('theme','pinboard2').'/css/mobile.css');
    if ($_GET['mob'] == 1) drupal_add_js(drupal_get_path('theme','pinboard2').'/js/cordova.js');
    //drupal_add_js(drupal_get_path('theme','pinboard2').'/js/NativeControls.js');
  }
  //drupal_set_message('<pre>'. check_plain(print_r(strlen($blocksad), 1)) .'</pre>');
  drupal_add_js('
jQuery(document).ready(function($) {

  //$(\'#pin_iframe\').height($(window).height() - c.offset().top - mbottom);
  
  function getScrollTop() {
    var scrOfY = 0;
    if( typeof( window.pageYOffset ) == "number" ) {
      //Netscape compliant
      scrOfY = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
      //DOM compliant
      scrOfY = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
      //IE6 Strict
      scrOfY = document.documentElement.scrollTop;
    }
    return scrOfY;
  }
  
  function fixPaneRefresh(){
    if ($(".header").length) {
      var top  = getScrollTop();
      if (top > $(".top").height() && !(tablet || mobile)) {
				if (!$(".header").hasClass("top48")) {
				  $(".header").addClass("top48");
				  $(".main").css("margin-top", $(".top").height() + $(".nav").height() + 29 + "px");
				  $(".header").css("position","fixed");
				  $(".header").css("top","0");
				  $(".top").css("display","none");
				  
				}
			} else {
				if ($(".header").hasClass("top48")) {
				  $(".header").removeClass("top48");
				  $(".top").css("display","block");
				  $(".header").css("position","static");
				  $(".header").css("top","0");
				  $(".main").css("margin-top","0px");
				}
			}
    }
  } 
  
	// Twitter
	$(\'.widget-twitter\').each(function() {
		$(\'> .tweets\', this).tweet({
			username: $(this).data(\'username\'),
			count:    $(this).data(\'count\'),
			retweets: $(this).data(\'retweets\'),
			template: \'{tweet_text}<br /><small><a href="{tweet_url}">{tweet_relative_time}</a></small>\'
		});
	});
	
	if ($(".pin-image img").width() > $(".pin-image").width()) {
    $(".pin-image img").css("width", "100%");
    $(".pin-image img").css("height", "auto");
  }
  
	// Media types
	$(window).resize(function() {
		windowWidth = $(window).width();
		lteTablet = windowWidth < 980;
		lteMobile = windowWidth < 767;
		lteMini   = windowWidth < 479;
		gteDektop = windowWidth >= 980;
		gteTablet = windowWidth >= 767;
		gteMobile = windowWidth >= 239;
		tablet    = lteTablet && gteTablet;
		mobile    = lteMobile && gteMobile;
		if ($(".pin-image img").width() > $(".pin-image").width()) {
      $(".pin-image img").css("width", "100%");
      $(".pin-image img").css("height", "auto");
    }
  
	}).trigger(\'resize\');
	
	$(window).scroll(function() {
    fixPaneRefresh();
  });
  
  $(".nav .menu li.expanded").mouseover(function() {
		if (!$(this).hasClass("active") && !(tablet || mobile)) {
			$(".nav .menu li.expanded").removeClass("active");
			$(this).addClass("active");
			$(".nav .menu li.expanded").find("ul.menu").fadeOut();
			var activeTab = $(this).find("ul.menu");
			$(activeTab).fadeIn();
		  return false;
		}
	});
	$(".nav .menu li").mouseleave(function() {
		if ($(this).hasClass("active") && !(tablet || mobile)) {
			$(".nav .menu li.expanded").removeClass("active");
			$(".nav .menu li.expanded").find("ul.menu").fadeOut();
		  return false;
		}
	});
  
	// Navigation main
	$(\'.nav .menu li.expanded:has(ul)\').click(function(e) {
	'.($language->direction ? 'if ((tablet || mobile) && e.pageX - $(this).offset().left <= 45 && e.pageY - $(this).offset().top <= 40) {' : 'if ((tablet || mobile) && e.pageX - $(this).offset().left >= $(this).width() - 45 && e.pageY - $(this).offset().top <= 40) {').'
			$(\'> ul\', this).slideToggle(300);
			return false;
		}
	});

  var $allVideos = $(".pin-image iframe"),
  $fluidEl = $(".pin-image");
  $allVideos.each(function() {
    $(this).data(\'aspectRatio\', this.height / this.width).removeAttr(\'height\').removeAttr(\'width\');
  });
  $(window).resize(function() {
    var newWidth = $fluidEl.width();
    $allVideos.each(function() {
      var $el = $(this);
      $el.width(newWidth).height(newWidth * $el.data(\'aspectRatio\'));
    });
  }).resize();
	
});

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

function checkBrowser() {  							
if (BrowserDetect.OS == \'Windows\' || 
    BrowserDetect.OS == \'Mac\' || 
    (BrowserDetect.OS == \'Linux\' && BrowserDetect.browser != \'Mozilla\' && BrowserDetect.version != \'unknown\') ||
    (BrowserDetect.browser == \'Firefox\')
   ) {return true;} else {return false;}
}

/*BrowserDetect.OS == \'iPhone/iPod\' ||*/

function strpos( haystack, needle, offset){
	var i = haystack.indexOf( needle, offset );
	return i >= 0 ? i : false;
}

var oldurlpin = \'\';
function checkHash() {  							
  hash=window.location.pathname;
  //alert (hash);
  if (oldurlpin != hash) {
    (function ($) {
      $(\'.overlay\').remove();
      $("body").removeClass(\'no_scroll\');
      oldurlpin = \'\';
    })(jQuery);
  //alert (\'1\');
  } else {
    setTimeout("checkHash()",100);
  }
}
  
function frameFitting() {
    if (document.getElementById(\'pin_iframe\') && document.getElementById(\'pin_iframe\').contentWindow.document.body) {
      var h = 100;
      if (BrowserDetect.browser == \'Safari\' || BrowserDetect.browser == \'Chrome\') h = 0;
      document.getElementById(\'pin_iframe\').height = document.getElementById(\'pin_iframe\').contentWindow.document.body.scrollHeight+h+\'px\'; 
    }
    setTimeout("frameFitting()",500);
}

(function ($) {

if (checkBrowser()) {
//SCROLL TOP

$(window).scroll(function() {
    if ($(this).scrollTop()) {
        $(\'.scroll_top\').stop(true, true).fadeIn();
    } else {
        $(\'.scroll_top\').stop(true, true).fadeOut();
    }
});
}

$(document).ready(function(){
//PIN IMAGE CLICK

    function pin_image_click(a){
    
      hash=window.location.pathname;
      if (oldurlpin != hash) {
        var atr_link = $(this).attr("href");
        var html_to_prepend = \'<div class="overlay"><div class="pin_container"><div class="close_icon"></div><iframe id="pin_iframe" frameborder="0" scrolling="no" allowtransparency="true"></iframe></div></div>\';
        $("body").prepend(html_to_prepend);
				if (strpos(\'?\',atr_link) > 1) {atr_linkk = atr_link + \'&ovr=1\'} else {atr_linkk = atr_link + \'?ovr=1\'}
				var miframe = document.getElementById(\'pin_iframe\');
        miframe.src = atr_linkk; 
        
        $("body").addClass(\'no_scroll\'); //body no scrolling
        history.pushState(null,null,window.location.protocol + \'//\' + window.location.hostname + atr_link);
        oldurlpin=window.location.pathname;
      	setTimeout("checkHash()",500);
      	setTimeout("frameFitting()",1000);
      }
      
      return false;                  
    }
    '.((isset($_GET['mob']) and $_GET['mob']) ? 'var $container = $(\'.body-mobile #block-system-main'.((arg(0) == 'search' or arg(0) == 'source') ? ' .view-content' : '').':has(.pin_box)\');' : 'var $container = $(\'.pin_page'.((arg(0) == 'search' or arg(0) == 'source') ? ' .view-content' : '').':has(.pin_box)\');').'
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: \'.pin_box\',
        './*transitionDuration: \'1s\',
        visibleStyle: { 
          marginTop: \'0px\', 
          opacity: 1, 
          transform: \'scale(1)\' 
        },*/'
        columnWidth: 0
        '.($language->direction ? ', isRTL: 1' : '').'
      });
      $(\'ul.pager\').css({ display: \'none\' });
      
    });
    //$(\'.pin_box\').animate({ opacity: 1, marginTop: 0 }, 1000);
    //$(\'.pin_box\').animate({ marginTop: 0 }, 1000);
    '.((!(isset($_GET['mob']) and $_GET['mob'])) ? '
    $container.infinitescroll({
      navSelector  : \'ul.pager\',    // selector for the paged navigation 
      nextSelector : \'ul.pager .pager-next a\',  // selector for the NEXT link (to page 2)
      itemSelector : \'.pin_box\',     // selector for all items you\'ll retrieve
      
      bufferPx     : '.theme_get_setting('tm_value_bufferPx').',
      
      //animate      : true, 
      
      loading: {
          msgText: "<em>'.pinboard_helper_const('PINBOARD_REPLACE_LOADING_NEXT_POSTS').'</em>",
          finishedMsg: \''.pinboard_helper_const('PINBOARD_REPLACE_NO_MORE_PINS_TO_LOAD').'\',
          img: \''.$base_url.''.PINBOARD_REPLACE_PROGRESS_IMG.'\'
        },
      state: {currPage: 0},
      path: function (path) {
        var href1 = $(\'ul.pager .pager-next a\').attr(\'href\');
        var href2 = href1.match(/^(.*?page=)1(.*|$)/).slice(1);
        var href3 = href2[0].replace(\'page=\', \'page=\' + path);
        href1 = [href3];
        return href1;
      },
      }
      ,
      // trigger Masonry as a callback
      
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they\'re ready
          window.a_second++;
          $newElems.addClass(\'second_\'+a_second);
          $newElems.animate({ opacity: 1 }, 0);
          $container.masonry( \'appended\', $newElems, true );
          '. (theme_get_setting('tm_value_pinovr') ? '
          if (checkBrowser()) { 
            $(\'.pin_box .photo .field a\').click(pin_image_click); 
            $(\'.pin_box .photo a.video\').click(pin_image_click); 
            $(\'.pin_box .action a.action-pin\').click(pin_image_click); 
          }
          ' : '').'
          
          $(\'.like-widget:not(.like-processed)\').addClass(\'like-processed\').each(function () {
            var widget = $(this);
            var ids = widget.attr(\'id\').split(\'--\');
            ids = ids[0].match(/^like\-([a-z]+)\-([0-9]+)\-([0-9]+)\-([0-9])$/);
            var data = {
              content_type: ids[1],
              content_id: ids[2],
              widget_id: ids[3],
              widget_mode: ids[4]
            };

            $(\'a.like-button\', widget).click(function() {
              var token = this.getAttribute(\'href\').match(/like\=([a-zA-Z0-9\-_]{32,64})/)[1];
              return Drupal.likeVote(widget, data, token);
            });
          });
      
          $(".pin_box .inbox").mouseover(function() {
		        if (!$(this).hasClass("active")) {
			        $(".pin_box .inbox").removeClass("active");
			        $(this).addClass("active");
			        $(".pin_box .inbox .action").fadeOut();
			        var activeTab = $(this).find(".action");
			        $(activeTab).fadeIn();
		          return false;
		        }
	        });
	        $(".pin_box .inbox").mouseleave(function() {
		        if ($(this).hasClass("active")) {
			        $(".pin_box .inbox").removeClass("active");
			        $(".pin_box .inbox .action").fadeOut();
		          return false;
		        }
	        });
      
        });
      }
    );
    ' : '').'  
    
    if (checkBrowser()){ 
    	'.((!(isset($_GET['mob']) and $_GET['mob']) and theme_get_setting('tm_value_pinovr')) ? '$(\'.pin_box .photo .field a\').click(pin_image_click); $(\'.pin_box .photo a.video\').click(pin_image_click); $(\'.pin_box .action a.action-pin\').click(pin_image_click);' : '').'
 			$(\'body\').click(function(event) {
      	if (!$(event.target).closest(\'.pin_container iframe\').length && $(\'.pin_container iframe\').length && $(\'.pin_box .photo a\').length) {
        	history.back();
      	};
    	});
    }

  });
 
})(jQuery);
'.((isset($_GET['mob']) and $_GET['mob'] == 1) ? '

document.addEventListener("resume", onDeviceResume, false);

  
  function uploadPH() {
    // Retrieve image file location from specified source
    navigator.camera.getPicture(uploadPhoto,
      function(message) { alert(\'get picture failed\'); },
      { quality: 50, destinationType: navigator.camera.DestinationType.FILE_URI, sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY, correctOrientation: true}
    );
    //return false;
  }

  function uploadPhoto(imageURI) {
    var options = new FileUploadOptions();
    options.fileKey="file";
    options.fileName=imageURI.substr(imageURI.lastIndexOf(\'/\')+1);
    options.mimeType="image/jpeg";
    
    var params = new Object();
    params.value1 = "test";
    params.value2 = "param";
    
    options.params = params;
    
    var ft = new FileTransfer();
    ft.upload(imageURI, encodeURI("'.url('mobilefileupload', array('absolute' => TRUE, 'query' => array('mob' => '1'))).'"), win, fail, options);
  }

  function win(r) {
    //console.log("Code = " + r.responseCode);
    //console.log("Response = " + r.response);
    //console.log("Sent = " + r.bytesSent);
    if (r.response) {
      window.location.replace(\''.url('node/add/'.PINBOARD_REPLACE_PATH_PIN, array('absolute' => TRUE, 'query' => array('mob' => '1'))).'&fid=\'+r.response);
    }
  }

  function fail(error) {
    alert("An error has occurred: Code = " + error.code);
    //console.log("upload error source " + error.source);
    //console.log("upload error target " + error.target);
  }
  


function onDeviceResume() {
    window.location.reload(1);
    //uploadPH();
} 

document.addEventListener("deviceready", onDeviceReady, false);
function onDeviceReady() {
  var element = document.getElementById(\'toolbar-menu-i\');
  if (device.platform == \'iOS\' && device.version.charAt(0) != \'7\') {
    element.style.paddingTop = \'5px\';
  } else {
    element.style.paddingTop = \'25px\';
  }
}


' : '').'
', array('type' => 'inline',  'scope' => 'header', 'weight' => 5));
}

function pinboard2_loginza_iframe($variables) {
  $widget = <<<LW
<iframe src="http://loginza.ru/api/widget?overlay=loginza&@providerslang=@lang&token_url=@token_url" class="loginza-iframe" scrolling="no" frameborder="no"></iframe>
LW;

  return _theme_loginza_widget($widget, $variables);
}

function pinboard2_loginza_button($variables) {
  $widget = <<<LW
<div class="loginza-blk">
<a href="http://loginza.ru/api/widget?@providerslang=@lang&token_url=@token_url" class="loginza">
    <img src="@image" alt="@caption" title="@caption"/>
</a>
</div>
LW;

  return _theme_loginza_widget($widget, $variables);
}

function pinboard2_loginza_icons($variables) {
  $widget = <<<LW
<div class="loginza-blk">
@caption
<a href="https://loginza.ru/api/widget?@providerslang=@lang&token_url=@token_url" class="loginza">
    @icons
</a>
</div>
LW;

  return _theme_loginza_widget($widget, $variables);
}

function pinboard2_loginza_string($variables) {
  $widget = <<<LW
<div class="loginza-blk">
<a href="http://loginza.ru/api/widget?@providerslang=@lang&token_url=@token_url" class="loginza">@caption</a>
</div>
LW;

  return _theme_loginza_widget($widget, $variables);
}

function pinboard2_get_comments($pid, $node) {
	$out = '';
  $i = 4;
  $comments = comment_load_multiple(array(), array('pid' => $pid, 'nid' => $node->nid, 'status' => COMMENT_PUBLISHED));
  $j = count($comments);
  foreach ($comments as $com) {
    $comment = comment_view($com, $node);
		$out .= '<div class="comment">'.theme('user_picture', array('account' => $comment['#comment'])).''.theme('username', array('account' => $comment['#comment'])).' '.pinboard2_truncate_utf8(strip_tags(render($comment['comment_body'])),200, true, true).'</div>';

    if (!$i) { 
      if ($j > 5) { 
         $out .= '<div class="comment all"><a href="'.url("node/$node->nid", array('fragment' => 'comment-form')).'">'.t('All !count comments...', array('!count' => $j)).'</a></div>';
      }
      return $out;
    }
    $i--;
//    unset($comment['comment_body']);
//    unset($comment['links']);
//    $out .= '<pre>'. check_plain(print_r($comment[], 1)) .'</pre>';
	}	
  return $out;
} 

/**
 * Preprocess function for the thumbs_up_down template.
 */
function pinboard2_preprocess_rate_template_thumbs_up(&$variables) {
  extract($variables);

  $variables['up_button'] = theme('rate_button', array('text' => pinboard_helper_const('PINBOARD_REPLACE_TITLE_LIKE'), 'href' => $links[0]['href'], 'class' => 'rate-thumbs-up-btn-up'));

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('Voting is closed.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = pinboard_helper_const('PINBOARD_REPLACE_COUNT_LIKES', array('!count' => $results['count']));
    }
    else {
      $info[] = pinboard_helper_const('PINBOARD_REPLACE_COUNT_LIKES', array('!count' => $results['count']));
    }
  }
  $variables['info'] = implode(' ', $info);
}

function pinboard2_rate_button($variables) {
  //drupal_set_message('<pre>'. check_plain(print_r($variables, 1)) .'</pre>');
  $text = $variables['text'];
  $href = $variables['href'];
  $class = $variables['class'];
  static $id = 0;
  $id++;

  $classes = 'rate-button';
  if ($class) {
    $classes .= ' ' . $class;
  }
  if (empty($href)) {
    // Widget is disabled or closed.
    return '<span class="' . $classes . '" id="rate-button-' . $id . '">' .
      check_plain($text) .
      '</span>';
  }
  else {
      return '<a class="' . $classes . '" id="rate-button-' . $id . '" rel="nofollow" target="_top" href="' . htmlentities($href) . '" title="' . check_plain($text) . '">' .
      check_plain($text) .
      '</a>';
  }
}

function pinboard2_target_top($string) {
  $string = str_replace(array('<a ', '<form '), array('<a target="_top" ', '<form target="_top" '), $string);
  return $string;
}

function pinboard2_target_blank($string) {
  $string = str_replace(array('<a ', '<form '), array('<a target="_blank" ', '<form  target="_blank" '), $string);
  return $string;
}

function pinboard2_target_topblank($string) {
  if (theme_get_setting('tm_value_topblank')) {
    $string = str_replace(array('<a ', '<form '), array('<a target="_blank" ', '<form  target="_blank" '), $string);
  } else {
    $string = str_replace(array('<a ', '<form '), array('<a target="_top" ', '<form target="_top" '), $string);
  }
  return $string;
}



function pinboard2_truncate_utf8($string, $len, $wordsafe = FALSE, $dots = FALSE, &$ll = 0) {

  if (drupal_strlen($string) <= $len) {
    return $string;
  }

  if ($dots) {
    $len -= 4;
  }

  if ($wordsafe) {
    $string = drupal_substr($string, 0, $len + 1); // leave one more character
    if ($last_space = strrpos($string, ' ')) { // space exists AND is not on position 0
      $string = substr($string, 0, $last_space);
      $ll = $last_space;
    }
    else {
      $string = drupal_substr($string, 0, $len);
	  $ll = $len;
    }
  }
  else {
    $string = drupal_substr($string, 0, $len);
	$ll = $len;
  }

  if ($dots) {
    $string .= '...';
  }

  return $string;
}

function pinboard2_userpage_pins () {
	global $base_url, $user; 
	if (arg(1)) {
  	$acc = user_load(arg(1));
	} else {
		return '';
	}
	$destination = drupal_get_destination();
	$out = '';
  $oute = '';
	if (arg(2) == PINBOARD_REPLACE_PATH_BOARD) {
  	if (is_numeric(arg(3)) and arg(3)){
  	    $result = db_select('pinboard_boards')->fields('pinboard_boards', array('data'))->condition('bid', arg(3), '=')->execute();
  			foreach ($result as $us) {
    			$bdata = unserialize($us->data);
  			}
  			if (!isset($bdata['description'])) $bdata['description'] = '';
      $result = db_select('pinboard_boards', 'b')
      	->fields('b',array('name'))
        ->condition('bid', arg(3))
        ->condition('uid', arg(1))
        ->execute()->fetchCol(); 
          
      
      if (!(isset($_GET['mob']) and $_GET['mob'])) {
        if (isset($result[0])) $out .= '<h1 class="title">'.$result[0].'</h1>';
        $out .= '<div class="inf">';
        $out .= '<div class="cou"><b>'.pinboard_helper_count_followers(arg(1), arg(3)).'</b> '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS').', <b>'.pinboard_helper_board_pin_count(arg(3)).'</b> '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_PINS').'</div>'; 
        
        
        if ($user->uid and $acc->uid != $user->uid)
          if (pinboard_helper_isfollow ($acc, arg(3))) 
            $out .= '<div class="flr"><a href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$acc->uid.'/'.arg(3), array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOW').'</a></div>';
          else
            $out .= '<div class="flr"><a href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$acc->uid.'/'.arg(3), array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOW').'</a></div>';
           
        $out .= '<div class="clr"></div></div>';
            
          
          if (!isset($_GET['page']) and $bdata['description']) $out .= '<p>'.$bdata['description'].'</p>';
          if ($out) $out = '<div class="node_pin_page">'.$out.'</div>';
          $out .= '<div class="pin_page">';
          $oute = '</div>';
        }
        $qw2 = db_select('pinboard_repins', 'r');
        $qw2->leftJoin('node', 'node', 'node.nid = r.nid');
        $qw2->addTag('node_access');
        //$qw2->extend('PagerDefault')->limit(30);
        $result = $qw2->fields('r', array('nid'))->condition('r.bid', arg(3))->condition('node.status', 1)->extend('PagerDefault')->limit(30)->orderBy('node.created', 'DESC')->execute()->fetchCol();
        //$result = $qw2->execute()->fetchCol();
        
        //$result = db_select('pinboard_repins', 'r')->extend('PagerDefault')->fields('r', array('nid'))->condition('bid', arg(3), '=')->orderBy('nid', 'DESC')->limit(30)->execute()->fetchCol();
    } else {
      $out .= ''.'';
      $out .= '<div class="pin_page">';
      $oute = '</div>';
      $result = db_select('node', 'r')->addTag('node_access')->extend('PagerDefault')->fields('r', array('nid'))->condition('type', PINBOARD_REPLACE_PATH_PIN, '=')->condition('status', 1, '=')->condition('uid', $acc->uid, '=')->orderBy('created', 'DESC')->limit(30)->execute()->fetchCol();
    }
    $nodes = node_load_multiple($result);
    $nodes = node_view_multiple($nodes);
    
    $pp = theme('pager');
    if (!$pp or !isset($_GET['page']) or strpos($pp,'page='.$_GET['page']) or strpos($pp, '>'.($_GET['page'] + 1).'<'))
    	$out .= render($nodes);
    $out .= $oute;
    $out .= $pp;
  } elseif (arg(2) == PINBOARD_REPLACE_PATH_FOLLOWERS) {
    $out1 = '';
    $out1 .= '<div class="board_box2">';
    $out1 .= '<div class="titlebg"><h2>'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWERS').'</h2></div>';
    $uids = db_select('pinboard_follow','p')
      ->condition('p.aid', $acc->uid);
      //->extend('PagerDefault')
      //->limit(15);
      //->fields('p', array('uid'));
    	//;
    $uids->addExpression('distinct(p.uid)');
    $uids = $uids->execute()->fetchCol();

    if (count($uids)) foreach ($uids as $uidi) {
      $ui = user_load($uidi);
      if ($ui->uid) {
        $result = db_select('node', 'r')
          ->addTag('node_access')
          ->fields('r', array('nid'))
          ->condition('uid', $uidi, '=')
          ->condition('type', PINBOARD_REPLACE_PATH_PIN, '=')
          ->condition('status', 1)
          ->range(0, 12)->execute()->fetchCol();
        $nodes = node_load_multiple($result);
        $nodes = node_view_multiple($nodes);
        $out1 .= '<div class="blk2"><h3>'.theme('username', array('account' => $ui)).'</h3><a href="'.url('user/'.$ui->uid).'"><ul class="b_thumbs">';
        foreach ($nodes['nodes'] as $k2 => $v2) {
          if (isset($v2['field_image'][0]['#image_style'])) $v2['field_image'][0]['#image_style'] = 'pin_tmb_2';
          if (isset($v2['field_image'][0]['#path'])) $v2['field_image'][0]['#path'] = '';
          if (isset($v2['field_image']) and is_array($v2['field_image'])) $out1 .= '<li>'.render($v2['field_image']).'</li>';
        }
        $out1 .= '</ul></a></div>';
      } else {
        db_delete('pinboard_follow')
          ->condition('uid', $uidi)
          ->execute();
      }
    }
    $out1 .= '</div>';
    //$pp = theme('pager');
    //if (!$pp or !isset($_GET['page']) or strpos($pp,'page='.$_GET['page']) or strpos($pp, '>'.($_GET['page'] + 1).'<'))
      $out .= $out1;
    //$out .= $pp;
  } elseif (arg(2) == PINBOARD_REPLACE_PATH_FOLLOWING) {
    $out1 = '';
    $out1 .= '<div class="board_box2">';
    $out1 .= '<div class="titlebg"><h2>'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOWING').'</h2></div>';
    $uids = db_select('pinboard_follow','p')
      //->fields('p', array('uid'));
      ->condition('p.uid', $acc->uid);
    $uids->addExpression('distinct(p.aid)');
    $uids = $uids->execute()->fetchCol();

    if (count($uids)) foreach ($uids as $uidi) {
      $ui = user_load($uidi);
      if ($ui->uid) {
        $result = db_select('node', 'r')
          ->addTag('node_access')
          ->fields('r', array('nid'))
          ->condition('uid', $uidi, '=')
          ->condition('type', PINBOARD_REPLACE_PATH_PIN, '=')
          ->condition('status', 1)
          ->range(0, 12)->execute()->fetchCol();
        $nodes = node_load_multiple($result);
        $nodes = node_view_multiple($nodes);
        $out1 .= '<div class="blk2"><h3>'.theme('username', array('account' => $ui)).'</h3><a href="'.url('user/'.$ui->uid).'"><ul class="b_thumbs">';
        foreach ($nodes['nodes'] as $k2 => $v2) {
          if (isset($v2['field_image'][0]['#image_style'])) $v2['field_image'][0]['#image_style'] = 'pin_tmb_2';
          if (isset($v2['field_image'][0]['#path'])) $v2['field_image'][0]['#path'] = '';
          if (isset($v2['field_image']) and is_array($v2['field_image'])) $out1 .= '<li>'.render($v2['field_image']).'</li>';
        }
        $out1 .= '</ul></a></div>';
      } else {
        db_delete('pinboard_follow')
          ->condition('aid', $uidi)
          ->execute();
      }
    }
    $out1 .= '</div>';
    //$pp = theme('pager');
    //if (!$pp or !isset($_GET['page']) or strpos($pp,'page='.$_GET['page']) or strpos($pp, '>'.($_GET['page'] + 1).'<'))
    	$out .= $out1;
    //$out .= $pp;
    } else {
      $out1 = '';
      $out1 = '<div class="board_page">';
      
      
      
      $qw = db_select('pinboard_boards', 'b');
      $qw->leftJoin('pinboard_accessboard', 'a', 'b.bid = a.bid');
      //$qw->extend('PagerDefault');
      $qw->fields('b',array('bid', 'name'));
      $qw->condition('b.uid', arg(1));
      $or = db_or()->condition('a.uid', $user->uid)->condition('a.uid');
      $qw->condition($or);
      //$qw->limit(30);
      $result = $qw->extend('PagerDefault')->limit(30)->orderBy('name', 'ASC')->execute()->fetchAllKeyed();   
      foreach ($result as $k => $v) {
        
        $qw2 = db_select('pinboard_repins', 'r');
        $qw2->leftJoin('node', 'node', 'node.nid = r.nid');
        $qw2->addTag('node_access');
        $qw2->fields('r', array('nid'))->condition('r.bid', $k)->condition('node.status', 1)->orderBy('node.created', 'DESC')->range(0, 9);
        $result2 = $qw2->execute()->fetchCol();
        if (count($result2)) {
          $out1 .= '<div class="board_box"><a class="boards" href="'.url('user/'.$acc->uid.'/'.PINBOARD_REPLACE_PATH_BOARD.'/'.$k).'"><div class="title">'.$v.'<div class="e"></div></div>';
          $out1 .= '<div class="co">'.pinboard_helper_board_pin_count($k).' '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_PINS').'</div>';
          
          $nodes = node_load_multiple($result2);
          $nodes = node_view_multiple($nodes);
          //print '<div class="user_profile_main"><pre>'. check_plain(print_r($nodes['nodes'], 1)) .'</pre></div>'; 
          foreach ($nodes['nodes'] as $k2 => $v2) {
            //print '<div class="user_profile_main"><pre>'. check_plain(print_r($v2['field_embed'], 1)) .'</pre></div>';  
            if (isset($v2['field_image']) and is_array($v2['field_image'])) { 
            	if (isset($v2['field_image'][0]['#image_style'])) $v2['field_image'][0]['#image_style'] = 'pin_tmb_2';
              if (isset($v2['field_image'][0]['#path'])) $v2['field_image'][0]['#path'] = '';
              $out1 .= render($v2['field_image']);
            } elseif (isset($v2['field_embed']) and is_array($v2['field_embed'])) {
              if (isset($v2['field_embed'][0][0]['#style_name'])) $v2['field_embed'][0][0]['#style_name'] = 'pin_tmb_2';
              if (isset($v2['field_embed'][0]['#prefix'])) $v2['field_embed'][0]['#prefix'] = '';
              if (isset($v2['field_embed'][0]['#suffix'])) $v2['field_embed'][0]['#suffix'] = '';
              $out1 .= str_replace(array('<a ', '</a>'), array('<span ', '</span>'), render($v2['field_embed']));
            }
            //print '<div class="user_profile_main"><pre>'. check_plain(print_r($v2['field_embed']['#children'], 1)) .'</pre></div>'; 
          }
          $ii = 9 - count($result2);
        } else {
          $out1 .= '<div class="board_box"><a class="boards"><div class="title">'.$v.'</div>';
          $out1 .= '<div class="co">0 '.pinboard_helper_const('PINBOARD_REPLACE_TITLE_PINS').'</div>';
          $ii = 9;
        }
        for ( $i=0; $i<$ii; $i++) {
          $out1 .= '<img src="'.$base_url.'/'.drupal_get_path('theme','pinboard2').'/img/tr.png" />';
        }
        if (count($result2)) {
          $out1 .= '</a>';
        } else {
          $out1 .= '</a>';
        }
        
        if ($user->uid and $acc->uid != $user->uid) { 
          if (pinboard_helper_isfollow ($acc, $k)) 
            $out1 .= '<div class="board-links"><a href="'.url(PINBOARD_REPLACE_PATH_UNFOLLOW.'/'.$acc->uid.'/'.$k, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_UNFOLLOW').'</a></div>';
          else
            $out1 .= '<div class="board-links"><a href="'.url(PINBOARD_REPLACE_PATH_FOLLOW.'/'.$acc->uid.'/'.$k, array('query' => $destination)).'">'.pinboard_helper_const('PINBOARD_REPLACE_TITLE_FOLLOW').'</a></div>';
        } 
        if ($acc->uid == $user->uid or $user->uid == 1) {
          $out1 .= '<div class="board-links"><a href="'.url(PINBOARD_REPLACE_PATH_BOARD.'/edit/'.$k, array('query' => $destination)).'">'.t('Edit').'</a></div>';
        }
        $out1 .= '</div>';
      }
      $pp = theme('pager');
      if (!$pp or !isset($_GET['page']) or strpos($pp,'page='.$_GET['page']) or strpos($pp, '>'.($_GET['page'] + 1).'<'))
        $out .= $out1;
      $out .= $pp;
      //print theme('pager');
    }
    return $out;
}

function pinboard2_originally_pinned($node) {
  //drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
        
  $out = $out1 = '';
  $query = db_select('pinboard_repins', 'v');
  $query->leftJoin('node', 'node', 'node.nid = v.nid');
  $query->addTag('node_access');
  $query->addField('v', 'nid');
  $query->condition('v.uid', $node->ph_uid)->condition('node.status', 1);
  $query->orderRandom();
  $query->range(0, 6);
  $result = $query->execute()->fetchCol();
  $nodes = node_load_multiple($result);
  $nodes = node_view_multiple($nodes);
  unset($nodes['nodes']['#sorted']);
  //$c = count($nodes['nodes']);
  //$i = 1;
  
  foreach ($nodes['nodes'] as $k2 => $v2) {
    $out1 = '';
    //drupal_set_message('<pre>'. check_plain(print_r($k2, 1)) .'</pre>');
    if (isset($v2['field_image']) and is_array($v2['field_image'])) { 
      if (isset($v2['field_image'][0]['#image_style'])) $v2['field_image'][0]['#image_style'] = 'pin_tmb_2';
      if (isset($v2['field_image'][0]['#path'])) $v2['field_image'][0]['#path'] = '';
      $out1 = render($v2['field_image']);
    } elseif (isset($v2['field_embed']) and is_array($v2['field_embed'])) {
      if (isset($v2['field_embed'][0][0]['#style_name'])) $v2['field_embed'][0][0]['#style_name'] = 'pin_tmb_2';
      if (isset($v2['field_embed'][0]['#prefix'])) $v2['field_embed'][0]['#prefix'] = '';
      if (isset($v2['field_embed'][0]['#suffix'])) $v2['field_embed'][0]['#suffix'] = '';
      $out1 = str_replace(array('<a ', '</a>'), array('<span ', '</span>'), render($v2['field_embed']));
    }
    //if ($c == $i) $out .= $out1 ? '<div class="last">'.$out1.'</div>' : ''; 
    //else 
    $out .= $out1 ? ''.$out1.'' : ''; 
    //$i++;
  }
  return $out;
}

function pinboard2_pinned_onto_board($node) {
  

  $out = $out1 = '';
  $query = db_select('pinboard_repins', 'v');
  $query->leftJoin('node', 'node', 'node.nid = v.nid');
  $query->addTag('node_access');
  $query->addField('v', 'nid');
  $query->condition('v.bid', $node->ph_bid)->condition('node.status', 1);
  $query->orderRandom();
  $query->range(0, 6);
  $result = $query->execute()->fetchCol();
  $nodes = node_load_multiple($result);
  $nodes = node_view_multiple($nodes);
  unset($nodes['nodes']['#sorted']);
  $c = count($nodes['nodes']);
  $i = 1;
//drupal_set_message('<pre>'. check_plain(print_r($nodes, 1)) .'</pre>');
  foreach ($nodes['nodes'] as $k2 => $v2) {
    $out1 = '';
    if (isset($v2['field_image']) and is_array($v2['field_image'])) { 
      if (isset($v2['field_image'][0]['#image_style'])) $v2['field_image'][0]['#image_style'] = 'pin_tmb_2';
      if (isset($v2['field_image'][0]['#path'])) $v2['field_image'][0]['#path'] = '';
      $out1 = render($v2['field_image']);
    } elseif (isset($v2['field_embed']) and is_array($v2['field_embed'])) {
      if (isset($v2['field_embed'][0][0]['#style_name'])) $v2['field_embed'][0][0]['#style_name'] = 'pin_tmb_2';
      if (isset($v2['field_embed'][0]['#prefix'])) $v2['field_embed'][0]['#prefix'] = '';
      if (isset($v2['field_embed'][0]['#suffix'])) $v2['field_embed'][0]['#suffix'] = '';
      $out1 = str_replace(array('<a ', '</a>'), array('<span ', '</span>'), render($v2['field_embed']));
    }
    if ($c == $i) $out .= $out1 ? '<div class="last">'.$out1.'</div>' : ''; 
    else $out .= $out1 ? ''.$out1.'' : ''; 
    $i++;
  }
  return $out;
}

function pinboard2_repins_count($node) {
  $out = 0;
  $query = db_select('pinboard_repins', 'v');
  $query->leftJoin('node', 'node', 'node.nid = v.nid');
  $query->addTag('node_access');
  $query->addExpression('COUNT(v.nid)');
  $query->condition('v.did', $node->nid, '=');
  $query->condition('v.nid', $node->nid, '!=')->condition('node.status', 1);
  $count = $query->execute()->fetchCol();
  if ($count[0]) { $out = $count[0]; }
  return $out;
}

function pinboard2_repins_users_count($node) {
  $out = 0;
  $query = db_select('pinboard_repins', 'v');
  $query->leftJoin('node', 'node', 'node.nid = v.nid');
  $query->addTag('node_access');
  $query->addExpression('COUNT(v.uid)');
  $query->condition('v.did', $node->nid, '=');
  $query->condition('v.nid', $node->nid, '!=')->condition('node.status', 1);
  $count = $query->execute()->fetchCol();
  if ($count[0]) { $out = $count[0]; }
  return $out;
}

function pinboard2_repins_users_out($node) {
  $out = '';
  $query = db_select('pinboard_repins', 'v');
  $query->leftJoin('node', 'node', 'node.nid = v.nid');
  $query->addTag('node_access');
  $query->addField('v', 'uid');
  $query->condition('v.did', $node->nid, '=');
  $query->condition('v.nid', $node->nid, '!=')->condition('node.status', 1);
  $query->range(0, 12);
  $result = $query->execute()->fetchCol();
  foreach ($result as $ruid) {
    if (isset($ruid) and $ruid) {
      $ruser->uid = $ruid;
      $ruser = user_load($ruid);
      $out .= ''.theme('user_picture', array('account' => $ruser))./*'<p>'.theme('username', array('account' => $ruser)).'</p>'.*/'';
      unset($ruser);
    }
  }
  return pinboard2_target_topblank($out);
}

function pinboard2_like_box_count($node) {
  $out = 0;
  $query = db_select('votingapi_vote', 'v');
  $query->addExpression('COUNT(v.uid)');
  $query->condition('v.entity_type', 'node', '=');
  $query->condition('v.entity_id', $node->nid, '=');
  $query->condition('v.uid', 0, '>');
  $count = $query->execute()->fetchCol();
  if ($count[0]) { $out = $count[0]; }
  return $out;
}

function pinboard2_like_box_out($node) {
  $out = '';
  $query = db_select('votingapi_vote', 'v');
  $query->addField('v', 'uid');
  $query->condition('v.entity_type', 'node', '=');
  $query->condition('v.entity_id', $node->nid, '=');
  $query->condition('v.uid', 0, '>');
  $query->range(0, 12);
  $result = $query->execute()->fetchCol();
  foreach ($result as $ruid) {
    if (isset($ruid) and $ruid) {
      $ruser = new stdClass();
      $ruser->uid = $ruid;
      $ruser = user_load($ruid);
      $out .= ''.theme('user_picture', array('account' => $ruser)).'';
      unset($ruser);
    }
  }
  return pinboard2_target_topblank($out);
}

function pinboard2_render_block_on_pins($node) {
  static $c = 0;
  $out = '';
  if (!$c and !pager_find_page()) {
    $fblk = block_get_blocks_by_region('first_region');
    $out .= render($fblk);
  } elseif (!pager_find_page()) {
    $fblk = block_get_blocks_by_region('static_blocks');
    $fblkt = $fblk;
    unset($fblk['#sorted']);
    $cp = 30;
    $cb = count($fblk);
    if ($cb) {
      $cc = floor($cp / $cb);
      $co = floor($c / $cc) + 1;
      unset($fblk);
      $fblk = array();
      $cf = 1;
      foreach($fblkt as $k => $b) {
        if (strpos($k,'block') === FALSE or $cf == $co) $fblk[$k] = $b;
        $cf = $cf + 1;
      }
      //$out .= $c.' - '.$cc.' - '.$co.' - '.($cc * $co);
      if ($c == (($cc * $co)-1)) {
        //$fblk = block_get_blocks_by_region('repeating_blocks');
        //$out .= '<pre>'. check_plain(print_r($fblk, 1)) .'</pre>';
        $out .= render($fblk);
      }
    }
  } else {
    $fblk = block_get_blocks_by_region('repeating_blocks');
    $fblkt = $fblk;
    unset($fblk['#sorted']);
    $cp = 30;
    $cb = count($fblk);
    if ($cb) {
      $cc = floor($cp / $cb);
      $co = floor($c / $cc) + 1;
      unset($fblk);
      $fblk = array();
      $cf = 1;
      foreach($fblkt as $k => $b) {
        if (strpos($k,'block') === FALSE or $cf == $co) $fblk[$k] = $b;
        $cf = $cf + 1;
      }
      //$out .= $c.' - '.$cc.' - '.$co.' - '.($cc * $co);
      if ($c == (($cc * $co)-1)) {
        //$fblk = block_get_blocks_by_region('repeating_blocks');
        //$out .= '<pre>'. check_plain(print_r($fblk, 1)) .'</pre>';
        $out .= render($fblk);
      }
    }
  }
  $c = $c + 1;
  return $out ? '<div class="pin_box"><div class="inbox">'.$out.'</div></div>' : '';
}