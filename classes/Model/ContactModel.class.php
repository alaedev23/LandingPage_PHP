<?php

class ContactModel implements CRUDable {
    
    const FILE = "docs/missatgesDeContacte.xml";
    private $file;
    
    public function __construct(){
        $this->file = file_get_contents(self::FILE);
    }
    
    public function read($contact=null) {}

//     public function read($contact=null) {
//         if (!($fitxer = simplexml_load_file(self::FILE))) {
//             throw new Exception("No s'ha pogut obrie el fitxer ".self::FILE);
//         }
        
//         foreach ($fitxer->children() as $child) {
//             $data = $child->DATA->__toString();
//             $nom = $child->NOM->__toString();
//             $cognom = $child->COGNOM->__toString();
//             $mail = $child->MAIL->__ToString();
//             $comentari = $child->COMENTARI->__toString();
//             $contactes[] = new Contact($nom, $cognom, $mail, $comentari, $data);
//         }
//         return $contactes;
//     }

    public function create($contact) {
        $sLlibre = $this->file;
        $sLlibre = substr($sLlibre,0,-13);
        $sLlibre .= "\n<REGISTRE>\n<DATA>{$contact->data}</DATA>\n";
        $sLlibre .="     <NOM>{$contact->nom}</NOM>\n     <COGNOM>{$contact->cognom}</COGNOM>\n";
        $sLlibre .= "<MAIL>{$contact->mail}</MAIL>\n   <COMENTARI>{$contact->missatge}</COMENTARI>\n    </REGISTRE> \n";
        $sLlibre .= "</REGISTRES>";
        if ($file = fopen(self::FILE, "w")) {
            if (!fputs($file,$sLlibre)) {
                throw new Exception("El fitxer no deixa escriure");
            }
            fclose($file);
        } else {
            throw new Exception ("No s'ha pogut obrir el fitxer per emmagatzemar informació");
        }
        
    }

    public function update($contact) {}

    public function delete($id) {}
    
//     public function delete($id) {
//         if (!($fitxer = simplexml_load_file(self::FILE))) {
//             throw new Exception("No s'ha pogut obrie el fitxer ".self::FILE);
//         }

//         unset($fitxer->REGISTRE[$fitxer->count() - $id -1]);
//         $fitxer->asXML(self::FILE);
//     }
}

