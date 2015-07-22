<?php
/**
*	name					default.php
*	description			Template default
*
*	start					30.11.2010
*	last edit			06.07.2011
*	done					Erweiterung um config-Panels
*
*	author				Helge Frowein
*	(c)					2010-2011
*/
defined('_JEXEC') or die('Restricted access');
?>

<p>Diese Komponente ermöglicht es Daten vom DSB direkt anzuzeigen.</p>
<p>Folgende Anzeigen existieren aktuell:</p>
<?php
echo "<p><a href='".JURI::root()."index.php/component/dwzliste/?view=liste&zps=63609'>Vereinsübersicht</a></p>";
echo "<p><a href='".JURI::root()."index.php/component/dwzliste/?view=stats&zps=63609&title=DJK Herdorf'>Vereinsstatistiken</a></p>";
echo "<p><a href='".JURI::root()."index.php/component/dwzliste/?view=spieler&pkz=10089054'>Spieleransicht (beta)</a></p>";
?>
<p> Die Konfiguration kann über die GET Parameter angepasst werden.

