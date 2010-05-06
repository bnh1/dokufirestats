<?php 
/*
*
* This code is almost entirely copied from the Google Analytics plugin by:
*
*	Terence J. Grant
*	See: http://www.dokuwiki.org/plugin:googleanalytics
*	
* My changes to the code were made on 05/05/2010.
*
*/

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_dokufirestats extends DokuWiki_Action_Plugin {

	function getInfo(){

		return array(
			'author' => 'Benjamin Hall (base code from Terence J. Grant\'s Google Analytics Plugin)',
			'email'  => 'ben@benhall.com',
			'date'   => '2010-05-05',
			'name'   => 'Firestats Plugin',
			'desc'   => 'Plugin to call firestats on pageload',
			'url'    => 'http://benhall.com/doku/doku.php?id=firestats',
		);
	}
	
	function register(&$controller) {
	    $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE',  $this, '_addHeaders');
	}

	function _addHeaders (&$event, $param) {
		global $INFO;
		if(!$this->getConf('FIRESTATSURL')) return;
		if($this->getConf('dont_count_admin') && $INFO['isadmin']) return;
		if($this->getConf('dont_count_users') && $_SERVER['REMOTE_USER']) return;
		$event->data["script"][] = array (
		  "type" => "text/javascript",
		  "src" => $this->getConf('FIRESTATSURL'),
		);

	}
}
?>