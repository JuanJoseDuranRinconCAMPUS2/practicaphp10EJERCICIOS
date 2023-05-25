<?php
// Desarrolle un programa cíclico que capture un dato
// numérico cada vez, y los vaya acumulando. El programa se
// detiene cuando el usuario digita un cero. El programa debe
// mostrar: LA SUMATORIA DE LOS VALORES, EL VALOR DEL
// PROMEDIO, CUÁNTOS VALORES FUERON DIGITADOS, MAYOR
// VALOR Y MENOR VALOR.

header("Content-Type: application/json; charset:UTF-8");
$_DATA = json_decode(file_get_contents("php://input"), true);
$_METHOD = $_SERVER["REQUEST_METHOD"];
    

function operacionD($_DATA){
    $datos = array();
    foreach ($_DATA as $i) {
        $dato = floatval($i['Numero']);
        if (is_numeric($dato)) {
            $datos[] = $dato;
        }
    }
    return $datos;
};
function suma($_DATA){
    $datos = operacionD($_DATA);
    $suma = array_sum($datos);
    if (in_array(0, $datos)) {
        return $suma;
    };
};
function Promedio($_DATA){
    $datos = operacionD($_DATA);
    $suma = suma($_DATA);
    $numDatos = lengthDatos($_DATA);
    $Promedio = $suma / $numDatos;
    if (in_array(0, $datos)) {
        return $Promedio;
    };
};
function lengthDatos($_DATA){
    $datos = operacionD($_DATA);
    $numDatos = count($datos);
    if (in_array(0, $datos)) {
        return $numDatos;
    }
};
function MaxD($_DATA){
    $datos = operacionD($_DATA);
    $Max = max($datos);
    if (in_array(0, $datos)) {
        return $Max;
    };
};
function MinD($_DATA){
    $datos = operacionD($_DATA);
    $Min = min($datos);
    if (in_array(0, $datos)) {
        return $Min;
    };
};
function validate($_DATA){
    if (is_array($_DATA)) {
        $mensaje = (array) [
            "Num" => $_DATA,
            "Suma" => suma($_DATA),
            "Promedio" => Promedio($_DATA),
            "lengthDatos" => lengthDatos($_DATA),
            "Max" => MaxD($_DATA),
            "Min" => MinD($_DATA),
        ];
        echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }
    
    
    
};

try {
$res = match($_METHOD){
    "POST" => validate($_DATA)
};
}catch (\Throwable $th) {
    $res = "ERROR";
};

   
?>