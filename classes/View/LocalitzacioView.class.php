<?php

class LocalitzacioView extends View {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function show(Localitzacio $localitzacio, $datos, $type, $lang = "es", $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        require_once $fitxerDeTraduccions;
        
        $thead = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lloc</th>
                    <th>Adreça</th>
                    <th>Localitat</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';
        
        $inputRow = '
            <tr>
                <td><input type="text" value="' . $localitzacio->__get('id') . '" id="id" name="id" required />
                <p class="error">' . $errors['id'] . '</p></td>
                <td><input type="text" value="' . $localitzacio->__get('lloc') . '" id="lloc" name="lloc" required />
                <p class="error">' . $errors['lloc'] . '</p></td>
                <td><input type="text" value="' . $localitzacio->__get('adreca') . '" id="adreca" name="adreca" required />
                <p class="error">' . $errors['adreca'] . '</p></td>
                <td><input type="text" value="' . $localitzacio->__get('localitat') . '" id="localitat" name="localitat" required />
                <p class="error">' . $errors['localitat'] . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Localitzacio/show">Vaciar</a></td>
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
          <td>' . $obj->lloc . '</td>
          <td>' . $obj->adreca . '</td>
          <td>' . $obj->localitat . '</td>
          <td><a href="?Localitzacio/showUpdate/' . $obj->id . '"> Update</a></td>
          <td><a href="?Localitzacio/delete/' . $obj->id . '"> Delete</a></td>';
        }
        
        return $table;
    }
}
