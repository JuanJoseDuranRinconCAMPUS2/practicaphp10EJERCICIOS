<?php
// N atletas han pasado a finales en salto triple en los juegos
// olímpicos femenino de 2022. Diseñe un programa que pida por
// teclado los nombres de cada atleta finalista y a su vez, sus
// marcas del salto en metros. Informar el nombre de la atleta
// campeona que se quede con la medalla de oro y si rompió
// récord, reportar el pago que será de 500 millones. El récord
// esta en 15,50 metros.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Forms($variable){
        $html = ''; 

        for ($i = 1; $i <= $variable; $i++) {
            $estudianteHTML = '
            <fieldset id="dataForm">
                <legend>#Atleta ' . $i . '</legend>
                <label>Ingresa el nombre de la atleta </label><br>
                <input type="text" name="NombreA_' . $i . '" required><br><br>
                <label>Ingresa la marca de la Atleta</label><br>
                <input type="text" name="Marca_' . $i . '"  pattern="[0-9-.]+" required><br>
            </fieldset><br><br>
            ';

            $html .= $estudianteHTML;
        }

        return $html;
    }

    $validate = function($_DATA){
        if (is_numeric($_DATA["Atletas"])) {
            session_start();
            $Atletas = $_DATA["Atletas"];
            $_SESSION['#Atletas'] = $Atletas;
            $mensaje = Forms($Atletas);
            echo $mensaje;
        }else {
            $mensaje = "<h1>ERROR datos no compatibles, ingresa un numero</h1>";
            echo $mensaje;
        };
    };

    try {
        $res = match($_METHOD){
            "POST" => $validate($_DATA)
        };
    }catch (\Throwable $th) {
        $mensaje = "ERROR";
    };
?>