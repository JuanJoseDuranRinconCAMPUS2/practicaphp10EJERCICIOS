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
    foreach($_DATA as $i){
        $dato = floatval($i['Numero']);
        if (is_numeric($dato)) {
            array_push($datos, $dato);
        };
    }
    $suma = array_sum($datos);
    $numDatos = count($datos);
    $lengthDatos = $suma / $numDatos;
    $Min = min($datos);
    $Max = max($datos);
    if (in_array(0, $datos)){
        return array(
            "Suma" => $suma,
            "Promedio" => $lengthDatos,
            "lengthDatos" => $numDatos,
            "Min" => $Min,
            "Max" => $Max,
        );
    } 
};
function validate($_DATA){
    if (is_array($_DATA)) {
        $mensaje = (array) [
            "Num" => $_DATA,
            "operacionD" => operacionD($_DATA),
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