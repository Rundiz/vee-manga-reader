<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* custom input */

class MY_Input extends CI_Input {

    function __construct() {
		parent::CI_Input();
		/* allow $_GET */
		$pos = strrpos($_SERVER['REQUEST_URI'], '?');
		$qry = is_int($pos) ? substr($_SERVER['REQUEST_URI'], ++$pos) : '';
		parse_str($qry, $_GET);
		/* allow $_GET */
	}
    
}

/* end MY_Input.php */