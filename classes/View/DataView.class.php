<?php

class DataView extends View {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function show(Data $data, $dataObjects, $type, $lang = "es", $errors = null)
    {
        $translationFile = "lang/{$lang}.php";
        
        require_once $translationFile;
        
        $thead = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';
        
        $inputRow = '
            <tr>
                <td><input type="text" value="' . $data->__get('id') . '" id="id" name="id" required />
                <p class="error">' . ($errors['id'] ?? '') . '</p></td>
                <td><input type="text" value="' . $data->__get('data') . '" id="data" name="data" required />
                <p class="error">' . ($errors['data'] ?? '') . '</p></td>
                <td><input type="text" value="' . $data->__get('hora') . '" id="hora" name="hora" required />
                <p class="error">' . ($errors['hora'] ?? '') . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Data/show">Vaciar</a></td>
            </tr>';
        
        $table = self::generateTable($dataObjects);
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/nav_manteniment.php";
        echo '<div class="container">';
        include "templates/body_manteniment.php";
        echo "</body></html>";
    }
    
    public static function generateTable($dataObjects)
    {
        $table = '';
        
        foreach ($dataObjects as $obj) {
            $table .= '<tr>
                <td>' . $obj->id . '</td>
                <td>' . $obj->data . '</td>
                <td>' . $obj->hora . '</td>
                <td><a href="?Data/showUpdate/' . $obj->id . '"> Update</a></td>
                <td><a href="?Data/delete/' . $obj->id . '"> Delete</a></td>
            </tr>';
        }
        
        return $table;
    }
}
?>
