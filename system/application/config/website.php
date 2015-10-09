<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *for additional website config eg. base path (or know as root web)
 *add by mr.v automatic
 */

$config['base_uri'] = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	define('_W_ROOT_', $config['base_uri']);

// main time zone refer value from date helper um12 - up12
$config['main_timezone'] = 'UP7';

// mangas directory from root site. end with slash /
// default is manga/
$config['manga_dir'] = 'manga/';
	define('_W_MANGA_', $config['manga_dir']);

// website theme name (just name)
$config['web_theme'] = "default";

/* End of file website.php */
/* Location: ./system/application/config/website.php */