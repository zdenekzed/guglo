<?php 
if (theme_get_setting('tm_value_topblank')) {
    $target = '_blank';
} else {
    $target = '_top';
}
 $n1 = '';
  $c = count($rows);
  $i = 1;
 foreach ($rows as $id => $row) {
  if ($c == $i) $n1 .= '<div class="last"><a target="'.$target.'" href="!taxonomy_term">'.$row.'</a></div>';
  else $n1 .= '<a target="'.$target.'" href="!taxonomy_term">'.$row.'</a>';
  $i++;
}

print ($n1 ? ''.$n1.'' : '');

?>