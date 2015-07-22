<?php
// Parameter
class com_dwzliste_params {
	public static $pkz=10089054;
	public static $title="";
	public static $statusP=0;
	public static $showElo=1;
	public static $zps="66205";
	public static $start=0;
	public static $stop=0;
	public static $filter_order="dwz";
	public static $filter_order_dir="desc";
	public static $offercolorder=0;
	public static $showstatus=1;
	public static $showevaluation=1;
	public static $showbirthyear=0;
	public static $showtitle=1;
	public static $showrank=1;


	public static function init() {
		if(isset($_GET["pkz"]) && is_numeric($_GET["pkz"])) {
			self::$pkz=$_GET["pkz"];
		}
		if(isset($_GET["start"]) && is_numeric($_GET["start"])) {
			self::$pkz=$_GET["start"];
		}
		if(isset($_GET["stop"]) && is_numeric($_GET["stop"])) {
			self::$pkz=$_GET["stop"];
		}
		if(isset($_GET["title"])) {
			self::$title=htmlentities($_GET["title"]);
		}
		if(isset($_GET["statusP"]) && $_GET["statusP"]!="0") {
			self::$statusP=1;
		}
		if(isset($_GET["offercolorder"]) && $_GET["offercolorder"]!="0") {
			self::$statusP=1;
		}
		if(isset($_GET["zps"])) {
			self::$zps=preg_replace("/[^a-zA-Z0-9_äöüÄÖÜ ]/" , "" , $_GET["zps"]); 
		}
		if(isset($_GET["filter_order"])) {
			self::$zps=$_GET["filter_order"]; 
		}
		if(isset($_GET["filter_order_dir"])) {
			self::$zps=$_GET["filter_order_dir"]; 
		}
		if(isset($_GET["showbirthyear"]) && $_GET["showbirthyear"]=="0") {
			self::$showbirthyear=1;
		}
		if(isset($_GET["showElo"]) && $_GET["showElo"]=="0") {
			self::$showElo=1;
		}
		if(isset($_GET["showstatus"]) && $_GET["showstatus"]=="0") {
			self::$showstatus=1;
		}
		if(isset($_GET["showtitle"]) && $_GET["showtitle"]=="0") {
			self::$showtitle=1;
		}
		if(isset($_GET["showevaluation"]) && $_GET["showevaluation"]=="0") {
			self::$showevaluation=1;
		}
		if(isset($_GET["showrank"]) && $_GET["showrank"]=="0") {
			self::$showrank=1;
		}

	}
}
?>
