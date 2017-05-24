<?php 

$wpo = new WPO_SubTheme();
$protocol = is_ssl() ? 'https:' : 'http:';

// Add size image
$wpo->addImagesSize('blog-thumbnail',300,250,true);

// Add Menus
$wpo->addMenu('mainmenu','Main Menu');

// AddScript
$wpo->addScript('noty_js',WPO_THEME_URI.'/js/jquery.noty.packaged.min.js',array(),false,true);
$wpo->addScript('main_js',get_template_directory_uri().'/js/main.js',array(),false,true);


// Add Google Font
$wpo->addStyle('theme-Noticia-Text-font',$protocol.'//fonts.googleapis.com/css?family=Noticia+Text:400,700');

$wpo->init();