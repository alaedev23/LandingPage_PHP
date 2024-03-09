<?php

class PagamentView extends View {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function show(Pagament $pagament, $datos, $type, $lang = "es", $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$lang}.php";
        
        require_once $fitxerDeTraduccions;
        
        $thead = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Banc</th>
                    <th>Ref. Externa</th>
                    <th>Data</th>
                    <th>Estat</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';
        
        $inputRow = '
            <tr>
                <td><input type="text" value="' . $pagament->__get('id') . '" id="id" name="id" required />
                <p class="error">' . $errors['id'] . '</p></td>
                <td><input type="text" value="' . $pagament->__get('banc') . '" id="banc" name="banc" required />
                <p class="error">' . $errors['banc'] . '</p></td>
                <td><input type="text" value="' . $pagament->__get('ref_externa') . '" id="ref_externa" name="ref_externa" required />
                <p class="error">' . $errors['ref_externa'] . '</p></td>
                <td><input type="text" value="' . $pagament->__get('data') . '" id="data" name="data" required />
                <p class="error">' . $errors['data'] . '</p></td>
                <td><input type="text" value="' . $pagament->__get('estat') . '" id="estat" name="estat" required />
                <p class="error">' . $errors['estat'] . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Pagament/show">Vaciar</a></td>
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
          <td>' . $obj->banc . '</td>
          <td>' . $obj->ref_externa . '</td>
          <td>' . $obj->data . '</td>
          <td>' . $obj->estat . '</td>
          <td><a href="?Pagament/showUpdate/' . $obj->id . '"> Update</a></td>
          <td><a href="?Pagament/delete/' . $obj->id . '"> Delete</a></td>';
        }
        
        return $table;
    }
}
