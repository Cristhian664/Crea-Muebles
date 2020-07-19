<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crea Muebles</title>
    <style>
        body {
            background: url(fondo2.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin-top: 0px;
        }

        header {
            background-color: rgb(0, 0, 0);
            width: 100%;
            height: 100px;
            opacity: 0.9;
            text-align: center;
            margin: 0 auto;

        }

        h1 {
            color: white;
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 70px;
            text-shadow: 5px 3px 0px gray;
            text-align: center;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        th{
            color: white;
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 20px;
        }
        .marco {
            border: 1px solid #cccccc;
            padding: 20px;
            font-family: "Arial Black", Gadget, sans-serif;
            color: white;
            background-color: black;
            border-radius: 10px;
            width: 1200px;
            margin-top: 80px;
            opacity: 0.8;
            border: red;
        }

        .x {
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 12px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: #213058;
            font-weight: 10;
            text-align: center;
            background-color: rgb(179, 183, 184);
            border-radius: 3px;
            padding: 7px;
            margin: 5px;
            width: 150px;

        }

        div,
        form,
        table,
        tr,
        td {
            margin: 0 auto;
            text-align: center;

        }

        .td_tabla {
            text-align: justify;
        }

        .a {
            background-color: #8b5f5f75;
            border: 2px solid rgb(0, 0, 0);
            font-size: 20px;
            color: black;
            border-radius: 10px;
            margin: 10px;
        }

        .letra {
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 15px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: black;
            font-weight: 400;
            text-decoration: none;
            font-style: normal;
            font-variant: normal;
            text-transform: none;
            opacity: 1;
        }

        ul,
        ol {
            list-style: none;
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

        .nav li a:hover {
            background-color: black;
        }

        .nav>li {
            float: left;
        }

        img {
            width: 200px;
            text-align: cen;
        }

        .img_p {
            width: 20px;
        }

        .muebles_tablas {
            top: 20px;
            border: 1px solid #cccccc;
            padding: 30px;
            width: 380px;
            margin-right: 50px;
            background-color: white;
            border-radius: 10px;
            font-size: 17px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            opacity: 0.8;
            text-align: justify;
        }

        .tabla {
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

    <table style="text-align:center;" class="marco" width="1500px">
        <tr>
            <th>
                Código
            </th>
            <th>
                Nombre
            </th>
            <th>
                Tipo
            </th>
            <th>
                Almacén
            </th>
            <th>
                Cantidad
            </th>
            <th>
                Precio Unidad
            </th>
            <th>
                Precio Total
            </th>
        </tr>

        <?php

        $conexion = mysqli_connect('localhost', 'root', '', 'creamuebles');
        $sentencia_sql = "SELECT * FROM inventario";
        $resultado = mysqli_query($conexion, $sentencia_sql);
        $cantidad = mysqli_num_rows($resultado);

        if ($cantidad > 0) {
            for ($id = 1; $id <= $cantidad; $id++) {

                $obtener = "SELECT * FROM inventario WHERE id = ?";
                $stmt = $conexion->prepare($obtener);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $datos = $stmt->get_result();
                while ($fila=mysqli_fetch_assoc($datos)) {

                    $codigo = $fila['id'];
                    $nombre = $fila['nombre'];
                    $tipo = $fila['tipo'];
                    $almacen = $fila['almacen'];
                    $cantidad = $fila['cantidad'];
                    $p_unitario = $fila['precio_unitario'];
                    $p_total = $fila['precio_total'];

                    echo "<tr>";
                    echo "<td> $codigo </td>";
                    echo "<td> $nombre </td>";
                    echo "<td> $tipo </td>";
                    echo "<td> $almacen </td>";
                    echo "<td> $cantidad </td>";
                    echo "<td> $p_unitario </td>";
                    echo "<td> $p_total</td>";
                    echo "</tr>";
                }
            }
        }

        mysqli_close($conexion);
        ?>
    </table>

</body>

</html>