<?php
// $Id$
function pinboard_preprocess_html(&$variables) {
  global $base_url, $language;
  //drupal_set_message('<pre>'. check_plain(print_r($language, 1)) .'</pre>');
  drupal_add_css(path_to_theme().'/type/'.theme_get_setting('tm_value_4').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  drupal_add_css(path_to_theme().'/color/'.theme_get_setting('tm_value_3').'.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  drupal_add_js('misc/form.js');
  drupal_add_js('misc/collapse.js');
  if (isset($_GET['mob']) and $_GET['mob']) {
    drupal_add_css(drupal_get_path('theme','pinboard').'/css/mobile.css');
    drupal_add_js(drupal_get_path('theme','pinboard').'/scr/cordova-2.0.0.js');
    drupal_add_js(drupal_get_path('theme','pinboard').'/scr/NativeControls.js');
  }
  //drupal_set_message('<pre>'. check_plain(print_r(strlen($blocksad), 1)) .'</pre>');
  drupal_add_js('
jQuery(document).ready(function($) {

  //$(\'#pin_iframe\').height($(window).height() - c.offset().top - mbottom);
  
  
  
	// Twitter
	$(\'.widget-twitter\').each(function() {
		$(\'> .tweets\', this).tweet({
			username: $(this).data(\'username\'),
			count:    $(this).data(\'count\'),
			retweets: $(this).data(\'retweets\'),
			template: \'{tweet_text}<br /><small><a href="{tweet_url}">{tweet_relative_time}</a></small>\'
		});
	});
	
	// Media types
	$(window).resize(function() {
		windowWidth = $(window).width();
		lteTablet = windowWidth < 980;
		lteMobile = windowWidth < 767;
		lteMini   = windowWidth < 479;
		gteDektop = windowWidth >= 980;
		gteTablet = windowWidth >= 767;
		gteMobile = windowWidth >= 479;
		tablet    = lteTablet && gteTablet;
		mobile    = lteMobile && gteMobile;
	}).trigger(\'resize\');
	
	// Navigation main
	$(\'ul.menu li:has(ul)\').click(function(e) {
	'.($language->direction ? 'if (lteMobile && e.pageX - $(this).offset().left <= 45) {' : 'if (lteMobile && e.pageX - $(this).offset().left >= $(this).width() - 45) {').'
			$(\'> ul\', this).slideToggle(300);
			return false;
		}
	});
	
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
    BrowserDetect.OS == \'iPhone/iPod\' ||
    (BrowserDetect.OS == \'Linux\' && BrowserDetect.browser != \'Mozilla\' && BrowserDetect.version != \'unknown\') ||
    (BrowserDetect.browser == \'Firefox\')
   ) {return true;} else {return false;}
}

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
        var html_to_prepend = \'<div class="overlay"><div class="close_icon"></div><div class="pin_container"><iframe id="pin_iframe" frameborder="0" scrolling="auto" allowtransparency="true"></iframe></div></div>\';
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
    '.((isset($_GET['mob']) and $_GET['mob']) ? 'var $container = $(\'.body-mobile #block-system-main'.(arg(0) == 'search' ? ' .view-content' : '').':has(.pin_box)\');' : 'var $container = $(\'.pin_page #content .content'.(arg(0) == 'search' ? ' .view-content' : '').':has(.pin_box)\');').'
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: \'.pin_box\',
        columnWidth: 0
        '.($language->direction ? ', isRTL: 1' : '').'
      });
    });
    '.(!(isset($_GET['mob']) and $_GET['mob']) ? '
    $container.infinitescroll({
      navSelector  : \'ul.pager\',    // selector for the paged navigation 
      nextSelector : \'ul.pager .pager-next a\',  // selector for the NEXT link (to page 2)
      itemSelector : \'.pin_box\',     // selector for all items you\'ll retrieve
      loading: {
          finishedMsg: \''.pinboard_helper_const('PINBOARD_REPLACE_NO_MORE_PINS_TO_LOAD').'\',
          img: \''.PINBOARD_REPLACE_PROGRESS_IMG.'\'
        }
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
          $newElems.animate({ opacity: 1 });
          $container.masonry( \'appended\', $newElems, true );
          if (checkBrowser()) $(\'.second_\'+a_second+\' .pin_image a\').click(pin_image_click);
          
          $(\'.like-widget:not(.like-processed)\').addClass(\'like-processed\').each(function () {
            var widget = $(this);
            var ids = widget.attr(\'id\').match(/^like\-([a-z]+)\-([0-9]+)\-([0-9]+)\-([0-9])$/);
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
      
        });
      }
    );
    ' : '').'
    
    if (checkBrowser()){ 
    	'.(!(isset($_GET['mob']) and $_GET['mob']) ? '$(\'.pin_image a\').click(pin_image_click);' : '').'
 			$(\'body\').click(function(event) {
      	if (!$(event.target).closest(\'.pin_container iframe\').length && $(\'.pin_container iframe\').length && $(\'.pin_image a\').length) {
        	history.back();
      	};
    	});
    }

  });
 
})(jQuery);
'.((isset($_GET['mob']) and $_GET['mob']) ? '
  function uploadPH() {
    //alert("An error has occurred: Code = ");
    // Retrieve image file location from specified source
    navigator.camera.getPicture(uploadPhoto,
      function(message) { alert(\'get picture failed\'); },
      { quality: 50, destinationType: navigator.camera.DestinationType.FILE_URI, sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY }
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
' : '').'
', array('type' => 'inline',  'scope' => 'footer', 'weight' => 5));
}

function pinboard_loginza_iframe($variables) {
  $widget = <<<LW
<iframe src="http://loginza.ru/api/widget?overlay=loginza&@providerslang=@lang&token_url=@token_url" class="loginza-iframe" scrolling="no" frameborder="no"></iframe>
LW;

  return _theme_loginza_widget($widget, $variables);
}

function pinboard_get_comments($pid, $node) {
	$out = '';
  $i = 4;
  $comments = comment_load_multiple(array(), array('pid' => $pid, 'nid' => $node->nid));
  $j = count($comments);
  foreach ($comments as $com) {
    $comment = comment_view($com, $node);
		$out .= '<div class="comments"><div class="comment_box">'.theme('user_picture', array('account' => $comment['#comment'])).''.theme('username', array('account' => $comment['#comment'])).' '.pinboard_truncate_utf8(strip_tags(render($comment['comment_body'])),200, true, true).'</div></div>';

    if (!$i) { 
      if ($j > 5) { 
         $out .= '<div class="comments"><div class="comment_box"><a href="'.url("node/$node->nid", array('fragment' => 'comment-form')).'">'.t('All !count comments...', array('!count' => $j)).'</a></div></div>';
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
function pinboard_preprocess_rate_template_thumbs_up(&$variables) {
  extract($variables);

  $variables['up_button'] = theme('rate_button', array('text' => t('Like'), 'href' => $links[0]['href'], 'class' => 'rate-thumbs-up-btn-up'));

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('Voting is closed.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = format_plural($results['count'], '@count Likes', '@count Likes');
    }
    else {
      $info[] = format_plural($results['count'], '@count Likes', '@count Likes');
    }
  }
  $variables['info'] = implode(' ', $info);
}

function pinboard_target_top($string) {
  $string = str_replace(array('<a ', '<form '), array('<a target="_top" ', '<form  target="_top" '), $string);
  return $string;
}

function pinboard_target_blank($string) {
  $string = str_replace(array('<a ', '<form '), array('<a target="_blank" ', '<form  target="_blank" '), $string);
  return $string;
}

function pinboard_truncate_utf8($string, $len, $wordsafe = FALSE, $dots = FALSE, &$ll = 0) {

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


