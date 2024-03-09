<?php
class ComentariModel implements CRUDable {
    
    const FILE = "docs/LlibreDeVisites.xml";
    private $xml;
    
    public function __construct() {
        if (!file_exists(self::FILE)) {
            $this->xml = new SimpleXMLElement('<REGISTRES></REGISTRES>');
        } else {
            $this->xml = simplexml_load_file(self::FILE);
        }
    }
    
    public function create($comentari) {
        $registre = $this->xml->addChild('REGISTRE');
        $registre->addChild('DATA', $comentari->getData());
        $registre->addChild('NOM', $comentari->getNombre());
        $registre->addChild('MAIL', $comentari->getEmail());
        $registre->addChild('EXPERIENCIA', $comentari->getValoracion());
        $registre->addChild('COMENTARI', $comentari->getMensaje());
        
        if ($this->xml->asXML(self::FILE) === false) {
            throw new Exception('Error al escribir en el archivo XML.');
        }
        
        return true;
    }
    
    public function read($comentari = null) {
        $comentaris = array();
        
        foreach ($this->xml->children() as $child) {
            $data = $child->DATA->__toString();
            $nom = $child->NOM->__toString();
            $mail = $child->MAIL->__toString();
            $experiencia = $child->EXPERIENCIA->__toString();
            $coment = $child->COMENTARI->__toString();
            $comentaris[] = new Comentari($nom, $mail, $experiencia, $coment, $data);
        }
        
        return $comentaris;
    }
    
    public function update($comentari) {}
    
    public function delete($clauAEsborrar) {}
}
?>