<?php

class LocalitzacioController extends Controller {
    
    public function show() {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mLocalitzacio = new LocalitzacioModel();
        $localitzacioObjects = $mLocalitzacio->read();
        
        $localitzacio = new Localitzacio();
        
        if (isset($_POST["submit"])) {
            $localitzacio->id = $this->sanitize($_POST['id']);
            $localitzacio->lloc = $this->sanitize($_POST['lloc']);
            $localitzacio->adreca = $this->sanitize($_POST['adreca']);
            $localitzacio->localitat = $this->sanitize($_POST['localitat']);
            
            $errors = self::validateFields();
            
            if (empty($errors)) {
                $mLocalitzacio->create($localitzacio);
                header("Location: ?localitzacio/show");
                exit();
            }
        }
        
        LocalitzacioView::show($localitzacio, $localitzacioObjects, $type="?localitzacio/show", $lang, $errors);
    }
    
    public static function delete($id) {
        
        $mLocalitzacio = new LocalitzacioModel();
        
        $localitzacio = new Localitzacio();
        $localitzacio->id = $id[0];
        
        $mLocalitzacio->delete($localitzacio);
        
        $controller = new LocalitzacioController;
        $controller->show();
        
    }
    
    public function update() {
        
        $localitzacio = new Localitzacio();
        
        if (isset($_POST["submit"])) {
            $localitzacio->id = $this->sanitize($_POST['id']);
            $localitzacio->lloc = $this->sanitize($_POST['lloc']);
            $localitzacio->adreca = $this->sanitize($_POST['adreca']);
            $localitzacio->localitat = $this->sanitize($_POST['localitat']);
            
            $errors = $this->validateFields();
            
            if (empty($errors)) {
                $mLocalitzacio = new LocalitzacioModel();
                $mLocalitzacio->update($localitzacio);
                header("Location: ?localitzacio/show");
                exit();
            }
        }
        
        require_once 'lang/lang_cookies.php';
        
        $mLocalitzacio = new LocalitzacioModel();
        $localitzacioObjects = $mLocalitzacio->read();
        
        $this->showUpdateView($localitzacio, $localitzacioObjects);
    }
    
    public function showUpdate($id) {
        require_once 'lang/lang_cookies.php';
        
        $mLocalitzacio = new LocalitzacioModel();
        $localitzacioObjects = $mLocalitzacio->read();
        
        $localitzacioObj = new Localitzacio();
        $localitzacioObj->__set('id', $id[0]);
        $localitzacio = $mLocalitzacio->getById($localitzacioObj);
        
        LocalitzacioView::show($localitzacio, $localitzacioObjects, $type="?localitzacio/update", $lang);
    }
    
    public static function validateFields() {
        $errors = [];
        
        $localitzacioId = $_POST['id'];
        
        if (empty($localitzacioId)) {
            $errors['id'] = 'El campo ID es obligatorio.';
        }
        
        $lloc = $_POST['lloc'];
        
        if (empty($lloc)) {
            $errors['lloc'] = 'El campo Lloc es obligatorio.';
        }
        
        $adreca = $_POST['adreca'];
        
        if (empty($adreca)) {
            $errors['adreca'] = 'El campo Adreca es obligatorio.';
        }
        
        $localitat = $_POST['localitat'];
        
        if (empty($localitat)) {
            $errors['localitat'] = 'El campo Localitat es obligatorio.';
        }
        
        return $errors;
    }
}
