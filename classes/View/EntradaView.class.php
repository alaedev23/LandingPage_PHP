<?php

class EntradaView extends View
{

    public function __construct()
    {
        parent::__construct();
    }

    public static function show(Entrada $entrada, $datos, $ids, $type, $lang = "es", $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$lang}.php";

        require_once $fitxerDeTraduccions;

        $thead = '
            <thead>
                <tr>
                    <th>Esdeveniment ID</th>
                    <th>Data ID</th>
                    <th>Localització ID</th>
                    <th>Zona ID</th>
                    <th>Pagament ID</th>
                    <th>ID</th>
                    <th>Fila</th>
                    <th>Butaca</th>
                    <th>DNI</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>';

        $inputRow = '
            <tr>
                <td>' . self::generateSelect('esdeveniment_id', $ids['esdeveniment_id'], $entrada->__get('esdeveniment_id')) . '
                <p class="error">' . $errors['esdeveniment_id'] . '</p></td>
                <td>' . self::generateSelect('data_id', $ids['data_id'], $entrada->__get('data_id')) . '
                <p class="error">' . $errors['data_id'] . '</p></td>
                <td>' . self::generateSelect('loc_id', $ids['loc_id'], $entrada->__get('loc_id')) . '
                <p class="error">' . $errors['loc_id'] . '</p></td>
                <td>' . self::generateSelect('zona_id', $ids['zona_id'], $entrada->__get('zona_id')) . '
                <p class="error">' . $errors['zona_id'] . '</p></td>
                <td>' . self::generateSelect('pagament_id', $ids['pagament_id'], $entrada->__get('pagament_id')) . '
                <p class="error">' . $errors['pagament_id'] . '</p></td>
                <td><input type="text" value="' . $entrada->__get('id') . '" id="id" name="id" required />
                <p class="error">' . $errors['id'] . '</p></td>
                <td><input type="text" value="' . $entrada->__get('fila') . '" id="fila" name="fila" required />
                <p class="error">' . $errors['fila'] . '</p></td>
                <td><input type="text" value="' . $entrada->__get('butaca') . '" id="butaca" name="butaca" required />
                <p class="error">' . $errors['butaca'] . '</p></td>
                <td><input type="text" value="' . $entrada->__get('dni') . '" id="dni" name="dni" required />
                <p class="error">' . $errors['dni'] . '</p></td>
                <td><input class="btn" name="submit" type="submit" value="Guardar"></td>
                <td><a href="?Entrada/show">Vaciar</a></td>
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

            $table .= '<tr><td>' . $obj->esdeveniment_id . '</td>
          <td>' . $obj->data_id . '</td>
          <td>' . $obj->loc_id . '</td>
          <td>' . $obj->zona_id . '</td>
          <td>' . $obj->pagament_id . '</td>
          <td>' . $obj->id . '</td>
          <td>' . $obj->fila . '</td>
          <td>' . $obj->butaca . '</td>
          <td>' . $obj->dni . '</td>
          <td><a href="?Entrada/showUpdate/' . $obj->id . '"> Update</a></td>
          <td><a href="?Entrada/delete/' . $obj->id . '"> Delete</a></td>';
        }

        return $table;
    }

    public static function generateSelect($name, $options, $selectedValue = null)
    {
        $select = '<select name="' . $name . '" required>';
        
        foreach ($options as $option) {
            $selected = ($selectedValue !== null && $selectedValue == strtolower($option)) ? 'selected' : '';
            $select .= '<option value="' . strtolower($option) . '" ' . $selected . '>' . $option . '</option>';
        }
        
        $select .= '</select>';
        
        return $select;
    }
}
?>
