<?php

class ContactController extends Controller {
    private $contacte;
    
    public function __construct(Contact $param=null){
        parent::__construct();
        $this->contacte = (is_null($param)) ? new Contact("", "", "", "", "") : $param;
    }
 
    public function form() {
        include_once "lang/lang_cookies.php";
        ContactView::show($this->contacte, $lang);    
    }
    
    public function validate() {
//         if (isset($_COOKIE["lang"])) {
//             $lang = $_COOKIE["lang"];
//         } else {
           $lang = "es";
//        }
        
        if ((isset($_POST["submit"]))) {
            $frmNom = $this->sanitize($_POST["nombre"]);
            $frmCognom = $this->sanitize($_POST["apellido"]);
            $frmMail = $this->sanitize($_POST["email"]);
            $frmMsg = $this->sanitize($_POST["mensaje"]);
            $frmData = null;
            
            if (strlen($frmNom)==0) {
                $errors["nombre"] = "Has d'informar un nom";
            } 
            if (strlen($frmCognom)==0) {
                $errors["apellido"] = "Has d'informar un cognom";
            } 
            if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "L'adreça de correu no és vàlida";
            }
            if (strlen($frmMsg)==0) {
                $errors["mensaje"] = "Has d'escriure el comentari que vols enviar";
            }
            $this->contacte = new Contact($frmNom, $frmCognom, $frmMail, $frmMsg, $frmData);
            
            if (!isset($errors)) {
                $sData = getdate();
                $this->contacte->data = $sData['mday']."/".$sData['mon']."/".$sData['year'];
                
                $mContacte = new ContactModel();
                $mContacte->create($this->contacte);
                
                $this->contacte = new Contact("", "", "", "", "");
                $missatgeOK="El comentari s'ha enviat correctament";               
            }
        }
        
        ContactView::show($this->contacte, $lang, $errors, $missatgeOK);  
    }
    
    public function remove($params) {
        if (is_array($params) && count($params)==1) {
            $id = $params[0];
        } else {
            throw new Exception("No es pot eliminar registre sense la seva referència");
        }
        
        
        $mContacte = new ContactModel();
        $mContacte->delete($id);
        
        $this->maintenance();
    }
}

