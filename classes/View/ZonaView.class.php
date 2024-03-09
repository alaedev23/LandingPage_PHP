<?php

class ZonaView extends View {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function show(Zona $zona, $datos, $type, $lang = "es", $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        require_once $fitxerDeTraduccions;
        
        $thead = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripció</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';
        
        $inputRow = '
            <tr>
                <td><input type="text" value="' . $zona->__get('id') . '" id="id" name="id" required />
                <p class="error">' . $errors['id'] . '</p></td>
                <td><input type="text" value="' . $zona->__get('descripcio') . '" id="descripcio" name="descripcio" required />
                <p class="error">' . $errors['descripcio'] . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Zona/show">Vaciar</a></td>
            </tr>';
        
        $table = self::generateTable($datos);
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/nav_manteniment.php";
        include "templates/body_manteniment.php";
        echo "</body></html>";
    }
    
    public static function generateTable($datos)
    {
        $table = '';
        
        foreach ($datos as $obj) {
            
            $table .= '<tr>
          <td>' . $obj->id . '</td>
          <td>' . $obj->descripcio . '</td>
          <td><a href="?Zona/showUpdate/' . $obj->id . '"> Update</a></td>
          <td><a href="?Zona/delete/' . $obj->id . '"> Delete</a></td>';
        }
        
        return $table;
    }
}
