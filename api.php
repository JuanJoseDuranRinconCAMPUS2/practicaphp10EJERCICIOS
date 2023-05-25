<?php
//    Programa que pida el ingreso del nombre y precio de un artículo y la
//    cantidad que lleva el cliente. Mostrar lo que debe pagar el comprador
//    en su factura.

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $_METHOD = $_SERVER["REQUEST_METHOD"];

    function Total($_DATA){
        $subtotal = $_DATA["Cproducto"] * $_DATA["Pproducto"];
        $Iva = $subtotal * 0.19;
        $total = $subtotal + $Iva;
        return $total; 
    };
    $validate = function($_DATA){
        if (is_numeric($_DATA["ID"]) && is_numeric($_DATA["Pproducto"]) && is_numeric($_DATA["Cproducto"])) {
            $mensaje = '
                <h3> Factura </h3>
                <h4> Datos del comprador </h4>
                <p>Comprador: ' . $_DATA["Cliente"] .'</p>
                <p>TI: ' . $_DATA["ID"] .'</p>
                <h4> Datos del producto </h4>
                <p>Nombre_Del_Producto: ' . $_DATA["Nproducto"] .'</p>
                <p>Cantidad_Del_Producto: ' . $_DATA["Cproducto"] .'</p>
                <p>Precio_Del_Producto: ' . $_DATA["Pproducto"] .'</p>
                <p>Total: ' . Total($_DATA);'</p>
            ';
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