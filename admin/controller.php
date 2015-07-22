<?php
/**
*	name					controller.php
*	description			Basis Controller
*
*	start					30.11.2010
*	last edit			06.07.2011
*	done					Umbau für config
*
*	complete				yes
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010-2011
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


class DWZListeController extends JControllerLegacy {
	
	function __construct() {
		
		parent::__construct();

	}

	
	function display($cachable = false, $urlparams = array()) {

		parent::display();

	}


	function save() {
	
		if ($this->_saveDo()) { // erfolgreich?
			
			$app =& JFactory::getApplication();
			$app->enqueueMessage( JText::_('CONFIG_SAVED') );
		
		}
		// sonst Fehlermeldung schon geschrieben

		$this->setRedirect( 'index.php?option=com_dwzliste' );
	
	}


	function _saveDo() {
	
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
	
		$table = JTable::getInstance('component');
		if (!$table->loadByOption('com_dwzliste')) {
			JError::raiseWarning(500, 'Not a valid component');
			return false;
		}
		
		$post = JRequest::get('post');
		$table->bind($post);
		
		//-- Pre-save checks
		if (!$table->check()) {
			JError::raiseWarning(500, $table->getError());
			return false;
		}
		
		//-- Save the changes
		if (!$table->store()){
			JError::raiseWarning(500, $table->getError());
			return false;
		}		

		return TRUE;
	
	}


	// Default-Methode 
	function cancel() {
		
		$this->setRedirect( 'index.php?option=com_dwzliste', JText::_('IRREGULAR_ABORT') );
	
	}

}
?>
