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
    <title>Parqueadero</title>

    

    <style>
        body{
            background: url(fondo.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            margin-top: 0px;
        }
        header{
				background-color: #00000075;
				width: 100%;
                height: 100px;
				opacity: 0.8;
				text-align: center;
				margin: 0 auto;

			}
        footer{
            position: fixed;
            left: 0px;
            bottom: 0px;
            width: 100%;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            background-color: #00000067;
            font-size: 20px;
            color: black;
            text-align: center;
            padding: 10px;
            opacity: 0.85;
        }
        h1{
            color: rgb(0, 0, 0);
            font-family: "Arial Black", Gadget, sans-serif;
            font-size: 70px;
            text-shadow: 5px 3px 0px rgb(255, 255, 255);
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
            opacity: 1;
        }
        
        div,form,table,tr,td{
            margin: 0 auto;
            text-align: center;
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
			}
			.nav li a{
				font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
				background-color: black;
				font-size: 20px;
				font-weight: 30px;
				color: white;
				width: 310px;
				text-decoration: none;
				padding: 10px 5px;
				display:block;
				text-align: center;
			}
			.nav li a:hover{
				background-color: black;
			}
			.nav > li {
				float: left;
		}
    </style>

</head>
<body background="/fondo/fondo2.jpg">

<header>
    <h1 >Crea Muebles</h1>
</header>
    <div id="formdiv">
        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
            <table style="background-color: #8b5f5f75" class="marco" align="center">                    
           
                <tr>
                    <td>
                        <input type="number" name="codigo" class="x"/>
                    </td>
                </tr>

                                

                
                <table>
                    <tr>
                        <td>
                            <button id="registrar" type="button" class="a">Registrar</button>
                        </td>
                    </tr>
                </table>
                
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
                url: 'modificar_foto.php',
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