<?php

class LangController extends Controller {
 
    public function set($params="cat") {
        
        $idiomaModel = new IdiomaModel();
        $arrayIdiomes = $idiomaModel->read(true);
        
        $arrayISO = [];
        
        foreach($arrayIdiomes as $idioma) {
            $arrayISO[] = $idioma->iso;
        }
        
        if (in_array($params[0], $arrayISO)) {                
            setcookie("lang",$params[0],time()+3600);
            $lang = $params[0];
        } else {
            $lang = 'cat';
        }
        
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        HomeView::show($fitxerDeTraduccions);
    }
}
