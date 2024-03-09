<?php

class ContactView extends View {

    public function __construct() {
        parent::__construct();
    }
    
    public static function show($contacte, $lang="es",$errors=null, $missatgeOK='') {
        require_once "lang/".$lang.".php";
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
	    include "templates/header.php";
		include "templates/contact_body.php";
		echo "</body></html>";
    }
    
}

