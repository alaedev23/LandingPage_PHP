<?php
class EsdevenimentView extends View {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function show($esdeveniment, $datos, $type, $lang = "es", $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        require_once $fitxerDeTraduccions;
        
        $thead = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titol</th>
                    <th>Subtitol</th>
                    <th>Dates</th>
                    <th>Imatge</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';
        
        $inputRow = '
            <tr>
                <td><input type="text" value="' . $esdeveniment->__get('id') . '" id="id" name="id" required />
                <p class="error">' . $errors['id'] . '</p></td>
                <td><input type="text" value="' . $esdeveniment->__get('titol') . '" id="titol" name="titol" required />
                <p class="error">' . $errors['titol'] . '</p></td>
                <td><input type="text" value="' . $esdeveniment->__get('subtitol') . '" id="subtitol" name="subtitol" required />
                <p class="error">' . $errors['subtitol'] . '</p></td>
                <td><input type="text" value="' . $esdeveniment->__get('dates') . '" id="dates" name="dates" required />
                <p class="error">' . $errors['dates'] . '</p></td>
                <td><input type="file" value="' . $esdeveniment->__get('imatge') . '" name="imatge" id="imatge" accept="image/png">
                <p class="error">' . $errors['imatge'] . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Esdeveniment/show">Vaciar</a></td>
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
          <td>' . $obj->titol . '</td>
          <td>' . $obj->subtitol . '</td>
          <td>' . $obj->dates . '</td>
          <td><img src="' . $obj->imatge . '" alt="' . $obj->titol . '"/></td>
          <td><a href="?Esdeveniment/showUpdate/' . $obj->id . '"> Update</a></td>
          <td><a href="?Esdeveniment/delete/' . $obj->id . '"> Delete</a></td>';
        }
        
        return $table;
    }
    
}
