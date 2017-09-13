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



    displayHeader(); // de HTML header tonen
    displayNavigation(); // de menubalk tonen


    foreach ($resources as $resource) {
        $lowercase = $resource->lowercase;
        $singular = $resource->singular;

        switch(getCurrentAction()) {
            // Jobs
            case "insert$singular":
                $resource->insert();
            break;
            case "update$singular":
                $resource->update();
            break;
            case "delete$singular":
                $resource->delete();
            break;
        }


        // Hieronder alle functies die wel output genereren naar de browser
        switch(getCurrentAction()) {
            // Jobs
            case $lowercase:
                $resource->display();
            break;
            case "add$singular":
                $resource->displayAdd();
            break;
            case "edit$singular":
                $resource->displayEdit();
            break;
        }
    }


    displayFooter(); // de HTML footer tonen
    databaseDisconnect(); // verbinding met de database verbreken
?>
