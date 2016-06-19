<?php require_once 'soporte.php';

	if ($_GET)
	{
		if ($_GET['nuevaContraseña'])
		{
			$nuevaContraseña = $_GET['nuevaContraseña'];
			$archivo = file_get_contents("usuarios/registroContraseña.json");
			$archivo = explode(PHP_EOL, $archivo);
			array_pop($archivo);

			$miEmail = '';

			foreach ($archivo as $key => $usuario)
			{
				$usuario = json_decode($usuario, 1);

				if ($usuario['contraseña'] === $nuevaContraseña)
				{
					$contraseñaUsuario='';
					$contraseñaUsuarioConfirm='';

					$passwordNew = $usuario['contraseña'];
					$emailNew = $usuario['destinatario'];

					echo 	'<form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
								<label>contraseña</label>
								<input type="password" name="contraseña" value="'.$contraseñaUsuario.'">
								<label>repetir contraseña</label>
								<input type="password" name="contraseñaConfir" value="'.$contraseñaUsuarioConfirm.'">
								<button type="submit">enviar datos</button>
							</form>';
				}
			}
		}
		else
		{
			echo 'andate a cagar!!!';
		}
	}

	if ($_POST)
	{
		if ($_POST['contraseña'])
		{
			$contraseñaUsuario = $_POST['contraseña'];
			$contraseñaUsuarioConfirm = $_POST['contraseñaConfir'];

			if ($contraseñaUsuario === $contraseñaUsuarioConfirm && $contraseñaUsuario !== '')
			{
				$usuarioEmail = $repositorio->getRepositorioUsuario()->buscarUsuarioPorEmail($emailNew);
				$id = $usuarioEmail->getId();
				$password = $contraseñaUsuario;
				$modificar = $repositorio->getRepositorioUsuario()->modificarPassword($id, $password);
			}
			else
			{
				echo "escribiste mal forro!";
			}

			
		}
	}
	
	exit;
?>
