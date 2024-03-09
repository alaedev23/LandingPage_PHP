<?php

class IdiomaView extends View
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show(Idioma $idioma = null, $idiomas, $type = 'M')
    {
        $fitxerDeTraduccions = "lang/{$this->lang}.php";
        include $fitxerDeTraduccions;

        $title = $type == 'M' ? 'modificar' : 'create';

        $html .= $this->generateIdioma($idioma, $idiomas, $type);

        
        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/body_idiomas.php";
        echo "</body></html>";
    }

    public function showEmptyForm($idiomas, $errors = null)
    {
        $fitxerDeTraduccions = "lang/{$this->lang}.php";
        include $fitxerDeTraduccions;

        $title = 'create';

        $html = $this->generateIdioma(null, $idiomas, 'C');

        echo "<!DOCTYPE html><html lang=\"en\">";
        include "templates/head.php";
        echo "<body>";
        include "templates/header.php";
        include "templates/body_idiomas.php";
        echo "</body></html>";
    }

    public function generateIdioma($idioma, $idiomas, $type, $errors = null)
    {
        if ($type == 'C') {
            $form = '<form method="post" action="?IdiomaManteniment/create">';
        } else {
            $form = '<form method="post" action="?IdiomaManteniment/update/' . $idioma->id .'">';
        }
        
        if ($type !== 'C') {
            $form .= $this->generateLabelAndInput('ID', 'id', $idioma->id . ' (Solo Lectura)', 'readonly');
        }
        
        $form .= $this->generateLabelAndInput('ISO', 'iso', $idioma->iso);
        $form .= $this->generateLabelAndInput('IMG', 'imatge', $idioma->imatge);
        $form .= $this->generateCheckbox('ACTIU', 'actiu', $idioma->actiu);
        
        $labelGenerated = false;
        
        foreach ($idiomas as $otherIdioma) {
            $flagImg = '<img src="' . $otherIdioma->imatge . '" alt="' . $otherIdioma->iso . ' flag" width="20" height="15">';
            $form .= '<div class="traduccions">';
            
            $form .= '<label for="translation_' . $otherIdioma->iso . '">' . $flagImg . '</label>';
            
            if ($idioma->traduccions == null) {
                $form .= '<input type="text" id="translation_' . $otherIdioma->iso . '" name="translation_' . $otherIdioma->iso . '" value="">';
            } else {
                $translationValue = '';
                
                foreach ($idioma->traduccions as $traduccio) {
                    if ($traduccio->idioma_id == $otherIdioma->id) {
                        $translationValue = $traduccio->valor;
                        break;
                    }
                }
                
                $form .= '<input type="text" id="translation_' . $otherIdioma->iso . '" name="translation_' . $otherIdioma->iso . '" value="' . $translationValue . '">';
            }
            
            $form .= '</div>';
        }
        
        if (isset($errors)) {
            $form .= '<span class="error">' . $errors . '</span>';
        }
        
        $form .= '<div id="enviar"><input type="submit" value="Submit"></div>';
        $form .= '</form>';
        
        return $form;
    }
    
    

    private function generateLabelAndInput($label, $name, $value, $additionalAttributes = '')
    {
        $inputField = '<div>';
        $inputField .= '<label for="' . $name . '">' . $label . '</label>';
        $inputField .= '<input type="text" id="' . $name . '" name="' . $name . '" value="' . $value . '" ' . $additionalAttributes . '>';
        $inputField .= '</div>';
        return $inputField;
    }

    private function generateCheckbox($label, $name, $checked)
    {
        $checkboxField = '<div class="checkbox_container">';
        $checkboxField .= '<label for="' . $name . '">' . $label . '</label>';
        $checkboxField .= '<input class="functional-checkbox" type="checkbox" id="' . $name . '" name="' . $name . '" ' . ($checked ? 'checked' : '') . '>';
        $checkboxField .= '</div>';
        return $checkboxField;
    }

    private function getTranslationValue($translations, $variable)
    {
        foreach ($translations as $translation) {
            if ($translation->variable === $variable) {
                return $translation->valor;
            }
        }
        return '';
    }
}

