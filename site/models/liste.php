<?php
/**
*	name					liste.php
*	description			Modelt für liste
*
*	start					30.11.2010
*	last edit			12.12.2010
*	done					Umbau date
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


class DWZListeModelListe extends JModelLegacy {
	
	
	function __construct() {
		
		parent::__construct();

		$this->order['by'] = com_dwzliste_params::$filter_order;
		$this->order['dir'] = com_dwzliste_params::$filter_order_dir;

		$this->_getData();

	}
	
	
	
	function _getData() {
	
		$zps = com_dwzliste_params::$zps;
		
		$urlCSV = "http://www.schachbund.de/php/dewis/verein.php?zps=".$zps."&format=csv";
 		
		$this->url = "http://www.schachbund.de/verein.html?zps=".$zps;
 
		if (!$handle = fopen($urlCSV, "r")) { 
		
			JError::raiseNotice(100, JText::_('NO_CONNECTION'));
		
		} else {
			$counter = 0;
			while ($row = fgetcsv($handle, 500, "|")) {
				
				$counter++;
			
				if ($counter == 1) { // datum
					$this->date = '';
			
				} elseif ($row[0] != "") { // leere Zeilen ausscheiden
					$this->data[$counter] = $row;
					
				}
				// neu seit 2013:
				// 0 => id
				// 1 => Nachname
				// 2 => Vorname
				// 3 => Titel
				// 4 => Verein (ZPS)
				// 5 => Mitgliedsnummer
				// 6 => Status
				// 7 => DWZ
				// 8 => DWZ-Index
				// 9 => Turniercode
				// 10 => Turnierende
				// 11 => FIDE-Id
				// 12 => FIDE-Elo
				// 13 => FIDE-Titel

				// array enthält:
				// in Zeile 0: Datum der Aktualisierung
				// 0 => ZPS
				// 1 => MglNr
				// 2 => Status
				// 3 => Nachname,Vorname
				// 4 => Geschlecht (M/W)
				// 5 => Geburtsjahr
				// 6 => Titel
				// 7 => letzte Auswertung (JJJJWW)
				// 8 => DWZ
				// 9 => AUswertungen
				// 10 => ELO

			}
		
			// Sortierung
			// Obtain a list of columns
			foreach ($this->data as $key => $temp) {
				// dwz
				if (is_numeric($temp[7])) {
					$dwz[$key]  = $temp[7];
				} else {
					$dwz[$key] = 0;
				}
				//name
				$name[$key] = $temp[3] . " " . $temp[1] . "," . $temp[2];
				// year
				$year[$key] = "";
				// evaluation
				$eval[$key] = $temp[10];
				// mascfem
				$mascfem[$key] = "";
				// status
				$status[$key] = $temp[6];
				//elo
				if (is_numeric($temp[12])) {
					$elo[$key]  = $temp[12];
				} else {
					$elo[$key]  = 0;
				}
			}
			
			switch ($this->order['by']) {
				case 'name':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_STRING, $name, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_STRING, $name, SORT_ASC);
					}
					break;
				case 'mascfem':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_STRING, $mascfem, SORT_DESC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_STRING, $mascfem, SORT_ASC, $dwz, SORT_DESC);
					}
					break;
				case 'status':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_STRING, $status, SORT_DESC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_STRING, $status, SORT_ASC, $dwz, SORT_DESC);
					}
					break;
				case 'year':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_NUMERIC, $year, SORT_DESC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_NUMERIC, $year, SORT_ASC, $dwz, SORT_DESC);
					}
					break;
				case 'eval':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_NUMERIC, $eval, SORT_DESC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_NUMERIC, $eval, SORT_ASC, $dwz, SORT_DESC);
					}
					break;
				case 'elo':
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_NUMERIC, $elo, SORT_DESC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_NUMERIC, $elo, SORT_ASC, $dwz, SORT_DESC);
					}
					break;
				case 'dwz':
				default:
					if ($this->order['dir'] == 'desc') {
						array_multisort($this->data, SORT_NUMERIC, $dwz, SORT_DESC);
					} else {
						array_multisort($this->data, SORT_NUMERIC, $dwz, SORT_ASC);
					}
					break;
			
			}
		
		}
		
	}
	

}
?>
