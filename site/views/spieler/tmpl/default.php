<?php
/**
*	name					default.php
*	description			Template Default für spieler
*
*	start					01.12.2010
*	last edit			05.12.2010
*	done					printCreatedBy
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

if(count($this->player)!=0 || count($this->hierarchy)!=0 || count($this->clubs)!=0 || count($this->tournaments)!=0) {

	if(count($this->player)==2) {
		echo "<table class='dwzliste dwzliste_player'><tr>";
		for($i=0;$i<count($this->player[0]);$i++) {
			echo "<th>".JText::_($this->player[0][$i])."</th>";
		}
		echo "</tr><tr>";
		for($i=0;$i<count($this->player[1]);$i++) {
			echo "<td>".$this->player[1][$i]."</td>";
		}
		echo "</tr></table>";
	}


	if(count($this->hierarchy)>1) {
		echo "<table class='dwzliste dwzliste_hierarchy'><tr>";
		for($i=0;$i<count($this->hierarchy[0]);$i++) {
			echo "<th>".JText::_($this->hierarchy[0][$i])."</th>";
		}
		echo "</tr>";
		for($i=1;$i<count($this->hierarchy);$i++) {
			echo "<tr>";
			for($p=0;$p<count($this->hierarchy[$i]);$p++) {
				echo "<td>".$this->hierarchy[$i][$p]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	if(count($this->clubs)>1) {
		echo "<table class='dwzliste dwzliste_clubs'><tr>";
		for($i=0;$i<count($this->clubs[0]);$i++) {
			echo "<th>".JText::_($this->clubs[0][$i])."</th>";
		}
		echo "</tr>";
		for($i=1;$i<count($this->clubs);$i++) {
			echo "<tr>";
			for($p=0;$p<count($this->clubs[$i]);$p++) {
				echo "<td>".$this->clubs[$i][$p]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	if(count($this->tournaments)>1) {
		echo "<table class='dwzliste dwzliste_tournaments'><tr>";
		for($i=0;$i<count($this->tournaments[0]);$i++) {
			echo "<th>".JText::_($this->tournaments[0][$i])."</th>";
		}
		echo "</tr>";
		for($i=1;$i<count($this->tournaments);$i++) {
			echo "<tr>";
			for($p=0;$p<count($this->tournaments[$i]);$p++) {
				echo "<td>".$this->tournaments[$i][$p]."</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
		
	// DSB-Box
		echo '<div class="normal"><table width="100%">';
			echo '<tr>';
				echo '<td>'.JText::_('DATA_BY_DSB').'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>'.JText::_('DWZ_RECORD').': <a href="'.$this->url.'" target="_blank">'.$this->url.'</a></th>';
			echo '</tr>';
		echo '</table></div>';

} else {

	echo JText::_('NO_DATA');

}
		
?>

</div>
</div>



