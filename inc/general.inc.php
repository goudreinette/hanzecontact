<?php

	/**
	 * Dit bestand bevat de algemen functies die niet direct toe te kennen zijn aan 
	 * objecten zoals jobs en employees.
	 */
	
	
	/**
	 * Deze functie genereerd een standaard HTML header	 
	 */
	function displayHeader() {
		
		global $config;
		
		echo "<html>";
		echo "	<head>";
		echo "		<title>".$config['pagetitle']."</title>";
		echo "		<script type=\"text/javascript\" language=\"javascript\" src=\"js/general.js\"></script>";
		echo "		<link type=\"text/css\" rel=\"stylesheet\" href=\"css/style.css\">";
		echo "	</head>";
		echo "	<body>";
		echo "		<div id=\"wrapper\">";
		
	}
	
	
	/**
	 * Deze functie genereerd een standaard HTML footer
	 */
	function displayFooter() {
		
		global $config;
		
		// hier zou plaats zijn voor bijvoorbeeld google analytics scripts
		
		echo "		</div>";
		echo "	</body>";
		echo "</html>";
		
	}
	
	/**
	 * Deze functie laat het navigatiemenu zien
	 */
	function displayNavigation() {
		echo "<div id=\"navigation\">";
		echo "	<div class=\"button\"><a href=\"index.php?action=home\">Home</a></div>";
		echo "	<div class=\"button\"><a href=\"index.php?action=jobs\">Banen</a></div>";
		echo "</div>";
	}

	/**
	 * Deze functie laat de beginpagina zien
	 */
	function displayHome() {
		echo "<h1>Welkom</h1>";
		echo "Maak een keuze uit het navigatiemenu";
	}
	
	/**
	 * Deze functies haalt alle slashes weg die gegenereerd zijn door mysql_escape_string().
	 * Deze functie doorzoekt een volledige array.
	 */
	function escapeArray($array) {
		foreach($array as $key => $value) {
			$array[$key] = stripslashes($value);
		}
		
		return $array;
	}
	
	/**
	 * Deze functie wordt gebruikt om de huidige actie te bepalen
	 * als er geen actie is opgegeven in de url dan wordt de config 
	 * standaard actie gebruikt.
	 *
	 */
	function getCurrentAction() {
		global $config;
		
		if(isset($_GET['action']) == true) {
			return $_GET['action'];
		}
		else {
			return $config['defaultaction'];
		}
	}

?>