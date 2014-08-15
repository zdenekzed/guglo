<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" lang="<?php print $language->language; ?>">  
<head>
  <?php global $base_url; ?>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Rokkitt:400,700" />
  <?php print $styles; ?>
  <?php if (empty($_GET['mob'])) $_GET['mob'] = 0; ?>
  <?php if (empty($_GET['ovr'])) $_GET['ovr'] = 0; ?>
  <?php $m1 = ($_GET['ovr'] or $_GET['mob'] or arg(0) == 'nodes_mobile'); ?>
  <?php $m2 = ($_GET['mob'] or arg(0) == 'nodes_mobile'); ?>
  <?php if (!$m1) { ?>
  <style type="text/css">
    body{
      background:url(<?php print $base_url.'/'.drupal_get_path('theme','pinboard2') ?>/bg/bg<?php print theme_get_setting('tm_value_5') ?>.jpg);
    }
  </style>
  <?php } ?>
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php print $scripts; ?>

</head>
<body<?php if (!$m2) { ?> class="<?php if ($_GET['ovr']) { print str_replace(array('toolbar-drawer','toolbar'), '', $classes).' ovr'; } else {print $classes; }?>" <?php print $attributes;?><?php } ?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php if (!$m1) print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>


