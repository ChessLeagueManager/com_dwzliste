<?php
/**
*	name					view.html.php
*	description			view für dwzliste
*
*	start					30.11.2010
*	last edit			30.11.2010
*	done					start
*
*	complete				no
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class DWZListeViewDWZListe extends JViewLegacy {

	function display($tpl = NULL) {
		// Die Toolbar erstellen, die über der Seite angezeigt wird
		JToolBarHelper::title( 'DWZ-Liste' );
		parent::display();

	}

}
?>
