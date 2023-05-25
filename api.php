<?php
//    Programa que pida el ingreso del nombre y precio de un artículo y la
//    cantidad que lleva el cliente. Mostrar lo que debe pagar el comprador
//    en su factura.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function CalculoCuadrado($_DATA){
        $perimetroCuadrado = $_DATA["Cuadrado_Lado"] * 4;
        return $perimetroCuadrado;
    };
    function CalculoRectangulo($_DATA){
        $areaRestangulo = $_DATA["Rectangulo_Base"] * $_DATA["Rectangulo_Altura"];
        return $areaRestangulo;
    };
    $validate = function($_DATA){
        if (is_numeric($_DATA["Rectangulo_Base"]) && is_numeric($_DATA["Rectangulo_Altura"]) && is_numeric($_DATA["Cuadrado_Lado"])) {
            $mensaje = (array) [
                "Cuadrado_Lado" => $_DATA["Cuadrado_Lado"],
                "Rectangulo_Base" => $_DATA["Rectangulo_Base"],
                "Rectangulo_Altura" => $_DATA["Rectangulo_Altura"],
                "PerimetroCuadrado" => CalculoCuadrado($_DATA),
                "AreaRestangulo" => CalculoRectangulo($_DATA),

            ];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        }else {
            $mensaje = "<h1>ERROR datos no compatibles, ingresa un numero</h1>";
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