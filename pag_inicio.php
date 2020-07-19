<?php
	session_start();

	$conexion=mysqli_connect('localhost','root','','creamuebles');

	if(isset($_SESSION['user_id'])){
		$records = $conexion->prepare('SELECT id, usuario, contraseña FROM usuarios WHERE id=? ;');
		$records->bind_param('i',$_SESSION['user_id']);
		$records->execute();
		$results = $records->get_result()->fetch_assoc();

		if(count($results)==0){
			echo "<script> alert('Debes Registrarte');
						window.location='registrarse.html'; </script>";
		}
	}else{
		echo "<script> alert('Debes ingresar');
						window.location='ini_sesion.html'; </script>";
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial -sale=1.0">
    <title>Crea Muebles</title>

    <style>
        body{
            background: url(fondo2.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin-top: 0px;
        }
        header{
				background-color: rgb(0, 0, 0);
				width: 100%;
                height: 100px;
                opacity: 0.9;
				text-align: center;
				margin: 0 auto;

			}
        h1{
            color: white;
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 70px;
            text-shadow: 5px 3px 0px gray;
            text-align: center;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .marco{
            border: 1px solid #cccccc;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            width: 300px;
            margin-top: 20px;
            opacity: 0.8;
        }

        .x{
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 12px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: #213058;
            font-weight: 10;
            text-align:center;
            background-color:rgb(179, 183, 184);
            border-radius: 3px;
            padding: 7px;
            margin:5px;
            width: 150px;

        }
        
        div,form,table,tr,td{
            margin: 0 auto;
            text-align: center;

        }
    
        .td_tabla{
            text-align: justify;
        }
        
        .a {
            background-color: #8b5f5f75;
            border: 2px solid rgb(0, 0, 0);
            font-size:20px;
            color:black;
            border-radius: 10px;
            margin: 10px;
        }
        .letra{
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 15px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: #ffffff;
            font-weight: 400;
            text-decoration: none;
            font-style: normal;
            font-variant: normal;
            text-transform: none;
            opacity: 1;
        }
        ul, ol{
				list-style:none;
                margin-block-end: 0;
                margin-block-start: 0;
                padding-inline-start: 0px;

			}
			.nav li a{
				font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
				background-color: black;
				font-size: 20px;
				font-weight: 30px;
				color: white;
				width: 209px;
				text-decoration: none;
				padding: 10px 0px 10px 0px;
				display: inline-block;
				text-align: center;
			}
			.nav li a:hover{
				background-color: black;
			}
			.nav > li {
				float: left;
		}
        img{
            width: 200px;
            text-align: cen;
        }
        .img_p{
            width: 20px;
        }
        .muebles_tablas{
            margin-top: 80px;
            border: 1px solid #cccccc;
            padding: 30px;
            width: 90%;
            background-color: white;
            border-radius: 10px;
            font-size: 17px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            opacity: 0.8;
            text-align: justify;
        }
        .tabla{
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>

</head>
<body background="/fondo/fondo2.jpg">

<header>
    <h1 >Crea Muebles</h1>
    <ul class="nav">
        <li>
            <a href="pag_inicio.php" style="border: 2px solid gray; width: 100px;" >Inicio</a>
        </li>
        <li>
            <a href="mueble.php" style="border: 2px solid gray;">Nuevo Mueble</a>
        </li>   
        <li>
            <a href="modificar.php" style="border: 2px solid gray; " >Modificar Plano</a>
        </li>
        <li>
            <a href="materiales.php" style="border: 2px solid gray;width: 350px;">Agregar Material/Herramienta</a>
        </li>
        <li>
            <a href="listar_herramientas.php" style="border: 2px solid gray; width: 320px; ">Materiales y Herramientas</a>
        </li>
        <li>
            <a href="logout.php" style="border: 2px solid gray ; width: 120px;"><img src="logout.png" class="img_p" />   Salir</a>
        </li>
    </ul>
</header>
    
<table class="muebles_tablas">
    <?php
        $sql_mueble ="SELECT * FROM muebles;";
        $resul_mueble= mysqli_query($conexion,$sql_mueble);
        $total_mueble = mysqli_num_rows($resul_mueble);	

        if($total_mueble>0){ 
            for($i = 1; $i<=$total_mueble; $i++){
                $sql2 = "SELECT * FROM muebles WHERE id=$i";
                $resul2 = mysqli_query($conexion,$sql2);

                while($datos = mysqli_fetch_assoc($resul2)){
                    $id = $datos["id"];
                    $tipo = $datos["tipo"];
                    $plano = $datos["plano"];
                    $cotizacion = $datos["cotizacion"];
                    $f_inicio = $datos["f_inicio"];
                    $f_entrega = $datos["f_entrega"];
                    $foto_final = $datos["foto_final"];
                    $cedula_cliente = $datos["ced_cliente"];

                    $sql3 = "SELECT * FROM clientes where cedula=$cedula_cliente";
                    $resul3 = mysqli_query($conexion, $sql3);
                    $datos3 = mysqli_fetch_assoc($resul3);

                    $cliente = $datos3["nombre"];
                    $telefono = $datos3["telefono"];
                    $direccion = $datos3["direccion"];

                    echo "<tr>";
                    echo "<td rowspan='4'><img src='$plano'/></td>";
                    echo "<td rowspan='4'><img src='$foto_final'/></td>";
                    echo "<td>Código: $id </td>";
                    echo "<td>Nombre: $cliente</td>";
                    echo "</tr>";

                    echo "<tr><td>Teléfono: $telefono</td>";
                    echo "<td>Dirección: $direccion</td></tr>";                                                  
                    
                    echo "<tr><td>Fecha inicio: $f_inicio</td>";
                    echo "<td>Fecha entrega: $f_entrega</td></tr>";

                    echo "<tr><td>Tipo: $tipo</td></tr>";
                }
            }
        }	
    ?>
	</table>

</body>
</html>