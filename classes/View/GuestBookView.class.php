<?php

class GuestBookView extends View {

    public function __construct() {
        parent::__construct();
    }    
    
    public function show( $comentari, $items, $lang, $errorsDetectats=null) {
        $fitxerDeTraduccions = "lang/".$lang.".php";
        require_once $fitxerDeTraduccions;
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
	    include "templates/header.php";
		include "templates/guestbook_body.php";
		echo "</body></html>";
    }
    
    
}

