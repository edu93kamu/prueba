<?php
	include('config.php');
	$con = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_BD);
	$sql = "SELECT * FROM usuarios";
	$resul = $con->query($sql);
	$filas=false;
	while($fila = $resul->fetch_assoc()){
		$filas[] = $fila;
	}
?>
<html>
	<head>
		<title>hola</title>
	</head>
	<body>
		<table>
			<th>
				<td>nombre</td><td>rol</td>
			</th>
			<?php
				foreach($filas as $usu){
			?>
			<th>
				<td><?php echo $usu['nombre'];?></td><td><?php echo $usu['rol'];?></td>
			</th>
			<?php
				}
			?>
	</body>
</html>