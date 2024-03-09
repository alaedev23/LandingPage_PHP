<?php

class HomeView {

    public static function show($fitxerDeTraduccions ) {
        require_once $fitxerDeTraduccions;        
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
	    include "templates/header.php";
		include "templates/body.php";
		echo "</body></html>";
    }
}

