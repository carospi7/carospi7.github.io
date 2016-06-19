<?php class repositorioUsuarioSQL extends repositorioUsuario
{
	private $conexion;

	public function __construct($conexion)
	{
		$this->conexion = $conexion;
	}

	// Devuelve true si el email existe en la base de datos
	public function existeEmail($email)
	{
		$usuarioEmail = $this->conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
		
		$usuarioEmail->bindValue(":email", $email, PDO::PARAM_STR);

		$usuarioEmail->execute();

		if ($usuarioEmail->rowCount() === 0)
		{
			return false;
		}

		return true;
	}

	// Devuelve el usuario en base al email consultado
	public function buscarUsuarioEmail($email)
	{	
		$usuario = $this->conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
		
		$usuario->bindValue(":email", $email);

		$usuario->execute();

		if ($usuario->rowCount() === 0)
		{
			return false;
		}

		$usuario = $usuario->fetch(PDO::FETCH_ASSOC);

		return $this->arrayUsuario_objetoUsuario($usuario);
	}

	// Devuelve el usuario en base al ID consultado
	public function buscarUsuarioId($id)
	{	
		$usuario = $this->conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
		
		$usuario->bindValue(":id", $id, PDO::PARAM_INT);

		$usuario->execute();

		if ($usuario->rowCount() === 0)
		{
			return false;
		}

		$usuario = $usuario->fetch(PDO::FETCH_ASSOC);

		return $this->arrayUsuario_objetoUsuario($usuario);
	}

	// Devuelve un objeto usuario a partir de un array usuario
	public function arrayUsuario_objetoUsuario(array $usuario)
	{	
		$id = $usuario['id'];
		$nombre = $usuario['nombre'];
		$apellido = $usuario['apellido'];
		$password = $usuario['password'];
		$email = $usuario['email'];
		$fechaNacimiento = $usuario['fecha_nacimiento'];
		$idImagenPerfil = $usuario['id_usuario_imagen_perfil'];
		$fechaCreacion = $usuario['fecha_creacion'];
		$fechaModificacion = $usuario['fecha_ultima_modificacion'];

		$usuarioObjeto = new usuario ($nombre, $apellido, $password, $email, $fechaNacimiento);
		$usuarioObjeto->setId($id);
		$usuarioObjeto->setIdImagenPerfil($idImagenPerfil);
		$usuarioObjeto->setFechaCreacion($fechaCreacion);
		$usuarioObjeto->setFechaModificacion($fechaModificacion);

		return $usuarioObjeto;
	}

	public function guardarUsuario(usuario $usuario)
	{	
		$id = $usuario->getId();
		$fechaActual = repositorioUsuarioSQL::fechaActual();

		if ($id === null)
		{
			$guardarUsuario = $this->conexion->prepare("INSERT INTO usuarios (nombre, apellido, password, email, fecha_nacimiento, id_usuario_imagen_perfil, fecha_creacion, fecha_ultima_modificacion) VALUES (:nombre, :apellido, :password, :email, :fecha_nacimiento, :id_usuario_imagen_perfil, :fecha_creacion, :fecha_modificacion)");

			$guardarUsuario->bindValue(":fecha_creacion", $fechaActual);
			$guardarUsuario->bindValue(":fecha_modificacion", null);
		}
		else
		{
			$guardarUsuario = $this->conexion->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, password = :password, email = :email, fecha_nacimiento = :fecha_nacimiento, id_usuario_imagen_perfil = :id_usuario_imagen_perfil, fecha_ultima_modificacion = :fechaModificacion");

			$guardarUsuario->bindValue(":id", $usuario->getId());
			$guardarUsuario->bindValue(":fechaModificacion", $fechaActual);
		}

		$guardarUsuario->bindValue(":nombre", $usuario->getNombre());
		$guardarUsuario->bindValue(":apellido", $usuario->getApellido());
		$guardarUsuario->bindValue(":password", $usuario->getPassword());
		$guardarUsuario->bindValue(":email", $usuario->getEmail());
		$guardarUsuario->bindValue(":fecha_nacimiento", $usuario->getFechaNacimiento());
		$guardarUsuario->bindValue(":id_usuario_imagen_perfil", null);

		$guardarUsuario->execute();

		if ($id === null)
		{
			$usuario->setId($this->conexion->lastInsertId());
			$usuario->setFechaCreacion($fechaActual);
		}
	}

	// Devuelve true si la contraseña del usuario existe
	public function usuarioValido($email, $password)
	{
		$usuario = $this->buscarUsuarioEmail($email);
		
		if ($usuario)
		{	
			if (password_verify($password, $usuario->getPassword()))
			{
				return true;
			}
		}
		
		return false;
	}

	// Devuelve la fecha actual
	static function fechaActual()
	{
		$fecha = date_create();
		$fechaFormato = date_format($fecha, 'Y-m-d H:i:s');

		return $fechaFormato;
	}

} ?>