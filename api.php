<?php
    // Dado un número indicar si es par o impar y si es mayor de 10.
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Mayor(float $Numero){
        return ($Numero < 10) ? "El numero $Numero es menor a Diez" : (($Numero == 10) ? "El numero $Numero es Diez" : "El numero $Numero es mayor a Diez");
    }
    function ParOrNot(float $Numero){ 
        $residuo = $Numero%2;
        return ($residuo == 0) ? "El numero $Numero es par" : "El numero $Numero es impar";

    }
    $validate = function($_DATA){
        if (is_numeric($_DATA["Numero"])) {
            $mensaje = (array) [
                "Numero" => $_DATA["Numero"],
                "Par" => ParOrNot(...$_DATA),
                "Mayor" => Mayor(...$_DATA),
            ];
        echo json_encode($mensaje, JSON_PRETTY_PRINT);
        
        }else {
            $mensaje = "ERROR";
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