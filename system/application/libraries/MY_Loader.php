<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * author: mr.v automatic.
 */

class MY_Loader extends CI_Loader {

	function __construct() {
		parent::CI_Loader();
		/* change view folder */
		$this->_ci_view_path = dirname(dirname(dirname(dirname(__FILE__))))."/web-content/themes/";
	}

	/**
	 * Load View
	 *
	 * modify load view of CI by check at outside CI first
	 *
	 * @access	public
	 * @param	string
	 * @param	array
	 * @param	bool
	 * @return	void
	 */
	function view($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();
		// get theme name from cookie
		$cweb_theme = get_cookie("web_theme");
		if ( $cweb_theme != NULL ) {
			// check file exist for cookie theme setting
			if ( !file_exists($this->_ci_view_path.$cweb_theme."/".$view.".php") ) {
				delete_cookie("web_theme");
				$web_theme = $CI->config->item('web_theme')."/";
			} else {
				$web_theme = $cweb_theme."/";
			}
			//end check file exist for cookie theme setting
		} else {
			$web_theme = $CI->config->item('web_theme')."/"; // ? why do i need get instance $CI? wah?
		}
		// start load view
		if ( file_exists($this->_ci_view_path.$web_theme.$view.".php") ) {
			// look in /vb-content/themes/theme_name/file first and found
			return $this->_ci_load(array('_ci_view' => $web_theme.$view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
			// return in /vb-content/themes/theme_name
		} else {
			$this->_ci_view_path = APPPATH.'views/';
			if ( file_exists($this->_ci_view_path.$web_theme.$view.".php") ) {
				// look in CI views/theme_name/file and found.
				return $this->_ci_load(array('_ci_view' => $web_theme.$view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
				// return in CI views/theme_name/file
			} else {
				// not found on anywhere
				return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
				//return in CI views/file
			}
		}
	}
	
}

/* end of file */
