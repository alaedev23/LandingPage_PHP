<?php

class EntradaController extends Controller {
    
    public function show() {
        
        if (! isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mEntrada = new EntradaModel();
        $entradas = $mEntrada->read();
        
        $ids = self::getAllIds();
        
        $entrada = new Entrada();
        
        if (isset($_POST["submit"])) {
            
            $errors = self::validateCamps($ids);
            
            $entrada->esdeveniment_id = $this->sanitize($_POST['esdeveniment_id']);
            $entrada->data_id = $this->sanitize($_POST['data_id']);
            $entrada->loc_id = $this->sanitize($_POST['loc_id']);
            $entrada->zona_id = $this->sanitize($_POST['zona_id']);
            $entrada->pagament_id = $this->sanitize($_POST['pagament_id']);
            $entrada->id = $this->sanitize($_POST['id']);
            $entrada->fila = $this->sanitize($_POST['fila']);
            $entrada->butaca = $this->sanitize($_POST['butaca']);
            $entrada->dni = $this->sanitize($_POST['dni']);
            
            if (empty($errors)) {
                $mEntrada->create($entrada);
                header("Location: ?entrada/show");
                exit();
            }
        }
        
        EntradaView::show($entrada, $entradas, $ids, $type="?entrada/show", $lang, $errors);
    }
    
    
    public static function delete($id) {
        
        $mEntrada = new EntradaModel();

        $entrada = new Entrada();
        $entrada->id = $id[0];
        
        $mEntrada->delete($entrada);
        
        $controller = new EntradaController;
        $controller->show();
        
    }
    
    public function update() {
        
        require_once 'lang/lang_cookies.php';
        $errors = [];
        
        if (isset($_POST["submit"])) {
            $ids = $this->getAllIds();
            $errors = $this->validateCamps($ids);
            
            if (empty($errors)) {
                
                $esdevenimentId = $this->sanitize($_POST['esdeveniment_id']);
                $dataId = $this->sanitize($_POST['data_id']);
                $locId = $this->sanitize($_POST['loc_id']);
                $zonaId = $this->sanitize($_POST['zona_id']);
                $pagamentId = $this->sanitize($_POST['pagament_id']);
                $id = $this->sanitize($_POST['id']);
                $fila = $this->sanitize($_POST['fila']);
                $butaca = $this->sanitize($_POST['butaca']);
                $dni = $this->sanitize($_POST['dni']);
                
                $entrada = new Entrada();
                $entrada->esdeveniment_id = $esdevenimentId;
                $entrada->data_id = $dataId;
                $entrada->loc_id = $locId;
                $entrada->zona_id = $zonaId;
                $entrada->pagament_id = $pagamentId;
                $entrada->id = $id;
                $entrada->fila = $fila;
                $entrada->butaca = $butaca;
                $entrada->dni = $dni;
                
                $mEntrada = new EntradaModel();
                $mEntrada->update($entrada);
                
                header("Location: ?entrada/show");
                exit();
            }
        }
        
        $entradas = (new EntradaModel())->read();
        
        $entradaObj = new Entrada();
        $entradaObj->__set('id', $_GET['id']);
        $entrada = (new EntradaModel())->getById($entradaObj);
        
        EntradaView::show($entrada, $entradas, $ids, $type="?entrada/update", $lang, $errors);
    }
    
    
    public static function validarDNI($dni)
    {
        $dni = str_replace(' ', '', $dni);
        $patron = '/^\d{8}[a-zA-Z]$/';
        
        return preg_match($patron, $dni) === 1;
    }
    
    public static function getAllIds()
    {
        $mEsdev = new EsdevenimentModel();
        $ids['esdeveniment_id'] = self::getIds($mEsdev->read());
        
        $mData = new DataModel();
        $ids['data_id'] = self::getIds($mData->read());
        
        $mLoc = new LocalitzacioModel();
        $ids['loc_id'] = self::getIds($mLoc->read());
        
        $mZona = new ZonaModel();
        $ids['zona_id'] = self::getIds($mZona->read());
        
        $mPagament = new PagamentModel();
        $ids['pagament_id'] = self::getIds($mPagament->read());
        
        return $ids;
    }
    
    public static function getIds($objects)
    {
        $ids = [];
        
        foreach ($objects as $object) {
            $id = isset($object->id) ? $object->id : $object->__get('id');
            
            if ($id !== null) {
                $ids[] = $id;
            }
        }
        
        return array_reverse($ids);
    }
    
    public function showUpdate($id)
    {
        require_once 'lang/lang_cookies.php';
        
        $mEntrada = new EntradaModel();
        $entradas = $mEntrada->read();
        
        $ids = self::getAllIds();
        
        $entradaObj = new Entrada();
        $entradaObj->__set('id', $id[0]);
        $entrada = $mEntrada->getById($entradaObj);
        
        EntradaView::show($entrada, $entradas, $ids, $type="?entrada/update", $lang);
    }
    
    public static function validateCamps($ids)
    {
        $errors = [];
        
        $esdevenimentId = $_POST['esdeveniment_id'];
        
        if (empty($esdevenimentId)) {
            $errors['esdeveniment_id'] = 'El campo Esdeveniment ID es obligatorio.';
        } elseif (!in_array($esdevenimentId, $ids['esdeveniment_id'])) {
            $errors['esdeveniment_id'] = 'Esdeveniment ID no es válido.';
        }
        
        $dataId = $_POST['data_id'];
        
        if (empty($dataId)) {
            $errors['data_id'] = 'El campo Data ID es obligatorio.';
        } elseif (!in_array($dataId, $ids['data_id'])) {
            $errors['data_id'] = 'Data ID no es válido.';
        }
        
        $locId = $_POST['loc_id'];
        
        if (empty($locId)) {
            $errors['$loc_id'] = 'El campo Localitzacio ID es obligatorio.';
        } elseif (!in_array($locId, $ids['loc_id'])) {
            $errors['loc_id'] = 'Localitzacio ID no es válido.';
        }
        
        $zonaId = $_POST['zona_id'];
        
        if (empty($zonaId)) {
            $errors['zona_id'] = 'El campo Zona ID es obligatorio.';
        } elseif (!in_array($zonaId, $ids['zona_id'])) {
            $errors['zona_id'] = 'Zona ID no es válido.';
        }
        
        $pagamentId = $_POST['pagament_id'];
        
        if (empty($pagamentId)) {
            $errors['pagament_id'] = 'El campo Pagament ID es obligatorio.';
        } elseif (!in_array($pagamentId, $ids['pagament_id'])) {
            $errors['pagament_id'] = 'Pagament ID no es válido.';
        }
        
        $id = $_POST['id'];
        
        if (empty($id)) {
            $errors['id'] = 'El campo ID es obligatorio.';
        }
        
        $fila = $_POST['fila'];
        
        if (empty($fila)) {
            $errors['fila'] = 'La Fila es obligatoria.';
        } elseif (!is_numeric($fila)) {
            $errors['fila'] = 'La Fila no es valida.';
        }
        
        $butaca = $_POST['butaca'];
        
        if (empty($butaca)) {
            $errors['butaca'] = 'El Butaca es obligatoria.';
        } elseif (!is_numeric($butaca)) {
            $errors['butaca'] = 'La Butaca no es valida.';
        }
        
        $dni = $_POST['dni'];
        
        if (empty($dni)) {
            $errors['dni'] = 'El DNI es obligatorio.';
        } elseif (!self::validarDNI($dni)) {
            $errors['dni'] = 'El DNI no es válido.';
        }
        
        return $errors;
    }
}
