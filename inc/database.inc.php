<?php

	/**
	 * Dit bestand bevat alle functies die nodig zijn om een
	 * verbinding met de database tot stand te brengen en de
	 * verbreken
	 */

	/**
	 * Deze functie maakt een verbinding met de MySQL server
	 * en gebruikt daarvoor de variabelen de globale array
	 * $config. Daarna selecteerd deze functie de juiste database.
	 *
	 */
	function databaseConnect() {
			global $config;
			
			mysql_connect(	$config['mysql']['hostname'],
							$config['mysql']['username'],
							$config['mysql']['password']  );
			
			mysql_select_db($config['mysql']['database']);
							
	}
	
	/**
	 * Deze functie verbreekt de verbinding met de database server
	 *
	 */
	function databaseDisconnect() {
		
		mysql_close();
		
	}
	
	
?>