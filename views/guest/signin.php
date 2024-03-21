<?php

namespace Steampixel;

global $param_lang;
global $param_title;
$pages = "guest";

Component::create('layout/boxed')->assign([
  'title' => $param_title,
  'lang' =>  strtolower($param_lang),
  'pages' =>  $pages
])->print();
//compoment create by theme
Portal::send('contents-main',Component::create('content/signin') );