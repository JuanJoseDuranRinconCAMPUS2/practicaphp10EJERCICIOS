<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promedio notas</title>
</head>
<body>
<fieldset>
    <h3>Hola camper Ingresa tus notas a continuacion</h3>
    <form action="PrimerEjercicioPhp.php" method="get">
        <legend>Nota 1</legend>
        <label>Ingresa tu primera nota</label><br>
        <input type="text" name="nota1">

        <legend>Nota 2</legend>
        <label>Ingresa tu segunda nota</label><br>
        <input type="text" name="nota2">

        <legend>Nota 3</legend>
        <label>Ingresa tu tercera nota</label><br>
        <input type="text" name="nota3"><br><br>
        <input type="submit" value="Hecho">
    </form>
</fieldset>
</body>
</html>
<?php
function accion()
{
    if ($_GET){
        $nota1 = $_GET['nota1'];
        $nota2 = $_GET['nota2'];
        $nota3 = $_GET['nota3'];
        $total = floatval($nota1) + floatval($nota2) + floatval($nota3);
        $promedio = $total / 3;
        echo "tu promedio es de {$promedio} <br><br>";
        if($promedio >= 3.9){
            echo '<script language="javascript">alert("Bien sigue asi :3");</script>';
        }
        else {
            if($promedio == 1){
                echo '<script language="javascript">alert("acaso lo intentaste ? ._.xd");</script>';
            }else{
                echo '<script language="javascript">alert("Estudie vago >:v");</script>';
            }
        }
    }
}

    accion();

?>