<?php

    $conexion_mysql=mysqli_connect('localhost','root','','creamuebles');

    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $id_cliente = $_POST["cedula"];

    $sql2 = $conexion_mysql->prepare("SELECT * FROM clientes WHERE cedula=?");
    $sql2->bind_param('i',$id_cliente);
    $sql2->execute();
    $results = $sql2->get_result()->fetch_assoc();

    if(count($results)==0){
        $sql =  $conexion_mysql->prepare("INSERT INTO clientes (nombre, telefono, direccion, cedula) VALUES (?,?,?,?)");
        $sql->bind_param('sssi', $nombre, $telefono, $direccion, $id_cliente);

        if($sql->execute()){
            echo "<script> alert('Cliente registrado');
                    window.location='pag_inicio.php'; </script>";
        }else{
            echo "<script> alert('Error en el registro');
                    window.location='clientes_registro.php'; </script>";
        }
    }else{
        echo "<script> alert('El cliente ya esta registrado');
                window.location='pag_inicio.php'; </script>";
    }




    
?>