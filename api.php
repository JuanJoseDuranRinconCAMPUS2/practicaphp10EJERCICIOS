<?php
// Construir el algoritmo que solicite el nombre y edad de 3
// personas y determine el nombre de la persona con mayor edad.


    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Mayor($_DATA){ 
        $mayor = max($_DATA["persona_1_Edad"], $_DATA["persona_2_Edad"], $_DATA["persona_3_Edad"]);
        $resultado = match (true) {
            $mayor == $_DATA["persona_1_Edad"] => ["Nombre" => $_DATA["persona_1_Nombre"], "Edad"=> $_DATA["persona_1_Edad"]],
            $mayor == $_DATA["persona_2_Edad"] => ["Nombre" => $_DATA["persona_2_Nombre"], "Edad"=> $_DATA["persona_2_Edad"]],
            $mayor == $_DATA["persona_3_Edad"] => ["Nombre" => $_DATA["persona_3_Nombre"], "Edad"=> $_DATA["persona_3_Edad"]],
            default => 'ninguno',
        };
        
        return $resultado;
    };

    $validate = function($_DATA){
        if (is_numeric($_DATA["persona_1_Edad"]) && is_numeric($_DATA["persona_2_Edad"]) && is_numeric($_DATA["persona_3_Edad"])) {
            $mensaje = (array) [
                "Persona1"=> ["Nombre" => $_DATA["persona_1_Nombre"], "Edad"=> $_DATA["persona_1_Edad"]],
                "Persona2" => ["Nombre"=> $_DATA["persona_2_Nombre"], "Edad"=> $_DATA["persona_2_Edad"]],
                "Persona3" => ["Nombre"=> $_DATA["persona_3_Nombre"], "Edad"=> $_DATA["persona_3_Edad"]],
                "Mayor" => Mayor($_DATA),
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