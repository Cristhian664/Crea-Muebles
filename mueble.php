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
            margin-top: 70px;
            opacity: 0.8;
        }

        .x{
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 12px;
            letter-spacing: 2px;
            word-spacing: 2px;
            color: black;
            font-weight: 10;
            text-align:center;
            background-color:rgb(179, 183, 184);
            border-radius: 3px;
            padding: 7px;
            margin:5px;
            width: 250px;
            opacity: 1;
        }
        
        div,form,table,tr,td{
            margin: 0 auto;
            text-align: center;
        }
        
        .a {
            background-color: white;
            border: 2px solid rgb(0, 0, 0);
            font-size:20px;
            color:black;
            border-radius: 10px;
            margin: 10px;
            opacity: 0.9;
            font-family: "Arial Black", Gadget, sans-serif;
            padding: 5px 5px 5px 5px;
            width: 200px;
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
				width: 234px;
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
        .img_p{
            width: 20px;
        }
        p{
            width: 200px;
            padding: 5px opx 2px 0px;
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
            <a href="materiales.php" style="border: 2px solid gray;width: 320px;">Agregar Material/Herramienta</a>
        </li>
        <li>
            <a href="listar_herramientas.php" style="border: 2px solid gray; width: 300px; ">Materiales y Herramientas</a>
        </li>
        <li>
            <a href="logout.php" style="border: 2px solid gray ; width: 120px;"><img src="logout.png" class="img_p" />   Salir</a>
        </li>
    </ul>
</header>
    <div id="formdiv">
        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
            <table style="background-color: black" class="marco" align="center">
                <tr>
                    <td>
                        <p class="letra">Tipo:</p>
                    </td>
                    
                    <td>
                        <select name="tipo" class="x" required>
                            <option value=""></option>
                            <option value="Mueble para cocina">Mueble para cocina</option>
                            <option value="Mueble para baño">Mueble para baño</option>
                            <option value="Mueble para sala">Mueble para sala</option>
                            <option value="Accesorios">Accesorios</option>
                        </select>
                    </td>
                    <td>
                        <p class="letra">Cédula cliente: </p>
                    </td>
                    <td>
                        <input type="number"  name="cedula" class="x" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="letra">Fecha de inicio:</p>
                    </td>
                    <td>
                        <input type="date" name="f_inicio" required class="x" required/>

                    </td>
                    <td>
                        <p class="letra" >Fecha de entrega:</p>
                    </td>
                    <td>
                        <input type="date" name="f_entrega" required class="x" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="letra" ">Plano:</p>
                    </td>
                    <td>
                        <input type="file" name="plano" class="x" />
                    </td>
                    <td>
                        <p class="letra" >Cotización:</p>
                    </td>
                    <td>
                        <input type="file"  name="cotizacion" class="x" />
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <button id="registrar" type="button" class="a">Registrar</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="resultado">

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#registrar').click(function(){
            var form = new FormData($('#formulario')[0]);
            $.ajax({
                url: 'mb_registro.php',
                type: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function(res){
                    $('#resultado').html(res);
                }
            });
        });
    </script>

</body>
</html>