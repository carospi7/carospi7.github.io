<?php class repositorioUsuarioJSON extends repositorioUsuario {

public function existeEmail($email)
{
	$usuariosJson = $this->traerUsuariosJson();		
	$objetosEnUsuarios = $this->convertirObjetosEnUsuarios($usuariosJson);
	
	foreach ($objetosEnUsuarios as $key => $usuario)
	{
		$usuarioCreado = $this->compilarUsuario($usuario);

		if ($email == $usuarioCreado->getEmail())
		{
			return true;
		}
	}

	return false;
}

private function traerUsuariosJson()
{
	$archivoUsuarioJson = file_get_contents("usuarios/usuarios.json");
	$usuariosJson = explode(PHP_EOL, $archivoUsuarioJson);
	array_pop($usuariosJson);

	return $usuariosJson;
}

public function convertirObjetosEnUsuarios(array $usuariosJson)
{	
	$objetosEnUsuarios = [];

	foreach ($usuariosJson as $value)
	{	
		$objetosEnUsuarios[] = json_decode($value, 1);
	}

	return $objetosEnUsuarios;
}

public function compilarUsuario($usuario)
{	
	$nombre = $usuario['nombre'];
	$apellido = $usuario['apellido'];
	$password = $usuario['password'];
	$email = $usuario['email'];
	$fechaNacimiento = $usuario['fechaNacimiento'];
	$usuarioCreado = new usuario ($nombre, $apellido, $password, $email, $fechaNacimiento);
	$usuarioCreado->setId($usuario["id"]);

	return $usuarioCreado;
}

// ------------------------------

public function guardarUsuario(usuario $usuario)
{	
	$usuarioArray = $this->descompilarUsuario($usuario);
	$usuarioJSON = json_encode($usuarioArray);
	file_put_contents('usuarios/usuarios.json', $usuarioJSON . PHP_EOL, FILE_APPEND);
}

private function descompilarUsuario(usuario $usuario)
{
	$usuarioArray = [];
	$usuarioArray['id'] = $usuario->getId();
	$usuarioArray['nombre'] = $usuario->getNombre();
	$usuarioArray['apellido'] = $usuario->getApellido();
	$usuarioArray['password'] = $usuario->getPassword();
	$usuarioArray['email'] = $usuario->getEmail();
	$usuarioArray['fechaNacimiento'] = $usuario->getFechaNacimiento();
	$usuarioArray['rutaImagen'] = $usuario->getImagenPerfil();

	return $usuarioArray;
}

private function arrayUsuario(Array $usuarioArray)
{
	$usuario = new usuario($usuarioArray);
	$usuario->setId($usuarioArray["id"]);
}

// ------------------------------

public function usuarioValido($email, $password)
{
	$usuario = $this->buscarUsuarioPorEmail($email);
	
	if ($usuario)
	{	
		if (password_verify($password, $usuario->getPassword()))
		{
			return true;
		}
	}
	
	return false;
}

// BUSCAR USUARIOS POR EMAIL
public function buscarUsuarioPorEmail($email)
{	
	$usuariosJson = $this->traerUsuariosJson();
	$objetosEnUsuarios = $this->convertirObjetosEnUsuarios($usuariosJson);
	
	foreach ($objetosEnUsuarios as $key => $usuario)
	{	
		$objetoUsuario = $this->compilarUsuario($usuario);
		
		if ($email == $objetoUsuario->getEmail())
		{
			return $objetoUsuario;
		}
	}

	return null;
}

// BUSCAR USUARIOS POR NRO. ID
public function getUsuarioId($id)
{	
	$usuariosJson = $this->traerUsuariosJson();
	
	$objetosEnUsuarios = $this->convertirObjetosEnUsuarios($usuariosJson);
	
	foreach ($objetosEnUsuarios as $key => $usuario)
	{	
		$objetoUsuario = $this->compilarUsuario($usuario);
		
		if ($id == $objetoUsuario->getId())
		{
			return $objetoUsuario;
		}
	}

	return null;
}

public function modificarRegistro($id, $nombre, $apellido, $password, $email, $fechaNacimiento)
{
	$ruta = 'usuarios/usuarios.json';
	$archivo = fopen($ruta, 'r+');
	$modificacion = fread($archivo, filesize($ruta));
	$modificacion = explode(PHP_EOL, $modificacion);
	array_pop($modificacion);
	$modificacion = $this->convertirObjetosEnUsuarios($modificacion);
	$modificacion[$id-1]['nombre'] = $nombre;
	$modificacion[$id-1]['apellido'] = $apellido;
	$modificacion[$id-1]['password'] = $password;
	$modificacion[$id-1]['email'] = $email;
	$modificacion[$id-1]['fechaNacimiento'] = $fechaNacimiento;
	$objetos = '';

	foreach ($modificacion as $key => $value)
	{
		var_dump(json_encode($value));
		echo "<br>";
		echo "<br>";
	}
	var_dump($objetos);exit;
	exit;
	$modificacion = json_encode($modificacion);
	var_dump($modificacion);exit;
	file_put_contents($ruta, $modificacion.PHP_EOL);
}

} ?>