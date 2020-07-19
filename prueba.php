<?php
	session_start();

	$conexion=mysqli_connect('localhost','root19','hdCXFi2dUjm9e3FF','parqueadero');

	if(isset($_SESSION['user_id'])){
		$records = $conexion->prepare('SELECT id, correo, contraseña FROM usuarios WHERE id=? ;');
		$records->bind_param('i',$_SESSION['user_id']);
		$records->execute();
		$results = $records->get_result()->fetch_assoc();

		if(count($results)==0){
			echo "<script> alert('Debes Registrarte');
						window.location='signup.html'; </script>";
		}
	}else{
		echo "<script> alert('Debes ingresar');
						window.location='index.html'; </script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Lista de Vehiculos</title>
		<style>
			body{
				background: url(fondo.jpg);
                background-size: 2000px;
                margin: 0px auto;
			}
			header{
				background-color: #213058;
				width: 100%;
				opacity: 0.8;
				text-align: center;
				margin: 0 auto;
				padding-top: 20px;
				padding-bottom: 20px;
			}
			h1{
				text-align: center;
                font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                font-size: 80px;
                letter-spacing: -2px;
				padding: 30px 0px 0px 0px;
                color: white;
                font-weight: 700;
                text-decoration: none solid rgb(68, 68, 68);
                font-style: normal;
                font-variant: normal;
                text-transform: uppercase;
                text-shadow: 2px 2px 0 #222121, 4px 4px 0 #1d1c1c;
				display: inline;
			}
			footer{
				left: 0px;
				bottom: 0px;
				width: 100%;
				font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
				background-color: #213058;
				font-size: 20px;
				color: #ffffff;
				text-align: center;
				padding: 10px;
				opacity: 0.85;
				margin-top: 50px;
			}
			table,tr,td,img{
				margin: 0 auto;
				text-align: center;
			}
			.tabla{
				position: relative;
				top: 20px;
				width: 1500px;
				height: 200px;
				border: 1px solid #cccccc;
				padding: 20px;
				background-color: #ffffff;
				border-radius: 70px;
				font-size: 17px;
				font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
			}
			th{
				text-align: center;
				font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
				font-size: 17px;
				letter-spacing: 3px;
				color: red;
				font-weight: 700;
				text-decoration: none solid rgb(68, 68, 68);
				font-style: normal;
				font-variant: normal;
				padding: 10px;
			}
			img{
				width: 200px;
				height: 100px;
			}
			ul, ol{
				list-style:none;
			}
			#logo{
				width:150px;
				height:150px;
				background: url(logo.png)no-repeat;
				float: right;
				margin-right: 20px;
			}
			.nav li a{
				font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
				background-color: #536699;
				font-size: 25px;
				font-weight: 30px;
				color: white;
				width: 340px;
				text-decoration: none;
				padding: 10px 5px;
				display:block;
				text-align: center;
			}
			.nav li a:hover{
				background-color: #213058;
			}
			.nav > li {
				float: left;
			}

		</style>
	</head>
	<body>
		<header>
			<h1 >Central Parking</h1>
			<div id=logo></div>
			<br><br><br>
			<ul class="nav">
				<li>
					<a href="formularioparqueadero.php">Registrar Vehiculo</a>
				</li>
				<li>
					<a href="listaparqueadero.php">Listar Vehiculos</a>
				</li>
				<li>
					<a href="buscarparqueadero.php">Buscar Vehiculo</a>
				</li>
				<li>
					<a href="cuenta.php">Cuenta</a>
				</li>
				<li>
					<a href="logout.php">Salir</a>
				</li>
			</ul>
		</header>
		<table class="tabla">
			<tr>
				<th>
					PLACA
				</th>
				<th>
					NOMBRES PROPIETARIO
				</th>
				<th>
					APELLIDOS PROPIETARIO
				</th>
				<th>
					FECHA DE INGRESO
				</th>
				<th>
					HORA DE INGRESO
				</th>
				<th>
					TIPO DE VEHICULO
				</th>
				<th>
					COLOR DE VEHICULO
				</th>
				<th>
					FOTOGRAFÍA DEL VEHICULO
				</th>
			</tr>
		<?php
			$conexion=mysqli_connect('localhost','root','','creamuebles');
			
			$sql = "SELECT * FROM inventario;";
			$resultado= mysqli_query($conexion, $sql);
			$total = mysqli_num_rows($resultado);
			
			if($cantidad > 0){
				for($id = 1; $id <= $cantidad; $id++){
	
					$obtener = "SELECT * FROM inventario WHERE id = '$id'";
					$informacion = mysqli_query($conexion, $obtener);
					$fila = mysqli_fetch_assoc($informacion);
					
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
			
			mysqli_close($conexion);
		?>

		?>
		</table>
		<footer>
			Universidad de Nariño<br>
			2020
		</footer>
	</body>
</html>