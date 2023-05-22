<?php
    // Construir el algoritmo para determinar el voltaje de un
    // circuito a partir de la resistencia y la intensidad de corriente.
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function voltaje(float $Corriente, float $Resistencia){ 
        $Voltaje = ($Corriente * $Resistencia);
        return $Voltaje;
    };

    $validate = function($_DATA){
        if (is_numeric($_DATA["Corriente"]) && is_numeric($_DATA["Resistencia"])) {
            $mensaje = (array) [
                "Voltaje" => strval(voltaje(...$_DATA)),
                "Corriente" => $_DATA["Corriente"],
                "Resistencia" => $_DATA["Resistencia"],
            ];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        }else {
            $mensaje = "error data no compatible";
        }
    };

    try {
        $res = match($_METHOD){
            "POST" => $validate($_DATA)
        };
    }catch (\Throwable $th) {
        $mensaje = "ERROR";
    };
    


?>