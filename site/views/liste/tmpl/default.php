<?php
/**
*	name					default.php
*	description			Template Default für liste
*
*	start					30.11.2010
*	last edit			12.12.2010
*	done					Umbau auf $this-Date; Einbau order
*
*	complete				no
*	todo					-
*	wanted				-
*	notes					-
*
*	author				Helge Frowein
*	(c)					2010 VTT Champions
*/
defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">

function tableOrdering( order, dir, task ) {
	var form = document.siteForm;

	form.filter_order.value 	= order;
	form.filter_order_Dir.value	= dir;
	document.siteForm.submit( task );
}
</script>

<div id="dwz_liste">
<div id="dwzansicht">

<form action="index.php" method="post" name="siteForm">

<?php

	
	$listheading = com_dwzliste_params::$title;
	if ($listheading != "") {
		echo '<div class="componentheading">'.str_replace('{datum}', $this->date, $listheading).'</div>';
	}
	
	$offercolorder = com_dwzliste_params::$offercolorder;
	
	if (count($this->data) > 0) {
	
		echo '<table width="100%">';
		
		// Headers
		echo '<tr>';
			
			// Rank
			$showrank = com_dwzliste_params::$showrank;
			if ($showrank == 1) {
				echo '<th align="center">'.JText::_('NUMBER_ABB').'</th>';
			}
			
			// Titel
			$showtitle = com_dwzliste_params::$showtitle;
			if ($showtitle == 1) {
				echo '<th align="center">'.JText::_('FIDE_TITLE').'</th>';
			}
		
			// Name
			echo '<th align="center">';
			if ($offercolorder == 0) {
				echo JText::_('PLAYERNAME');
			} else {
				echo JHTML::_('grid.sort', JText::_('PLAYERNAME'), 'name', $this->order['dir'], $this->order['by']);
			}
			echo '</th>';
			
			// Geburtsjahr
			$showbirthyear = com_dwzliste_params::$showbirthyear;
			if ($showbirthyear == 1) {
				echo '<th align="center">';
				if ($offercolorder == 0) {
					echo JText::_('YEAROFBIRTH');
				} else {
					echo JHTML::_('grid.sort', JText::_('YEAROFBIRTH'), 'year', $this->order['dir'], $this->order['by']);
				}
				echo '</th>';
			}
			
			// letzte Auswertung
			$showevaluation = com_dwzliste_params::$showevaluation;
			if ($showevaluation == 1) {
				echo '<th align="center">';
				if ($offercolorder == 0) {
					echo JText::_('EVALUATION');
				} else {
					echo JHTML::_('grid.sort', JText::_('EVALUATION'), 'eval', $this->order['dir'], $this->order['by']);
				}
				echo '</th>';
			}
			
			// DWZ
			echo '<th align="center" colspan="3">';
			if ($offercolorder == 0) {
				echo JText::_('DWZ');
			} else {
				echo JHTML::_('grid.sort', JText::_('DWZ'), 'dwz', $this->order['dir'], $this->order['by']);
			}
			echo '</th>';
		
			// ELO
			$showelo = com_dwzliste_params::$showElo;
			if ($showelo == 1) {
				echo '<th align="center">';
				if ($offercolorder == 0) {
					echo JText::_('FIDE_ELO');
				} else {
					echo JHTML::_('grid.sort', JText::_('FIDE_ELO'), 'elo', $this->order['dir'], $this->order['by']);
				}
				echo '</th>';
			}
			
			// Status
			$showstatus = com_dwzliste_params::$showstatus;
			if ($showstatus == 1) {
				echo '<th align="center">';
				if ($offercolorder == 0) {
					echo JText::_('STATUS');
				} else {
					echo JHTML::_('grid.sort', JText::_('STATUS'), 'status', $this->order['dir'], $this->order['by']);
				}
				echo '</th>';
			}
		
		
		echo '</tr>';
		
		$classrow1 = "row1";
		$classrow2 = "row2";
		
		
		$counter = 0;
		
		foreach ($this->data as $key => $value) {
			$counter++;	
		
			if ($counter%2 == 0) { // gerade 
				$class = $classrow1; 
			} else { 
				if ($classrow2 != '') {
					$class = $classrow2; 
				} else {
					$class = $classrow1;
				}
			}
			echo '<tr class='.$class.'>';
				
				// Rank
				if ($showrank == 1) {
					echo '<td align="right">'.$counter.'</td>';
				}
				
				// Titel
				if ($showtitle == 1) {
					echo '<td align="center">'.$value[13].'</td>';
				}
				
				// Name
				echo '<td align="left">';
				if ($value[5] < 1000) {
					$value[5] = "0" . $value[5];
				}
				if ($value[5] < 100) {
					$value[5] = "0" . $value[5];
				}
				echo '<a target="spielerdwz" href="'.JRoute::_('http://www.schachbund.de/spieler.html?zps='.$value[4].'-'.$value[5]).'">';
				echo $value[3] . " ". $value[1]. "," . $value[2];
				echo '</a></td>';
			
				if ($showbirthyear == 1) {
					echo '<td align="center">'.$value[5].'</td>';
				}
			
				// letzte Auswertung
				if ($showevaluation == 1) {
					echo '<td align="center">'.$value[10].'</td>';
				}
			
				// DWZ & Auswertungen - in 3 Spalten
				if (is_numeric($value[8])) { // Zahl
					// DWZ
					echo '<td align="right">'.$value[7].'</td>';
					// spacer
					echo '<td align="center">-</td>';
					// Auswertungen
					echo '<td align="right">'.$value[8].'</td>';
				} elseif ($value[8] == "Restpartien") {
					echo '<td align="center" colspan="3">'.JText::_('LEFTOVER_GAMES').'</td>';
				} else {
					echo '<td align="center" colspan="3">- - -</td>';
				}
				
				
				// ELO
				if ($showelo == 1) {
					if (is_numeric($value[12])) {
						echo '<td align="center">'.$value[12].'</td>';
					} else {
						echo '<td align="center">- - -</td>';
					}
				}
				
				// Status
				if ($showstatus == 1) {
					echo '<td align="center">'.$value[6].'</td>';
				}
				
			
			echo '</tr>';
		
		}
			
		echo '</table><br />';
		
		// DSB-Box
			echo '<div class="normal"><table width="100%" >';
				echo '<tr>';
					echo '<td>'.JText::_('DATA_BY_DSB').'</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>'.JText::_('DWZ_LISTE').': <a href="'.$this->url.'" target="_blank">'.$this->url.'</a></th>';
				echo '</tr>';
			echo '</table></div><br />';
		
	}
	?>

	<input type="hidden" name="option" value="com_dwzliste" />
	<input type="hidden" name="view" value="liste" />
	<input type="hidden" name="layout" value="default" />
	<input type="hidden" name="filter_order" value="<?php echo $this->order['by']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->order['dir']; ?>" />


</form>

</div>
</div>


