<?php
	$conexion=mysqli_connect('localhost','root','','creamuebles');

    $usuario = $_POST["user"];
    $correo = $_POST["correo"];
	$contraseña = $_POST["password"];
	$confcon = $_POST["cpassword"];

	if(!empty($usuario) && !empty($correo) && !empty($contraseña) && !empty($confcon)){
		if($contraseña == $confcon){
			$pwd = password_hash($contraseña,PASSWORD_BCRYPT);
			$sql = "INSERT INTO usuarios(usuario, correo, contraseña) 
					VALUES (?,?,?)";
			$stmt = $conexion->prepare($sql);
			$stmt->bind_param('sss',$usuario, $correo, $pwd);
			if ($stmt->execute()){
				echo "<script> alert('Se registro correctamente');
						window.location='registrarse.html'; </script>";
			}else{
				echo "<script> alert('Error al registrar');
						window.location='registrarse.html'; </script>";
			}
		}else{
			echo "<script> alert('Error en contraseña');
						window.location='registrarse.html'; </script>";
		}
	}else{
		echo "<script> alert('Debes llenar todos los campos');
						window.location='registrarse.html'; </script>";
	}
	$conexion->close();
?>