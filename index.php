<?php

	error_reporting(E_ALL);

	include("conf/config.conf.php"); // De configuratie van het systeem
	include("inc/database.inc.php"); // Funties om verbinding met de database te maken
	
	include("inc/general.inc.php"); // Algemene functies zoals drawHeader en drawFooter
	include("inc/jobs.inc.php"); // Algemene functies zoals drawHeader en drawFooter
		
	databaseConnect(); // verbinding met de database maken
	
	// Hieronder alle functies die geen output genereren naar de browser
	// Dit is nodig om de 'warning headers already sent' fout te voorkomen
	switch(getCurrentAction()) {				
		case "insertjob":
			addJob();
		break;
		case "updatejob":
			updateJob();
		break;		
		case "deletejob":
			deleteJob();
		break;
	}
	
	displayHeader(); // de HTML header tonen	
	displayNavigation(); // de menubalk tonen
	
	// Hieronder alle functies die wel output genereren naar de browser
	switch(getCurrentAction()) {		
		case "jobs":
			displayAllJobs();
		break;	
		case "addjob":
			displayAddJob();	
		break;
		case "editjob":
			displayEditJob();
		break;		
		default:
		case "home":
			displayHome();
		break;
	}
		
	
	displayFooter(); // de HTML footer tonen
	
	databaseDisconnect(); // verbinding met de database verbreken

?>