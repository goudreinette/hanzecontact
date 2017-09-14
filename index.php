<?php

    error_reporting(E_ALL);

    include("conf/config.conf.php"); // De configuratie van het systeem
    include("inc/database.inc.php"); // Funties om verbinding met de database te maken

    include("inc/resource.inc.php"); // Resource
    include("inc/general.inc.php"); // Algemene functies zoals drawHeader en drawFooter

    databaseConnect(); // verbinding met de database maken

    /**
     * Resources
     */
    $jobs = new Resource("Jobs", [
        'showInList' => ['JobTitle', 'MinSalary', 'MaxSalary'],
        'labels' => [
            'JobTitle' => 'Titel',
            'MinSalary' => 'Minimum salaris',
            'MaxSalary' => 'Maximum salaris'
        ]
    ]);

    $locations = new Resource("Locations", [
        'showInList' => ['StreetAddress', 'City'],
        'labels' => [
            'StreetAddress' => 'Adres',
            'City' => 'Stad'
        ]
    ]);

    $employees = new Resource("Employees", [
        'showInList' => ['FirstName', 'LastName', 'Salary'],
        'labels' => [
            'FirstName' => 'Voornaam',
            'LastName' => 'Achternaam',
            'Salary' => 'Salaris'
        ]
    ]);

    displayHeader(); // de HTML header tonen
    displayNavigation(); // de menubalk tonen

    dispatch([$jobs, $locations, $employees]);

    displayFooter(); // de HTML footer tonen
    databaseDisconnect(); // verbinding met de database verbreken
?>
