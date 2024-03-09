<?php

class InversisView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public static function show($fitxerDeTraduccions, $taula) {
        include_once $fitxerDeTraduccions;
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/body_inversis.php";
        echo "</body></html>";
    }
}

