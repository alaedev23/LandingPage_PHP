<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_set_cookie_params(0);
session_start();

// Evitar cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include 'classes/Config/Autoloader.php';
spl_autoload_register("Autoloader::load");
spl_autoload_register("Autoloader::otherload");

try {
    $cfront = new FrontController();
    $cfront->dispatch();

//     $idiomaModel = new IdiomaModel();
//     $idiomas = $idiomaModel->read();
    
//     var_dump($idiomas);
    
//     $idiomaView = new IdiomaMantenimentView();
//     $idiomaView->show($idiomas);

//     $idiomaModel = new IdiomaModel();
    
//     $idiom = new Idioma();
//     $idiom->iso = 'es';
    
//     $idioma = $idiomaModel->getByIso($idiom);
    
//     $idiomaView = new IdiomaView();
//     $idiomaView->show($idioma, $idiomas);
    
    
} catch (Exception $e) {
    $vError = new ErrorView();
    $vError->show($e);
}
