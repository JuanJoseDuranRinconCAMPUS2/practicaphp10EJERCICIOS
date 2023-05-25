<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];
    function MejorAtleta($_DATA){
        $Atletas = $_SESSION['#Atletas'];
        $BEST = null;
        $operacionMax = null;
        $marcas = [];
        for ($i = 1; $i <= $Atletas; $i++) {
            if (is_numeric($_DATA['Marca_' . $i])) {
                $marca = $_DATA['Marca_' . $i];
                $marcas[] = $marca;
            }else {
                $marcas = "Error";
            }
            
        };
        $BEST = max($marcas);
        foreach ($marcas as $i => $marca) {
            if ($marca == $BEST) {
                $medallaOro = ["Nombre" => $_DATA['NombreA_' . $i+1], "Marca"=> $_DATA['Marca_'. $i+1]];
            }
        };
        $_SESSION['#medallaOro'] = $medallaOro;
        return $medallaOro;
    };
    
    function Record($_DATA){
        $medallaOro = $_SESSION['#medallaOro'];
        $felicitaciones = "La Finalista ganadora del Oro es" . "  " .  $medallaOro["Nombre"] . "  "  . "gracias a su marca de " . $medallaOro["Marca"] . "mts. FELICIDADES";
        if ($medallaOro["Marca"] >= 15.50) {
            $Premio = "¡INCREIBLE!, rompiste nuestro record anterior, recuerda reclamar tu pago de 500 millones por llegar tan lejos";
            $premiacion = $felicitaciones . " " . $Premio;
        }else {
            $premiacion = $felicitaciones;
        };
        return $premiacion;
    }

    $validate = function($_DATA){
        if (is_numeric($_DATA['Marca_1'])) {
            session_start();
            $Atletas = $_SESSION['#Atletas'];
            $mensaje = (array) [
                "#Atletas" => $Atletas,
                "MedallaDeOro" => MejorAtleta($_DATA),
                "Premiacion" => Record($_DATA),
            ];
            echo json_encode($mensaje, JSON_PRETTY_PRINT);
        }else {
            echo "error";
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