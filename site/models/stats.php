<?php
/**
*	name					stats.php
*	description			Model für stats
*
*	start					07.12.2010
*	last edit			07.12.2010
*	done					start
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


class DWZListeModelStats extends JModelLegacy {
	
	
	function __construct() {
		
		parent::__construct();

		$this->_getData();

	}
	
	
	
	function _getData() {
	
		$zps = com_dwzliste_params::$zps;
		
		$urlCSV = "http://www.schachbund.de/php/dewis/verein.php?zps=".$zps."&format=csv";
 		
		$this->url = "http://www.schachbund.de/verein.html?zps=".$zps;
		
		if (!$handle = fopen($urlCSV, "r")) { 
		
			JError::raiseNotice(100, JText::_('NO_CONNECTION'));
		
		} else {
			
			// INIT
			$counter = 0; // zeilen des CSV werden gezählt
			$counterReal = 0; // nur zeilen der Spieler
			$this->stats = array();
			$this->stats['countPlayersAll'] = 0;
			$this->stats['countPlayersDWZ'] = 0;
			$this->stats['DWZTotal'] = 0;
			$this->stats['DWZRangeTop'] = 0;
			$this->stats['DWZRangeLow'] = 9000;
			$this->stats['countPlayersELO'] = 0;
			$this->stats['ELOTotal'] = 0;
			$this->stats['ELORangeTop'] = 0;
			$this->stats['ELORangeLow'] = 9000;
			$this->stats['countPlayersTitle'] = 0;
			
			$includestatusp = com_dwzliste_params::$statusP;
			
			$start = com_dwzliste_params::$start;
			$stop = com_dwzliste_params::$stop;

			if ($start!=0 && $stop!=0) {
				$arrayTopIntervals = explode(",", $statstopintervals);
				// zerlegen in entsprechende Parameter
				foreach ($arrayTopIntervals as $key => $value) {
					// Wert weitergeben in view
					$this->topIntervals[$key]['string'] = $value;
						$this->topIntervals[$key]['start'] = 1;
						$this->topIntervals[$key]['end'] = $value;
					$this->topIntervals[$key]['counter'] = 0; // Anzahl der Einträge
					$this->topIntervals[$key]['sum'] = 0;
				}
			} else {
				$arrayTopIntervals = array();
			}
			
			while ($row = fgetcsv($handle, 500, "|")) {
			
				$counter++;
			
				// Datumszeile ausscheiden!
				if ($counter == 1) {
					$this->date = $row[0];
			
				} elseif ($row[0] != "") { // leere Zeilen ausscheiden
					
					// evtl Status 'P' ausscheiden
					if ($row[2] != 'P' OR $includestatusp == 1) {
					
						$counterReal++;
						
						// alle Spieler
						$this->stats['countPlayersAll']++;
						
						if ($row[8] > 0) {
							$this->stats['countPlayersDWZ']++;
							$this->stats['DWZTotal'] += $row[8];
						
							// Range
							if ($row[8] > $this->stats['DWZRangeTop']) {
								$this->stats['DWZRangeTop'] = $row[8];
							}
							if ($row[8] < $this->stats['DWZRangeLow']) {
								$this->stats['DWZRangeLow'] = $row[8];
							}
						
							// TopIntervals gegeben?
							if (!empty($arrayTopIntervals)) {
								// alle Intervalle durchgehen
								foreach ($arrayTopIntervals as $key => $value) {
									// counter trifft Interval?
									if ($counterReal >= $this->topIntervals[$key]['start'] AND $counterReal <= $this->topIntervals[$key]['end']) {
										$this->topIntervals[$key]['sum'] += $row[8];
										$this->topIntervals[$key]['counter']++;
									}
								}
							}
						
						}
						
						// Elo
						if ($row[10] > 0) {
							$this->stats['countPlayersELO']++;
							$this->stats['ELOTotal'] += $row[10];
						
							// Range
							if ($row[10] > $this->stats['ELORangeTop']) {
								$this->stats['ELORangeTop'] = $row[10];
							}
							if ($row[10] < $this->stats['ELORangeLow']) {
								$this->stats['ELORangeLow'] = $row[10];
							}
						
						}
						
						// Title
						if ($row[6] != '') {
							$this->stats['countPlayersTitle']++;
						}
					
					}
					// Ende Status 'P'
				
				}
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
		
			// alle Daten weiterverabeiten
			$this->stats['DWZAverage'] = floor($this->stats['DWZTotal']/$this->stats['countPlayersDWZ']);
			$this->stats['ELOAverage'] = floor($this->stats['ELOTotal']/$this->stats['countPlayersELO']);
			
			// TopIntervals weiterverarbeiten
			foreach ($arrayTopIntervals as $key => $value) {
				$this->topIntervals[$key]['value'] = floor($this->topIntervals[$key]['sum']/$this->topIntervals[$key]['counter']);
			}
		
		
		}
		
	}
	

}
?>
