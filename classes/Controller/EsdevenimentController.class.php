<?php

class EsdevenimentController extends Controller {
    
    public function show() {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mEsdeveniment = new EsdevenimentModel();
        $esdeveniments = $mEsdeveniment->read();
        
        $esdeveniment = new Esdeveniment();
        
        if (isset($_POST["submit"])) {
            $errors = self::validateCamps();
            
            $esdeveniment->id = $this->sanitize($_POST['id']);
            $esdeveniment->titol = $this->sanitize($_POST['titol']);
            $esdeveniment->subtitol = $this->sanitize($_POST['subtitol']);
            $esdeveniment->dates = $this->sanitize($_POST['dates']);
            $esdeveniment->imatge = $this->sanitize($_POST['imatge']);
            
            if (empty($errors)) {
                $mEsdeveniment->create($esdeveniment);
                header("Location: ?esdeveniment/show");
                exit();
            }
        }
        
        EsdevenimentView::show($esdeveniment, $esdeveniments, $type="?esdeveniment/show", $lang, $errors);
    }
    
    
    public static function delete($id) {
        
        $mEsdeveniment = new EsdevenimentModel();
        
        $esdeveniment = new Esdeveniment();
        $esdeveniment->id = $id[0];
        
        $mEsdeveniment->delete($esdeveniment);
        
        $controller = new EsdevenimentController;
        $controller->show();
        
    }
    
    public function update($id) {
        
        $mEsdeveniment = new EsdevenimentModel();
        $esd = new Esdeveniment();
        $esd->id = $id;
        $esdeveniment = $mEsdeveniment->getById($esd);
        
        if (isset($_POST["submit"])) {
            $errors = $this->validateCamps();
            
            if (empty($errors)) {
                $esdeveniment->titol = $this->sanitize($_POST['titol']);
                $esdeveniment->subtitol = $this->sanitize($_POST['subtitol']);
                $esdeveniment->dates = $this->sanitize($_POST['dates']);
                
                $frmImatge = $_FILES;
                if (!empty($frmImatge['imatge']['tmp_name'])) {
                    $fileExt = $this->validateImageFile($frmImatge, $errors);
                    
                    if (empty($errors['imatge'])) {
                        $targetDirectory = "uploads/";
                        $targetFile = $targetDirectory . $id . "." . $fileExt;
                        
                        if (move_uploaded_file($_FILES["imatge"]["tmp_name"], $targetFile)) {
                            $esdeveniment->imatge = $targetFile;
                        } else {
                            $errors['imatge'] = "Error al subir la imagen. Inténtalo de nuevo.";
                        }
                    }
                }
                
                $mEsdeveniment->update($esdeveniment);
                
                header("Location: ?esdeveniment/show");
                exit();
            }
        }
        
        require_once 'lang/lang_cookies.php';
        EsdevenimentView::show($esdeveniment, [], $type="?esdeveniment/update", $lang);
    }
    
    
    public function validateImageFile($file, &$errors = null)
    {
        if (! isset($file['imatge']['tmp_name']) || ! is_uploaded_file($file['imatge']['tmp_name'])) {
            $errors['imatge'] = "No se ha seleccionado ningún archivo.";
            return;
        }
        
        $fileName = $file['imatge']['name'];
        $fileSize = $file['imatge']['size'];
        $fileType = $file['imatge']['type'];
        
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        
        $allowedExtensions = [
            'png'
        ];
        $maxFileSize = 2 * 1024 * 1024;
        $allowedMimeTypes = [
            'image/png'
        ];
        
        if (! in_array(strtolower($fileExt), $allowedExtensions)) {
            $errors['imatge'] = "El archivo debe ser una imagen con las extensiones permitidas: " . implode(', ', $allowedExtensions);
        } elseif ($fileSize > $maxFileSize) {
            $errors['imatge'] = "El tamaño del archivo excede el límite permitido (2MB).";
        } elseif (! in_array(strtolower($fileType), $allowedMimeTypes)) {
            $errors['imatge'] = "El tipo de archivo no es una imagen válido.";
        }
        
        return $fileExt;
    }
    
    public function showUpdate($id)
    {
        require_once 'lang/lang_cookies.php';
        
        $mEsdeveniment = new EsdevenimentModel();
        $esdeveniments = $mEsdeveniment->read();
        
        $esdevenimentObj = new Esdeveniment();
        $esdevenimentObj->__set('id', $id[0]);
        $esdeveniment = $mEsdeveniment->getById($esdevenimentObj);
        
        print_r($esdeveniment);
        
        EsdevenimentView::show($esdeveniment, $esdeveniments, $type="?esdeveniment/update", $lang);
    }
    
    public static function validateCamps() {
        $errors = [];
        
        $titol = $_POST['titol'];
        $subtitol = $_POST['subtitol'];
        $dates = $_POST['dates'];
        
        if (empty($titol)) {
            $errors['titol'] = 'El campo Títol es obligatorio.';
        } elseif (strlen($titol) > 255) {
            $errors['titol'] = 'El campo Títol no puede tener más de 255 caracteres.';
        }
        
        if (strlen($subtitol) > 255) {
            $errors['subtitol'] = 'El campo Subtítol no puede tener más de 255 caracteres.';
        }

        if (empty($dates)) {
            $errors['dates'] = 'El campo Dates es obligatorio.';
        }

        return $errors;
    }
    
}


