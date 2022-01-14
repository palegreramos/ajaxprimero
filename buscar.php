<?php 
try {
    $mbd = new PDO('mysql:host=localhost;dbname=nueva', "root", "");
			if (isset($_POST['apellidos'])) $apellidos=$_POST['apellidos'];
			else $apellidos="";
			$sentencia = $mbd->prepare("SELECT * FROM usuarios where apellidos LIKE ?");
			$sentencia->execute(array("%$apellidos%"));	
	if ($sentencia->errorCode()==0) {
		$rows=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		header('Content-type: application/json');
    	echo json_encode($rows);
	}

    $mbd = null;
} catch (PDOException $e) {
		echo json_encode(array(
        'error' => array(
            'msg' => $e->getMessage(),
            'code' => $e->getCode()
        )
    ));
	die();
}
?>