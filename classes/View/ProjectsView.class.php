<?php

class ProjectsView extends View {

    public static function show($fitxerDeTraduccions ) {
        require_once $fitxerDeTraduccions;        
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
	    include "templates/header.php";
	    include "templates/projects_body.php";
		echo "</body></html>";
    }
}

