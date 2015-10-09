<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * @author mr.v
 */

class Read extends Controller {
	
	function __construct() {
		parent::Controller();
		$this->load->helper(array("file", "language", 'url'));
		$this->lang->load("front");
	}// __construct
	
	function _remap() {
		$manga = $this->uri->segment(2);// /read/manga
		$chapter = $this->uri->segment(3);// /read/manga/chapter
		$atpage = $this->uri->segment(4);// /read/manga/chapter/page1
		//$this->index($manga, $chapter);
		if ( $manga == null ) {
			redirect(base_url(), 'location');
		}// no manga select
		if ( $chapter == null ) {
			// go to list chapter
			$this->list_chapter($manga, $chapter, $atpage);
		} else {
			// reading chapter, go to read chapter method (atpage)
			$atpage = ( $atpage == null ? "1" : $atpage );
			$this->read_page($manga, $chapter, $atpage);
		}
	}// _remap
	
	function list_chapter($manga = '', $chapter = '', $atpage = '') {
		$output['page_title'] = lang("front_title_index") . " : " . $manga;
		$mangadir = dirname(BASEPATH)."/".$this->config->item("manga_dir").$manga."/";
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
				$output['chapters'] = $files;
			}
		}
		// load preview image
		if ( file_exists($mangadir."preview.jpg") ) {
			$output['preview_image'] = "preview.jpg";
		}
		$output['manga'] = $manga;
		$this->load->view("list_chapter_view", $output);
	}// list_chapter()
	
	function read_page($manga = '', $chapter = '', $atpage = '') {
		$output['page_title'] = lang("front_title_index") . " : " . $manga . " " . $chapter;
		$mangadir = dirname(BASEPATH)."/".$this->config->item("manga_dir").$manga."/".$chapter."/";
		/* list pages */
		if ( is_dir($mangadir) ) {
			/*if ( $dh = opendir($mangadir) ) {
				$count = 1;
				while (($file = readdir($dh)) !== false) {
					$filetype = filetype($mangadir.$file);// dir or file
					if ( $filetype == "file" && $file != "." && $file != ".." ) {
						$files[] = $file;
						$count++;
					}
				}
				closedir($dh);
				natcasesort($files);
				$output['pages'] = $files;
				$output['total_page'] = $count-1;
				unset($files);
			}*/// not work on unix
			$dir = scandir($mangadir);
			$count = 1;
			foreach ( $dir as $k => $v ) {
				$filetype = filetype($mangadir.$v);// dir or file
				if ( $filetype == "file" && $v != "." && $v != ".." ) {
					$files[] = $v;
					$count++;
				}
			}
			$output['pages'] = $files;
			$output['total_page'] = $count-1;
			unset($files);
		}
		/* end list pages */// //////////////////////////////
		/* get current page */
		$output['current_page'] = "1";
		if ( is_dir($mangadir) ) {
			/*if ( $dh = opendir($mangadir) ) {
				$count = 1;
				while (($file = readdir($dh)) !== false) {
					$filetype = filetype($mangadir.$file);// dir or file
					if ( $filetype == "file" && $file != "." && $file != ".." ) {
						if ( $atpage == $count ) {
							$files = $file;
							break;
						}
						$count++;
					}
				}
				closedir($dh);
				//natcasesort($files);
				$output['current_page'] = $count;
				$output['file_name'] = $files;
			}*/// not work on unix
			$dir = scandir($mangadir);
			$count = 1;
			foreach ( $dir as $k => $v ) {
				$filetype = filetype($mangadir.$v);// dir or file
				if ( $filetype == "file" && $v != "." && $v != ".." ) {
					if ( $atpage == $count ) {
						$files = $v;
						break;
					}
					$count++;
				}
			}
			$output['current_page'] = $count;
			$output['file_name'] = $files;
		}
		/* end get current page */// //////////////////////////////
		/* get next page */
		if ( $output['current_page']+1 > $output['total_page'] ) {
			// next chapter
			$output['next_page'] = _W_ROOT_.$this->uri->segment(1)."/".$manga;// don't know how to find next folder, go to manga directory
		} else {
			$output['next_page'] = _W_ROOT_.$this->uri->segment(1)."/".$manga."/".$chapter."/".($output['current_page']+1);
		}
		/* end get next page */// //////////////////////////////
		/* get previous page */
		if ( $output['current_page']-1 == "0" ) {
			// previous chapter
			$output['previous_page'] = _W_ROOT_.$this->uri->segment(1)."/".$manga;// don't know how to find previous folder, go to manga directory
		} else {
			$output['previous_page'] = _W_ROOT_.$this->uri->segment(1)."/".$manga."/".$chapter."/".($output['current_page']-1);
		}
		/* end get previous page */// //////////////////////////////
		$output['manga'] = $manga;
		$output['chapter'] = $chapter;
		$this->load->view("read_page_view", $output);
	}// read_page
	
}

/* eof */