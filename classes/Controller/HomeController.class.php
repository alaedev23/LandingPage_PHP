<?php

class HomeController {
    
    public function show() {
        
        require_once 'lang/lang_cookies.php';
        
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        HomeView::show($fitxerDeTraduccions); 
        
    }
}

