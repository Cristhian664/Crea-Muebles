<?php
	session_start();

	$conexion=mysqli_connect('localhost','root','','creamuebles');

	if(isset($_SESSION['user_id'])){
		$records = $conexion->prepare('SELECT id, correo, contraseña FROM usuarios WHERE id=? ;');
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
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Crea Muebles</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style>
            body {
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
                width: 200px;

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
            width: 200px;
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
				width: 217px;
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
                text-align: center;
            }

            .img_p {
                width: 20px;
            }

            .muebles_tablas {
                margin-top: 100px;
                border: 1px solid #cccccc;
                padding: 10px;
                width: 30%;
                background-color: black;
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
	<body>
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
        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
			<table class="muebles_tablas">
                <tr>
                    <td>
                        <p class="letra">Código del mueble:</p>
                    </td>
                    <td>
                        <input type="number" name="id" class="x" required >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="file" name="plano" class="x" style="width:400px;" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="button" id="botonmodificar" class="a">Modificar</button>
                    </td>
                </tr>
			</table>
		</form>
		
		<div id="resultado">				
		</div>
		<script type="text/javascript">
			$('#botonmodificar').click(function(){
				var form = new FormData($('#formulario')[0]);
				$.ajax({
					url: 'modificar_mueble.php',
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