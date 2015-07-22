<?php
/**
*	name					view.html.php
*	description			view
*
*	start					01.12.2010
*	last edit			29.12.2010
*	done					stylesheet
*
*	complete				no
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010
*/
jimport( 'joomla.application.component.view');

class DWZListeViewSpieler extends JViewLegacy
{
	function display($tpl = null) {
		
		$model		= $this->getModel();
		
		$mainframe = JFactory::getApplication();
		$document = JFactory::getDocument();
		if (count($model->player)>0) {
			$document->setTitle($mainframe->getCfg('sitename')." - ".JText::_('DWZ_RECORD').": ".$model->player[1][1].", ".$model->player[1][2]);
		} else {
			$document->setTitle($mainframe->getCfg('sitename')." - ".JText::_('DWZ_RECORD').": ".JText::_('NO_DATA'));
		}
		$document->addStyleSheet('components'.DS.'com_dwzliste'.DS.'css'.DS.'style.css');

		$this->assignRef('player', $model->player);
		$this->assignRef('hierarchy', $model->hierarchy);
		$this->assignRef('clubs', $model->clubs);
		$this->assignRef('tournaments', $model->tournaments);

		$this->assignRef('url', $model->url);
		
		parent::display($tpl);
	}
	
}
?>
