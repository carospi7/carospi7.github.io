<?php require_once 'soporte.php'; 
	
	var_dump($_GET);
	
	$estadoSitio = 'normal';
	$errores = '';

	if (isset($_POST['recuperarContraseña']))
	{
		$destinatario = $_POST['email'];
		$asunto = 'PETBOOK | Recuperar contraseña';
		$contenido = 'emailContraseña';

		$validacion = $validar->validarEmail($destinatario);
	
		if ($validacion === null)
		{
			$existeEmail = $repositorio->getRepositorioUsuario()->existeEmail($destinatario);

			if ($existeEmail === true)
			{
				$email = new email($destinatario, $asunto, $contenido);
				$email->generarContraseña();
				$email->enviarEmail();
				$estadoSitio = 'modificado';
			}
			else
			{
				$errores = 'El email '.$destinatario.' no existe en nuestra base de datos.';
			}
		}
		else
		{
			$errores = $validacion;
		}
	}
?>

<html>
	
	<head>
	
	    <title>PETBOOK | Recuperar Contraseña</title>

  	</head>
	<body>
	
	<?php 

		if ($estadoSitio !== 'modificado')
		{	
			echo '<h1>¿Olvidaste tu contraseña?</h1>
			<p>Ingresa tu correo electronico y te enviaremos una nueva contraseña.</p>
			<form action="recuperarContraseña.php" method="POST" enctype="multipart/form-data">
			<div>
			<label for="email">Email:</label>
			<input id="email" type="text" name="email" placeholder="correo electronico" />
			<aside>'.$errores.'</aside>
			</div>
			<div>
			<input id="recuperarContraseña" type="submit" name="recuperarContraseña" value="enviar correo" />
			</div>';
		}
		else
		{
			echo '<h1>Te hemos enviado un correo.</h1>
			<p>Por favor verifica tu casilla personal de correo.</p>
			<a href="index.php"><button>Volver al inicio</button></a>';
		}

	?>

	</body>

</html>