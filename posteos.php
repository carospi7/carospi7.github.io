<?php require_once 'soporte.php'; 

if ($_SESSION)
{
	$usuarioSesion = $_SESSION['usuarioLogueado'];	
}
//$id = $usuarioSesion->getid();
//$usuarioModificar = $repositorio->getRepositorioUsuario()->getUsuarioId($id);

?>
<html>
<head>

	<title>hacer posteos</title>

</head>
<body>

	<?php if ($_SESSION)
	{
		echo 	'<form action="posteo.php" method="POST">
				<label>imagenMascota</label>
				<input type="file" name="imagenMascota">
				<label>Comentario</label>
				<textarea name="comentarios"></textarea>				
				<label>ubicacion</label>
				<select name="ubicaciones">
					<option>capital federal</option>
					<option>provincia buenos aires</option>
					<option>otras provincias</option>
				</select>
				<!-- falta dato usuario creador -->
				</form>';
	} ?>

<button>Nuevo post</button>



</body>
</html>