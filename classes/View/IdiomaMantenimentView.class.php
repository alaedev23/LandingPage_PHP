<?php

class IdiomaMantenimentView extends View {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show(Array $idiomas) {
        $fitxerDeTraduccions = "lang/{$this->lang}.php";
        include $fitxerDeTraduccions;
        
        $html = $this->generateTable($idiomas);
        
        $title = 'Manteniment d\'Idiomes';
        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/body_idiomas.php";
        echo "</body></html>";
    }
    
    public function generateTable($idiomas) {
        $tabla = '<table>';
        
        $tabla .=
        '<thead>
            <tr>
                <th>ID</th>
                <th>ISO</th>
                <th>IMG</th>
                <th>ACTIU</th>
                <th colspan="2">ACTIONS</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach ($idiomas as $idioma) {
            $tabla .= '<tr>';
                $tabla .= '<td>' . $idioma->id . '</td>';
                $tabla .= '<td>' . $idioma->iso . '</td>';
                $tabla .= '<td><img src="'.$idioma->imatge . '" alt="' . $idioma->iso . '" />';
                $tabla .= '<td><input class="styled-checkbox" type="checkbox" ' . ($idioma->actiu ? 'checked' : '') . ' disabled></td>';
                $tabla .= '<td><a href="?idiomaManteniment/update/'. $idioma->id  .'">MODIFICAR</td>';
                $tabla .= '<td><a href="?idiomaManteniment/delete/'. $idioma->id  .'">ESBORRAR</td>';
            $tabla .= '</tr>';
        }
        
        $tabla .=
        '<tr><td id="create" colspan="6" ><a href="?idiomaManteniment/create">CREAR</td></tr>
        </tbody>
        </table>';
        
        return $tabla;
    }
    
    
}

