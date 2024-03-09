<?php

class ZonaController extends Controller {
    
    public function show() {
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mZona = new ZonaModel();
        $zonaObjects = $mZona->read();
        
        $zona = new Zona();
        
        if (isset($_POST["submit"])) {
            $zona->id = $this->sanitize($_POST['id']);
            $zona->descripcio = $this->sanitize($_POST['descripcio']);
            
            $errors = self::validateFields();
            
            if (empty($errors)) {
                $mZona->create($zona);
                header("Location: ?zona/show");
                exit();
            }
        }
        
        ZonaView::show($zona, $zonaObjects, "?zona/show", $lang, $errors);
    }
    
    public static function delete($id) {
        
        $mZona = new ZonaModel();
        
        $zona = new Zona();
        $zona->id = $id[0];
        
        $mZona->delete($zona);
        
        $controller = new ZonaController;
        $controller->show();
    }
    
    public function update() {
        
        if (isset($_POST["submit"])) {
            $errors = $this->validateFields();
            
            if (empty($errors)) {
                $zonaId = $this->sanitize($_POST['id']);
                $descripcio = $this->sanitize($_POST['descripcio']);
                
                $zona = new Zona();
                $zona->id = $zonaId;
                $zona->descripcio = $descripcio;
                
                $mZona = new ZonaModel();
                
                $mZona->update($zona);
                
                header("Location: ?zona/show");
                exit();
            }
        }
        
        ZonaView::show($zona, $zonaObjects, "?zona/update", $lang);
    }
    
    public function showUpdate($id) {
        require_once 'lang/lang_cookies.php';
        
        $mZona = new ZonaModel();
        $zonaObjects = $mZona->read();
        
        $zonaObj = new Zona();
        $zonaObj->__set('id', $id[0]);
        $zona = $mZona->getById($zonaObj);
        
        ZonaView::show($zona, $zonaObjects, "?zona/update", $lang);
    }
    
    public static function validateFields() {
        $errors = [];
        
        $zonaId = $_POST['id'];
        
        if (empty($zonaId)) {
            $errors['id'] = 'El campo ID es obligatorio.';
        }
        
        $descripcio = $_POST['descripcio'];
        
        if (empty($descripcio)) {
            $errors['descripcio'] = 'El campo Descripció es obligatorio.';
        }
        
        return $errors;
    }
}
