<?php

    $conexion_mysql=mysqli_connect('localhost','root','','creamuebles');

    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $almacen = $_POST["almacen"];
    $cantidad = $_POST["cantidad"];
    $precio_unidad = $_POST["p_unidad"];

    if (!empty($nombre) && !empty($tipo) && !empty($almacen) && !empty($cantidad) && !empty($precio_unidad)){
        $precio_total = $cantidad * $precio_unidad;

        $sql =  $conexion_mysql->prepare("INSERT INTO inventario (nombre, tipo, almacen, cantidad, precio_unitario, precio_total) VALUES (?,?,?,?,?,?)");
                $sql->bind_param('sssiii', $nombre, $tipo, $almacen, $cantidad, $precio_unidad, $precio_total);

        if($sql->execute()){
            echo "<script> alert('Material/Herramienta registrado');
                    window.location='materiales.php'; </script>";
        }else{
            echo "<script> alert('***');
                    window.location='materiales.php'; </script>";
        }
    }else{
        echo "<script> alert('Debes llenar todos los campos');
                    window.location='materiales.php'; </script>";
    }

?>
