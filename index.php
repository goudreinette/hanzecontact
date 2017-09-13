<?php

    error_reporting(E_ALL);

    include("conf/config.conf.php"); // De configuratie van het systeem
    include("inc/database.inc.php"); // Funties om verbinding met de database te maken

    include("inc/resource.inc.php"); //Resource
    include("inc/general.inc.php"); // Algemene functies zoals drawHeader en drawFooter
    include("inc/jobs.inc.php"); // Algemene functies zoals drawHeader en drawFooter

    databaseConnect(); // verbinding met de database maken


    /**
     * Resources
     */
    $jobs = new Resource("Jobs", [
        'JobTitle' => 'Titel',
        'MinSalary' => 'Minimum salaris',
        'MaxSalary' => 'Maximum salaris'
    ]);

    $locations = new Resource("Locations", [
        'StreetAddress' => 'Adres',
        'City' => 'Stad'
    ]);

    $employees = new Resource("Employees", [
        'FirstName' => 'Voornaam',
        'LastName' => 'Achternaam',
        'Salary' => 'Salaris'
    ]);


$resources = [$jobs, $locations, $employees];


foreach ($resources as $resource) {
    $lowercase = strtolower($resource->table);
    $singular  = substr(0, -2);

    switch(getCurrentAction()) {
        // Jobs
        case "insert$singular":
            $jobs->insert();
        break;
        case "update$singular":
            $jobs->update();
        break;
        case "delete$singular":
            $jobs->delete();
        break;
    }


    displayHeader(); // de HTML header tonen
    displayNavigation(); // de menubalk tonen


    // Hieronder alle functies die wel output genereren naar de browser
    switch(getCurrentAction()) {
        // Jobs
        case $lowercase:
            $jobs->display();
        break;
        case "add$singular":
            $jobs->displayAdd();
        break;
        case "edit$singular":
            $jobs->displayEdit();
        break;
        default:
        case "home":
            displayHome();
        break;
    }
}


    displayFooter(); // de HTML footer tonen
    databaseDisconnect(); // verbinding met de database verbreken
?>
