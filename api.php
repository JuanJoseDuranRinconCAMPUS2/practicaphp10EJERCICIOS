<?php
    // Construir el algoritmo en Javascript para un programa
    // para cualquier cantidad de estudiantes que lea el nombre,
    // el sexo y la nota definitiva y halle al estudiante con la mayor
    // nota y al estudiante con la menor nota y cuantos eran
    // hombres y cuantos mujeres.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Forms($variable){
        $html = ''; 

        for ($i = 1; $i <= $variable; $i++) {
            $estudianteHTML = '
            <fieldset id="dataForm">
                <legend>#Estudiante ' . $i . '</legend>
                <label>Ingresa el nombre del estudiante </label><br>
                <input type="text" name="Nombre_' . $i . '"   required><br><br>
                <label>Ingresa el genero del estudiante </label><br>
                <select name="Genero_' . $i . '" required>
                    <option value="M">Hombre</option>
                    <option value="F">Mujer</option>
                </select><br><br>
                <label>Ingresa la nota del estudiante </label><br>
                <input type="text" name="Nota_' . $i . '"   required><br>
            </fieldset><br><br>
            ';
    
            $html .= $estudianteHTML;
        }
    
        return $html;
    }

    $validate = function($_DATA){
        if (is_numeric($_DATA["estudiantes"])) {
            session_start();
            $variable = $_DATA["estudiantes"];
            $_SESSION['#Estudiantes'] = $variable;
            $mensaje = Forms($variable);
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