<?php

    $conexion_mysql=mysqli_connect('localhost','root','','creamuebles');

    $tipo = $_POST["tipo"];
    $f_inicio = $_POST["f_inicio"];
    $f_entrega = $_POST["f_entrega"];
    $plano = "imagenes/" . basename($_FILES['plano']['name']);
    $cotizacion = "imagenes/" . basename($_FILES['cotizacion']['name']);
    $foto_final = "imagenes/i_defecto.png";
    $id_cliente= $_POST["cedula"];

    if (!empty($tipo) && !empty($f_inicio) && !empty($f_entrega) && !empty($plano) && !empty($cotizacion) && !empty($foto_final) && !empty($id_cliente)){

        $sql =  $conexion_mysql->prepare("INSERT INTO muebles (tipo, plano, cotizacion, f_inicio, f_entrega, foto_final, ced_cliente) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param('ssssssi',$tipo,$plano,$cotizacion,$f_inicio,$f_entrega,$foto_final,$id_cliente);
        if($sql->execute()){
            echo "<script> alert('Información del mueble guardada');
                    window.location='clientes_registro.php'; </script>";
            if (move_uploaded_file($_FILES['plano']['tmp_name'], $plano)) {
            }else{
                echo "No correcto";
            }
        }else{
            echo "<script> alert('Error en el registro');
                    window.location='mueble.php'; </script>";
        }
    }else{
        echo "<script> alert('Debes llenar todos los campos');
                    window.location='mueble.php'; </script>";
    }


?>
