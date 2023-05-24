<?php
    // Construir el algoritmo que lea por teclado dos números,
    // si el primero es mayor al segundo informar su suma y
    // diferencia, en caso contrario, informar el producto y la
    // división del primero respecto al segundo.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Operacion($_DATA){
        $mayor = max($_DATA["Numero1"], $_DATA["Numero2"]);
        $operacion = match (true){ 
            $mayor == $_DATA["Numero1"] => ["Operacion1" => ($_DATA["Numero1"] - $_DATA["Numero2"]), "Operacion2"=> ($_DATA["Numero1"] + $_DATA["Numero2"])],
            $mayor == $_DATA["Numero2"] => ["Operacion1" => ($_DATA["Numero1"] * $_DATA["Numero2"]), "Operacion2"=> ($_DATA["Numero1"] / (($_DATA["Numero2"] == 0) ? 1 : $_DATA["Numero2"]))],
            
        };
        return $operacion;
    }
    function mayor($_DATA){ 
        $mayor = max($_DATA["Numero1"], $_DATA["Numero2"]);
        return $mayor;

    }
    $validate = function($_DATA){
        if (is_numeric($_DATA["Numero1"]) && is_numeric($_DATA["Numero2"])) {
            $mensaje = (array) [
                "Numero1" => $_DATA["Numero1"],
                "Numero2" => $_DATA["Numero2"],
                "Operaciones" => Operacion($_DATA),
                "Mayor" => mayor($_DATA),

            ];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        }else {
            $mensaje = "ERROR";
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