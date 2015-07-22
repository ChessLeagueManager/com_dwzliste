<?php
/**
*	name					dwzliste.php
*	description			Komponenten-Grunddatei
*
*	start					29.11.2010
*	last edit			01.12.2010
*	done					autoload
*
*	complete				no
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

if (!defined("DS")) {
	define('DS', DIRECTORY_SEPARATOR);
}

require_once (JPATH_COMPONENT.DS.'classes/DWZText.class.php');
require_once (JPATH_COMPONENT.DS.'classes/params.class.php');
com_dwzliste_params::init();

// controller vorladen
require_once (JPATH_COMPONENT.DS.'controller.php');

// Controller-Instanz aufrufen
$controller = new DWZListeController(); // Instanziert




// Perform the Request task
$controller->execute( JRequest::getVar('task', null, 'default', 'cmd') );


// Redirect if set by the controller
$controller->redirect();

?>
