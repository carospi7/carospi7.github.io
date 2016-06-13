<?php require_once 'soporte.php'; 

$usuarioSesion = $_SESSION['usuarioLogueado'];
$id = $usuarioSesion->getid();
$usuarioModificar = $repositorio->getRepositorioUsuario()->getUsuarioId($id);

if ($_POST)
{
	$nombre = ($_POST['nuevoNombre'] !== '')?($_POST['nuevoNombre']):($usuarioSesion->getNombre());
	$apellido = ($_POST['nuevoApellido'] !== '')?($_POST['nuevoApellido']):($usuarioSesion->getApellido());
	$password = ($_POST['nuevoPassword'] !== '')?($_POST['nuevoPassword']):($usuarioSesion->getPassword());
	$passwordConfirm = ($_POST['nuevoPasswordConfirm'] !== '')?($_POST['nuevoPasswordConfirm']):($usuarioSesion->getPassword());
	$email = ($_POST['nuevoEmail'] !== '')?($_POST['nuevoEmail']):($usuarioSesion->getEmail());		
	$fechaNacimiento = ($_POST['nuevaFechaNacimiento'] !== '')?($_POST['nuevaFechaNacimiento']):($usuarioSesion->getFechaNacimiento());

	$erroresRegistro = $validar->validacionUsuario($nombre, $apellido, $password, $passwordConfirm, $email, $fechaNacimiento);

	if (empty($erroresRegistro))
	{
		$repositorio->getRepositorioUsuario()->modificarRegistro($id, $nombre, $apellido, $password, $email, $fechaNacimiento);
	}

} ?>

<html>
	
	<head>
	
	    <title>PETBOOK | Perfil</title>

	    <script type="text/javascript" src='js/JavaScript_sitios/perfilUsuario.js'></script>
	    <link rel="stylesheet" type="text/css" href="css/perfilUsuario.css">

  	</head>
	<body>
	
	<h1>Este es mi perfil</h1>
	
	<form action="perfilUsuario.php" method="POST">

	<div id="campoNombre">
		<label>Nombre:</label>
		<div class="infoMostrar">
			<?php echo $usuarioModificar->getNombre(); ?>
			<button class="botonModificar">Modificar</button>
		</div>
		<div class="infoModificar">
				<input name="nuevoNombre" type='text' placeholder='Ingresa tu nombre' />
				<button class="botonCancelar">Cancelar</button>
		</div>
	</div>

	<br>
	
	<div id="campoApellido">
		<label>Apellido:</label>
		<div class="infoMostrar">
			<?php echo $usuarioModificar->getApellido(); ?>
			<button class="botonModificar">Modificar</button>
		</div>
		<div class="infoModificar">
				<input name="nuevoApellido" type='text' placeholder='Ingresa tu apellido' />
				<button class="botonCancelar">Cancelar</button>
		</div>
	</div>

	<br>
	
	<div id="campoContraseña">
		<label>Contraseña:</label>
		<div class="infoMostrar">
			<?php echo '••••••••••'; ?>
			<button class="botonModificar">Modificar</button>
		</div>
		<div class="infoModificar">
				<input name="nuevoPassword" type='text' placeholder='Ingresa tu contraseña' />
				<input name="nuevoPasswordConfirm" type='text' placeholder='Confirma tu contraseña' />
				<button class="botonCancelar">Cancelar</button>
		</div>
	</div>

	<br>
	
	<div id="campoEmail">
		<label>Email:</label>
		<div class="infoMostrar">
			<?php echo $usuarioModificar->getEmail(); ?>
			<button class="botonModificar">Modificar</button>
		</div>
		<div class="infoModificar">
				<input name="nuevoEmail" type='text' placeholder='Ingresa tu email' />
				<button class="botonCancelar">Cancelar</button>
		</div>
	</div>

	<br>

	<div id="campoFechaNacimiento">
		<label>Fecha de nacimiento:</label>
		<div class="infoMostrar">
			<?php echo $usuarioModificar->getFechaNacimiento(); ?>
			<button class="botonModificar">Modificar</button>
		</div>
		<div class="infoModificar">
				<input name="nuevaFechaNacimiento" type='text' placeholder='Ingresa tu fecha de nacimiento' />
				<button class="botonCancelar">Cancelar</button>
		</div>
	</div>	
	
	<br />
	
	<button id='guardar'>Guardar Cambios</button><button id='cancelar'>Cancelar</button>

	</form>	

	</body>

</html>



