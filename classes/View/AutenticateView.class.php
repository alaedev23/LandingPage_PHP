<?php

class AutenticateView extends View {
    
    public static function show($fitxerDeTraduccions, $email) {
        require_once $fitxerDeTraduccions;
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/body_autenticate.php";
        echo "</body>";
    }
    
}

