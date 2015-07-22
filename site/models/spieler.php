<?php
/**
*	name					liste.php
*	description			Modelt für liste
*
*	start					30.11.2010
*	last edit			16.12.2010
*	done					Bugfix ZPS als String statt als Int
*
*	complete				no
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010 VTT Champions
*/
defined('_JEXEC') or die();

jimport('joomla.application.component.model');


class DWZListeModelSpieler extends JModelLegacy {
	public $player=array();
	public $hierarchy=array();
	public $clubs=array();
	public $tournaments=array();
	
	function __construct() {
		
		parent::__construct();
		$this->pkz = com_dwzliste_params::$pkz;
		$this->_getData();
	}
	
	
	
	function _getData() {
	
		$urlCSV = "http://www.schachbund.de/php/dewis/spieler.php?pkz=".$this->pkz."&format=csv";
		
		$this->url = "http://www.schachbund.de/spieler.html?pkz=".$this->pkz;
		
		if (!$handle = fopen($urlCSV, "r")) { 
			JError::raiseNotice(100, JText::_('NO_CONNECTION'));
		} else {
			$counter=0;
			while ($row = fgetcsv($handle, 0, "|")) {
			
				if($row[0]=="zpsver") {
					$counter++;
				}
				if(count($row)==10) {
					$this->player[] = $row;
				} else if(count($row)==4 && $counter==1) {
					$this->hierarchy[] = $row;
				} else if(count($row)==4 && $counter==2) {
					$this->clubs[] = $row;
				} else if(count($row)==13) {
					$this->tournaments[] = $row;
				}
			}
		
		}
		
		
	}
	

}
?>
