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
		}else{
            $id = $_POST["id"];
            $plano = "imagenes/" . basename($_FILES['plano']['name']);
			
            $sql = "SELECT * FROM muebles WHERE id=$id;";
            $resultado= mysqli_query($conexion, $sql);
            $total = mysqli_num_rows($resultado);

            if($total==0){
                echo "<script> alert('No existe un mueble con ese código');
                        window.location='modificar.php'; </script>";
            }else{
                $sql_mod = "UPDATE muebles SET foto_final=? WHERE id=?";
                $stmt = $conexion->prepare($sql_mod);
                $stmt->bind_param('si',$plano,$id);
                if ($stmt->execute()){
                    echo "<script> alert('Se modifico el mueble correctamente');
                            window.location='modificar.php'; </script>";
                    if (move_uploaded_file($_FILES['plano']['tmp_name'], $plano)) {
                    }  
                }else{
                    echo "<script> alert('Error al modificar el estado');
                            window.location='modificar.php'; </script>";
                }
			}

		}
	}else{
		echo "<script> alert('Debes ingresar');
						window.location='index.html'; </script>";
	}
	mysqli_close($conexion);
?>