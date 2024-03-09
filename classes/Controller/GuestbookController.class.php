<?php

class GuestBookController extends Controller {
    private $comentari;
    
    public function __construct(Comentari $param=null){
        parent::__construct();
        $this->comentari = (is_null($param)) ? new Comentari("", "", "", "") : $param;
    }
    
    public function form() { 
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "es";
        }
        
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            $frmNom = $this->sanitize($_POST["nombre"]);
            $frmMsg = $this->sanitize($_POST["mensaje"]);
            $frmMail = $this->sanitize($_POST["email"]);
            $frmVal = $this->sanitize($_POST["valoracion"]);
            
            if (strlen($frmNom)==0) {
                $errors["nombre"] = "Has de escribir un nombre";
            }
            if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "El email no es correcto";
            }
            if (strlen($frmMsg)==0) {
                $errors["mensaje"] = "Has d'escriure el comentari que vols enviar";
            }
            if (!in_array($frmVal, array("MM","M","N","B", "MB"))) {
                $errors["valoracion"] = "Hay que poner puntuacion";
            }
            
            $this->comentari->setNombre($frmNom);
            $this->comentari->setEmail($frmMail);
            $this->comentari->setMensaje($frmMsg);
            $this->comentari->setValoracion($frmVal);
            
            if (empty($errors)) {
                $sData = getdate();
                $this->comentari->setData($sData['year']."-".$sData['mon']."-".$sData['mday']);
                
                $mComentari = new ComentariModel();
                $mComentari->create($this->comentari);
                
                $this->comentari = new Comentari("", "", "", "");
            }
        }
        
        $mComentari = new ComentariModel();
        $comentaris = $mComentari->read();
        
        if ($comentaris != null) {
            $items = array_reverse($comentaris);
        }
        
        $itemsHTML = "";
        
        foreach ($items as $item) {
            $itemsHTML .= "<tr>";
            foreach ($item as $value) {
                echo $items;
                $itemsHTML .= "<td>" . $value . "</td>";
            }
            $itemsHTML .= "</tr>";
        }
        
        $vGuestBook = new GuestBookView();
        $vGuestBook->show($this->comentari, $itemsHTML, $lang, $errors);
    }
}
