<?php

class IdiomaMantenimentController extends Controller
{

    public function show()
    {
        
        if (!isset($_SESSION["logued_user"])) {
           throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';

        $fitxerDeTraduccions = "lang/{$lang}.php";

        $idiomaModel = new IdiomaModel();
        $idiomas = $idiomaModel->read();

        $idiomaView = new IdiomaMantenimentView();
        $idiomaView->show($idiomas);
    }

    public function create()
    {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';

        $fitxerDeTraduccions = "lang/{$lang}.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $iso = $this->sanitize($_POST['iso']);

            $imatge = $this->sanitize($_POST['imatge']);

            $actiu = isset($_POST['actiu']) ? 1 : 0;

            if (empty($iso) || strlen($iso) > 3) {
                $errors = 'La iso no es valida';
            }

            $idiomaModel = new IdiomaModel();
            $idiomas = $idiomaModel->read();

            $idiomasSanitizados = [];

            foreach ($idiomas as $idioma) {

                if (isset($_POST['translation_' . $idioma->iso])) {

                    $traduccio = new Traduccio();
                    $traduccio->variable = $idioma->iso;
                    $traduccio->valor = $this->sanitize($_POST['translation_' . $idioma->iso]);

                    $idiomasSanitizados[$idioma->iso] = $traduccio;
                }
            }

            if (empty($errors)) {

                $newIdioma = new Idioma();
                $newIdioma->iso = $iso;
                $newIdioma->imatge = $imatge;
                $newIdioma->actiu = $actiu;
                $newIdioma->traduccions = $idiomasSanitizados;

                $idiomaModel = new IdiomaModel();
                $idiomaModel->create($newIdioma);

                $idiomaInDB = $idiomaModel->getByIso($newIdioma);

                $traduccioModel = new TraduccioModel();

                foreach ($newIdioma->traduccions as $traduccio) {
                    $traduccio->idioma_id = $idiomaInDB->id;
                    $traduccioModel->create($traduccio);
                }

                header("Location: index.php");
                exit();
            } else {

                $idiomaModel = new IdiomaModel();
                $idiomas = $idiomaModel->read();

                $idiomaView = new IdiomaView();
                $idiomaView->showEmptyForm($idiomas);
            }
        } else {
            $idiomaModel = new IdiomaModel();
            $idiomas = $idiomaModel->read();

            $idiomaView = new IdiomaView();
            $idiomaView->showEmptyForm($idiomas);
        }
    }

    public function update($id)
    {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $iso = $this->sanitize($_POST['iso']);
            $imatge = $this->sanitize($_POST['imatge']);
            $actiu = isset($_POST['actiu']) ? 1 : 0;
            
            if (empty($iso) || strlen($iso) > 3) {
                $errors = 'La iso no es valida';
            }
            
            $idiomaModel = new IdiomaModel();
            $idioma = new Idioma();
            $idioma->id = $id[0];
            
            $idiomaResult = $idiomaModel->getById($idioma);
            $idiomasResult = $idiomaModel->read();
            
            $traducSanitizados = [];
            
            foreach ($idiomasResult as $idiomaDB) {
                
                if (isset($_POST['translation_' . $idiomaDB->iso])) {
                    $traduccio = new Traduccio();
                    $traduccio->idioma_id = $idiomaDB->id;
                    $traduccio->variable = $idiomaResult->iso;
                    $traduccio->valor = $this->sanitize($_POST['translation_' . $idiomaDB->iso]);
                    $traducSanitizados[] = $traduccio;
                }
            }
            
            if (empty($errors)) {
                $idiomaResult->iso = $iso;
                $idiomaResult->imatge = $imatge;
                $idiomaResult->actiu = $actiu;
                $idiomaResult->traduccions = $traducSanitizados;
                
                $idiomaModel->update($idiomaResult);
                
                $traduccioModel = new TraduccioModel();
                
                foreach ($traducSanitizados as $traduccio) {
                    if ($existingTraduccio = $traduccioModel->getByLanguageVariable($traduccio->variable)) {
                        $traduccioModel->update($traduccio);
                    } else {
                        $traduccioModel->create($traduccio);
                    }
                }
                
                $idiomas = $idiomaModel->read();
                
                $idiomaView = new IdiomaView();
                $idiomaView->show($idiomaResult, $idiomas);
                
            } else {
                $idiomas = $idiomaModel->read();
                
                $idiomaView = new IdiomaView();
                $idiomaView->show($idiomaResult, $idiomas);
            }
            
        } else {
            $idiomaModel = new IdiomaModel();
            
            $idioma = new Idioma();
            $idioma->id = $id[0];
            
            $idiomaResult = $idiomaModel->getById($idioma);
            
            $idiomas = $idiomaModel->read();
            
            $idiomaView = new IdiomaView();
            $idiomaView->show($idiomaResult, $idiomas);
        }
    }
    
    public function delete($id)
    {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        $idiomaModel = new IdiomaModel();
        $traduccioModel = new TraduccioModel();

        $idioma = new Idioma();
        $idioma->id = $id[0];

        $idiomaResult = $idiomaModel->getById($idioma);
        
        $traduc = new Traduccio();
        $traduc->idioma_id = $idioma->id;

        $traduccioModel->delete($traduc);
       
        $idiomaModel->delete($idiomaResult);

        header("Location: index.php");
        exit();
    }
}


