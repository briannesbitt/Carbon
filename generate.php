<?php

$template = file_get_contents('template.src.html');

function gen($page, $out, $jumbotron = '') {
  global $template;
  $html = $template;
  $html = str_replace('#{page}', $page, $html);
  $html = str_replace('#{jumbotron}', $jumbotron, $html);
  file_put_contents($out, $html);
}

gen(file_get_contents('index.src.html'), 'index.html', file_get_contents('jumbotron.src.html'));
gen(file_get_contents('contribute.src.html'), 'contribute.html');