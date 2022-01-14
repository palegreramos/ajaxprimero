<?php 
if ($_POST) {
	try {	
	  $mbd = new PDO('mysql:host=localhost;dbname=nueva', "root", "");
  		$sentencia = $mbd->prepare("INSERT INTO usuarios (nombre, apellidos) VALUES (:nombre, :apellidos)");
		$sentencia->bindParam(':nombre', $nombre);
		$sentencia->bindParam(':apellidos', $apellidos);

		$nombre=$_POST['nombre'];
		$apellidos=$_POST['apellidos'];
		$sentencia->execute();
		$error=$sentencia->errorInfo();
		echo json_encode(array(
			'error'=> array(
				'sqlstate'=>current($error),
				'code'=>next($error),
				'msg'=>next($error))));
		$mbd = null;
} catch (PDOException $e) {
		echo json_encode(array(
        'error' => array(
            'msg' => $e->getMessage(),
            'code' => $e->getCode()
        )
    ));
}

} 
?>