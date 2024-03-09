<?php

class PagamentController extends Controller {
    
    public function show() {
        
        if (!isset($_SESSION["logued_user"])) {
            throw new Exception("Not logged in");
        }
        
        require_once 'lang/lang_cookies.php';
        
        $errors = [];
        
        $mPagament = new PagamentModel();
        $pagamentObjects = $mPagament->read();
        
        $pagament = new Pagament();
        
        if (isset($_POST["submit"])) {
            $pagament->id = $this->sanitize($_POST['id']);
            $pagament->banc = $this->sanitize($_POST['banc']);
            $pagament->ref_externa = $this->sanitize($_POST['ref_externa']);
            $pagament->data = $this->sanitize($_POST['data']);
            $pagament->estat = $this->sanitize($_POST['estat']);
            
            $errors = self::validateFields();
            
            if (empty($errors)) {
                $mPagament->create($pagament);
                header("Location: ?pagament/show");
                exit();
            }
        }
        
        PagamentView::show($pagament, $pagamentObjects, "?pagament/show", $lang, $errors);
    }
    
    public static function delete($id) {
        
        $mPagament = new PagamentModel();
        
        $pagament = new Pagament();
        $pagament->id = $id[0];
        
        $mPagament->delete($pagament);
        
        $controller = new PagamentController;
        $controller->show();
    }
    
    public function update() {
        
        $errors = [];
        
        if (isset($_POST["submit"])) {
            $errors = $this->validateFields();
            
            if (empty($errors)) {
                $pagamentId = $this->sanitize($_POST['id']);
                $banc = $this->sanitize($_POST['banc']);
                $refExterna = $this->sanitize($_POST['ref_externa']);
                $data = $this->sanitize($_POST['data']);
                $estat = $this->sanitize($_POST['estat']);
                
                $pagament = new Pagament();
                $pagament->id = $pagamentId;
                $pagament->banc = $banc;
                $pagament->ref_externa = $refExterna;
                $pagament->data = $data;
                $pagament->estat = $estat;
                
                $mPagament = new PagamentModel();
                
                $mPagament->update($pagament);
                
                header("Location: ?pagament/show");
                exit();
            }
        }
        
        PagamentView::show($pagament, $pagamentObjects, "?pagament/update", $lang);
    }
    
    public function showUpdate($id) {
        require_once 'lang/lang_cookies.php';
        
        $mPagament = new PagamentModel();
        $pagamentObjects = $mPagament->read();
        
        $pagamentObj = new Pagament();
        $pagamentObj->__set('id', $id[0]);
        $pagament = $mPagament->getById($pagamentObj);
        
        PagamentView::show($pagament, $pagamentObjects, "?pagament/update", $lang);
    }
    
    public static function validateFields() {
        $errors = [];
        
        $pagamentId = $_POST['id'];
        
        if (empty($pagamentId)) {
            $errors['id'] = 'El campo ID es obligatorio.';
        }
        
        $banc = $_POST['banc'];
        
        if (empty($banc)) {
            $errors['banc'] = 'El campo Banc es obligatorio.';
        }
        
        $refExterna = $_POST['ref_externa'];
        
        if (empty($refExterna)) {
            $errors['ref_externa'] = 'El campo Ref. Externa es obligatorio.';
        }
        
        $data = $_POST['data'];
        
        if (empty($data)) {
            $errors['data'] = 'El campo Data es obligatorio.';
        }
        
        $estat = $_POST['estat'];
        
        if (empty($estat)) {
            $errors['estat'] = 'El campo Estat es obligatorio.';
        }
        
        return $errors;
    }
}
