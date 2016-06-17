<?php class repositorioSQL extends repositorio {

	private $repositorioUsuario;

	public function getRepositorioUsuario()
	{
		if ($this->repositorioUsuario == null)
		{
			$this->repositorioUsuario = new repositorioUsuarioSQL();
		}

		return $this->repositorioUsuario;
	}
	
} ?>