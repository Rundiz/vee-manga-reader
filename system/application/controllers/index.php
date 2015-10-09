<?php
/*
* vee's manga reader
* ดาวน์โหลดได้ที่ www.okvee.net
*/

class Index extends Controller {

	function __construct() {
		parent::Controller();
		$this->load->helper(array("file", "language"));
		$this->lang->load("front");
	}// __construct

	function index() {
		$output['page_title'] = lang("front_title_index");
		$mangadir = dirname(BASEPATH)."/".$this->config->item("manga_dir");
		if ( is_dir($mangadir) ) {
			if ( $dh = opendir($mangadir) ) {
				$count = 1;
				while (($file = readdir($dh)) !== false) {
					$filetype = filetype($mangadir.$file);// dir or file
					if ( $filetype == "dir" && $file != "." && $file != ".." ) {
						$files[] = $file;
						$count++;
					}
				}
				closedir($dh);
				@natcasesort($files);
				$output['manga'] = $files;
			}
		}
		$this->load->view("index_view", $output);
	}// index

}

/* end of file */