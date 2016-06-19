<?php class repositorioSQL extends repositorio
{
	private $repositorioUsuario;
	private $conexion;

	public function __construct()
	{
		$this->conexion = new PDO('mysql:host=localhost;dbname=PetBook;charset=utf8mb4', 'root', 'root');
		// Acá deberíamos tener el user y pass en un archivo de texto QUE NO SE VERSIONA, NO SE SUBE A NINGUN LADO Y NADIE TIENE
	}

	public function getRepositorioUsuario()
	{
		if ($this->repositorioUsuario == null)
		{
			$this->repositorioUsuario = new repositorioUsuarioSQL($this->conexion);
		}

		return $this->repositorioUsuario;
	}

	public function startTransaction()
	{
		$this->conexion->beginTransaction();
	}

	public function commitTransaction()
	{
		$this->conexion->commit();
	}

	public function rollBack() 
	{
		$this->conexion->rollBack();
	}
	
} ?>