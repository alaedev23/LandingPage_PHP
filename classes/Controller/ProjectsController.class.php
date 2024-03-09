<?php

class ProjectsController extends Controller {

    public function __construct() {
        
    }
    
    public function show() {
        
        require_once 'lang/lang_cookies.php';
        
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        ProjectsView::show($fitxerDeTraduccions);      
        
    }
}

