<?php require_once 'soporte.php'; 

$usuarioSesion = $_SESSION['usuarioLogueado'];

$id = $usuarioSesion->getid();

$usuarioModificar = $repositorio->getRepositorioUsuario()->buscarUsuarioId($id);

$errores = [];

if ($_POST)
{
	switch ($_POST)
	{
		case ($_POST['nuevoNombre'] !== ''):

			$validacion = $validar->validarNombre($_POST['nuevoNombre']);

			if ($validacion === null)
			{
				var_dump('llegamos hasta aca');exit;
				$usuarioSesion->setNombre($_POST['nuevoNombre']);
				$usuarioModificar->setNombre($_POST['nuevoNombre']);
			}
			else
			{
				$errores[] = $validacion;
			}
	}

var_dump($_POST);
echo "<br>";
var_dump($errores);
}
/*
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
	}*/
?>

<html>
	
	<head>
	
	    <title>PETBOOK | Perfil</title>
	    
	    <style type="text/css">

	    	.botonModificar
	    	{
	    		left: 400px;
	    		position: absolute;
	    	}

			.botonCancelar
	    	{
	    		left: 400px;
	    		position: absolute;
	    	}

	    	.botonAceptar
	    	{
	    		left: 475px;
	    		position: absolute;
	    	}

	    </style>

  	</head>
	<body>
	
	<h1>Este es mi perfil</h1>
		
		<!-- Informacion Nombre -->	
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Nombre: <?php echo $usuarioModificar->getNombre(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>
			
			<div class="informacionUsuarioModificar">
				<label>Nombre: <input name="nuevoNombre" type='text' placeholder='Ingresa tu nombre' /></label>			
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>
		
		<br />

		<!-- Informacion Apellido -->	
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Apellido: <?php echo $usuarioModificar->getApellido(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Apellido: <input name="nuevoApellido" type='text' placeholder='Ingresa tu apellido' /></label>	
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>
		
		<br />
			
		<!-- Informacion Password -->
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Contraseña: ********</label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Contraseña: <input name="nuevoPassword" type='text' placeholder='Ingresa tu contraseña' /></label>
				<input name="nuevoPasswordConfirm" type='text' placeholder='Confirma tu contraseña' />
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

		<br />
		
		<!-- Informacion Email -->			
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Email: <?php echo $usuarioModificar->getEmail(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
					<label>Email: <input name="nuevoEmail" type='text' placeholder='Ingresa tu email' /></label>
					<button class="botonCancelar">Cancelar</button>
					<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

		<br />

		<!-- Informacion Fecha de nacimiento -->
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Fecha de nacimiento: <?php echo $usuarioModificar->getFechaNacimiento(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Fecha de nacimiento: <input name="nuevaFechaNacimiento" type='text' placeholder='Ingresa tu fecha de nacimiento' /></label>
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

	</body>

</html>



