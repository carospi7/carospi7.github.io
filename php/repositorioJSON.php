<?php class repositorioJSON extends repositorio {

	private $repositorioUsuario;

	public function getRepositorioUsuario()
	{
		if ($this->repositorioUsuario == null)
		{
			$this->repositorioUsuario = new repositorioUsuarioJSON();
		}

		return $this->repositorioUsuario;
	}
} ?>