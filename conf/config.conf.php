<?php

    /**
     * Dit bestand bevat alle configuratie gerelateerde gegevens van het syteem
     */


    /**
     * De configuratie van de MySQL verbinding. Voor het aanmaken van een nieuwe gebruiker toets je
     * als root gebruiker in PHPMyAdmin de volgende twee regels in:
     *
     * grant all privileges on hanzecontact.* to hanzecontact@localhost identified by 'c0nt3ct';
     * flush privileges;
     */
    $config['mysql']['hostname'] = "localhost";
    $config['mysql']['username'] = "root";
    $config['mysql']['password'] = "";
    $config['mysql']['database'] = "hanzecontact";

    /**
     * Hieronder volgt de vorige configuratie
     */

    $config['pagetitle'] = "Hanze Contact"; // titel van het systeem
    $config['defaultaction'] = "home"; // De standaard actie als er geen is opgegeven

?>
