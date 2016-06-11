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

	private function convertirObjetosEnUsuarios(Array $usuariosJson)
	{	
		$objetosEnUsuarios = [];

		foreach ($usuariosJson as $value)
		{	
			$objetosEnUsuarios[] = json_decode($value, 1);
		}

		return $objetosEnUsuarios;
	}

	private function compilarUsuario($usuario)
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

	public function usuarioValido($email, $pass)
	{
		$usuario = $this->buscarUsuarioPorEmail($email);
		
		if ($usuario)
		{	
			if (password_verify($pass, $usuario->getPassword()))
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

	public function setDato($tipo, $dato, $id)
	{
		$id = $id - 1;
		$usuariosJson = $this->traerUsuariosJson();
		$usuarioModificar = json_decode($usuariosJson[$id], 1);
		$usuarioModificar[$tipo] = $dato;
		$usuarioModificar = json_encode($usuarioModificar);
		unset($usuariosJson[$id]);
		$usuariosJson[$id] = $usuarioModificar;
		$insert='';

		$fichero = 'usuarios/usuarios.json';
		$hola = fopen($fichero, 'w+');
		$hola = fwrite($hola, '');

		foreach ($usuariosJson as $key => $value)
		{
			$insert = file_put_contents('usuarios/usuarios.json', $value . PHP_EOL, FILE_APPEND);
		}
	}

} ?>