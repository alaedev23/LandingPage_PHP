<?php

class DataController extends Controller {
    
    public function show() {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mData = new DataModel();
        $dataObjects = $mData->read();
        
        $data = new Data();
        
        if (isset($_POST["submit"])) {
            
            $data->id = $this->sanitize($_POST['id']);
            $data->data = $this->sanitize($_POST['data']);
            $data->hora = $this->sanitize($_POST['hora']);
            
            $errors = self::validateFields();
            
            if (empty($errors)) {
                $mData->create($data);
                header("Location: ?data/show");
                exit();
            }
        }
        
        DataView::show($data, $dataObjects, "?data/show", $lang, $errors);
    }
    
    public static function delete($id) {
        
        $mData = new DataModel();
        
        $data = new Data();
        $data->id = $id[0];
        
        $mData->delete($data);
        
        $controller = new DataController;
        $controller->show();
    }
    
    public function update() {
        
        if (isset($_POST["submit"])) {
            $errors = $this->validateFields();
            
            if (empty($errors)) {
                $dataId = $this->sanitize($_POST['id']);
                $dataDate = $this->sanitize($_POST['data']);
                $dataHora = $this->sanitize($_POST['hora']);
                
                $data = new Data();
                $data->id = $dataId;
                $data->data = $dataDate;
                $data->hora = $dataHora;
                
                $mData = new DataModel();
                
                $mData->update($data);
                
                header("Location: ?data/show");
                exit();
            }
        }
        
        // Si hay errores, aún debemos mostrar la vista de actualización.
        $this->showUpdate($_POST['id']);
    }
    
    public function showUpdate($id) {
        require_once 'lang/lang_cookies.php';
        
        $mData = new DataModel();
        $dataObjects = $mData->read();
        
        $dataObj = new Data();
        $dataObj->__set('id', $id);
        $data = $mData->getById($dataObj);
        
        DataView::show($data, $dataObjects, "?data/update", $lang);
    }
    
    public static function validateFields() {
        $errors = [];
        
        $dataId = $_POST['id'];
        
        if (empty($dataId)) {
            $errors['id'] = 'El campo ID es obligatorio.';
        }
        
        $dataDate = $_POST['data'];
        
        if (empty($dataDate)) {
            $errors['data'] = 'El campo Data es obligatorio.';
        }
        
        $dataHora = $_POST['hora'];
        
        if (empty($dataHora)) {
            $errors['hora'] = 'El campo Hora es obligatorio.';
        }
        
        return $errors;
    }
}
