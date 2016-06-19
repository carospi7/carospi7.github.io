<?php class usuario
{
	private $id;
	private $nombre;
	private $apellido;
	private $password;
	private $email;
	private $fechaNacimiento;
	private $fechaCreacion;
	private $fechaModificacion;
	private $idImagenPerfil;

	public function __construct($nombre, $apellido, $password, $email, $fechaNacimiento)
	{
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->password = $password;
		$this->email = $email;
		$this->fechaNacimiento = $fechaNacimiento;
	}

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

	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}

	public function getFechaModificacion()
	{
		return $this->fechaModificacion;
	}

	public function getIdImagenPerfil()
	{
		return $this->idImagenPerfil;
	}

	public function setId($id)
	{
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

	public function setFechaCreacion($fechaCreacion)
	{
		$this->fechaCreacion = $fechaCreacion;
	}

	public function setFechaModificacion($fechaModificacion)
	{
		$this->fechaModificacion = $fechaModificacion;
	}

	public function setIdImagenPerfil($idImagenPerfil)
	{
		$this->idImagenPerfil = $idImagenPerfil;
	}

} ?>