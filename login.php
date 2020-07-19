<?php
	$usuario= $_POST["usuario"];
	$contraseña = $_POST["contraseña"]; 

	session_start();

	$conexion=mysqli_connect('localhost','root','','creamuebles');

	if(!empty($usuario) && !empty($contraseña)){
		$sql='SELECT id, usuario, contraseña FROM usuarios WHERE usuario=?';
		$records = $conexion->prepare($sql);
		$records->bind_param('s', $usuario);
		$records->execute();
		$results = $records->get_result()->fetch_assoc();
		$hash=$results['contraseña'];

		if(count($results)> 0 && password_verify($contraseña, $hash)){
			$_SESSION['user_id'] = $results['id'];
			header('Location: pag_inicio.php');

		}else{
			echo "<script> alert('Usuario o contraseña incorrecta');
							window.location='ini_sesion.html'; </script>";
		}
	}else{
		echo "<script> alert('Debes llenar todos los campos');
					window.location='ini_sesion.html'; </script>";
	}

?>