<?php class usuario {

	private $id;
	private $nombre;
	private $apellido;
	private $password;
	private $email;
	private $fechaNacimiento;
	private $rutaImagen;

	// contructor
	public function __construct( $nombre, $apellido, $password, $email, $fechaNacimiento )
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->password = $password;
		$this->email = $email;
		$this->fechaNacimiento = $fechaNacimiento;
	}

	// funciones GET
	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getFechaNacimiento()
	{
		return $this->fechaNacimiento;
	}

	public function getImagenPerfil()
	{
		return $this->rutaImagen;
	}
	
	// funciones SET
	public function generarId()
	{
		if ( !file_exists('usuarios/usuarios.json') )
		{
			return 1;
		}

		$usuarios = file_get_contents( 'usuarios/usuarios.json' );
		$usuariosArray = explode( PHP_EOL, $usuarios );
		$ultimoUsuario = $usuariosArray[ count($usuariosArray) - 2 ];
		$ultimoUsuarioArray = json_decode( $ultimoUsuario, true );

		$this->id = ( $ultimoUsuarioArray['id'] + 1 );
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}

	public function setPassword($password)
	{
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setFechaNacimiento($fechaNacimiento)
	{
		$this->fechaNacimiento = $fechaNacimiento;
	}

	public function guardarImagen()
	{
		if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)
		{
			$rutaArchivoSubido = $_FILES['imagen']['tmp_name'];
			$nombreImagenSubida = $_FILES['imagen']['name'];
			$extension = pathinfo($nombreImagenSubida, PATHINFO_EXTENSION);
			$rutaArchivoGuardar = 'imagenes/img_perfiles';
			$nombreImagenGuardar = $this->getId() . '.' . $extension;
			
			move_uploaded_file ($rutaArchivoSubido, "$rutaArchivoGuardar/$nombreImagenGuardar");
			$this->rutaImagen="$rutaArchivoGuardar/$nombreImagenGuardar";
		}
	}
} ?>