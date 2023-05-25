

<?php
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];
    function OperacionMax($_DATA){
        $Estudiantes = $_SESSION['#Estudiantes'];
        $max = null;
        $operacionMax = null;
        $notas = [];
        for ($i = 1; $i <= $Estudiantes; $i++) {
            if (is_numeric($_DATA['Nota_' . $i])) {
                $nota = $_DATA['Nota_' . $i];
                $notas[] = $nota;
            }else {
                $notas = "Error";
            }
            
        };
        $max = max($notas);
        foreach ($notas as $i => $nota) {
            if ($nota == $max) {
                $operacionMax = ["Nombre" => $_DATA['Nombre_' . $i+1], "Genero"=> $_DATA['Genero_' . $i+1], "Nota"=> $_DATA['Nota_' . $i+1]];
            }
        };
        return $operacionMax;
    };
    function OperacionMin($_DATA){
        $Estudiantes = $_SESSION['#Estudiantes'];
        $min = null;
        $operacionMin = null;
        $notas = [];
        
        for ($i = 1; $i <= $Estudiantes; $i++) {
            if (is_numeric($_DATA['Nota_' . $i])) {
                $nota = $_DATA['Nota_' . $i];
                $notas[] = $nota;
            }else {
                $notas = "Error";
            }
        };
        $min = min($notas);
        foreach ($notas as $i => $nota) {
            if ($nota == $min) {
                $operacionMin = ["Nombre" => $_DATA['Nombre_' . $i+1], "Genero"=> $_DATA['Genero_' . $i+1], "Nota"=> $_DATA['Nota_' . $i+1]];
            }
        };
        return $operacionMin;
    };
    
    function CountHombresyMujeres($_DATA){
        $Estudiantes = $_SESSION['#Estudiantes'];
        $contadorHombres = 0;
        $contadorMujeres = 0; 
        
        for ($i = 1; $i <= $Estudiantes; $i++) { 
            if ($_DATA['Genero_' . $i] == "M") {
                $contadorHombres++;
            }elseif ($_DATA['Genero_' . $i] == "F") {
                $contadorMujeres++;
            }
        };
        $CountMyF = ["CountM" => $contadorHombres, "CountF"=> $contadorMujeres];

        return $CountMyF;
    }

    $validate = function($_DATA){
        if (is_numeric($_DATA['Nota_1'])) {
            session_start();
            $Estudiantes = $_SESSION['#Estudiantes'];
            $mensaje = (array) [
                "Numero1" => $Estudiantes,
                "max" => OperacionMax($_DATA),
                "min" => OperacionMin($_DATA),
                "CountMyF"  => CountHombresyMujeres($_DATA),

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