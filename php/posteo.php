<?php class posteo {

	private $id;
	private $imagen;
	private $comentario;
	private $ubicacion;
	private $usuarioCreador;

	public function __construct ($imagen, $comentario, $ubicacion, $usuarioCreador)
	{
		$this->imagen = $imagen;
		$this->comentario = $comentario;
		$this->ubicacion = $ubicacion;
		$this->usuarioCreador = $usuarioCreador;
	}

	public function getImagen ()
	{
		return $this->imagen;
	}

	public function getComentario ()
	{
		return $this->comentario;
	}

	public function getUbicacion ()
	{
		return $this->ubicacion;
	}

	public function getUsuarioCreador ()
	{
		return $this->usuarioCreador;
	}

	public function setImagen ($imagen)
	{
		$this->imagen = $imagen;
	}

	public function setComentario ($comentario)
	{
		$this->comentario = $comentario;
	}

	public function setUbicacion ($ubicacion)
	{
		$this->ubicacion = $ubicacion;
	}

	public function setUsuarioCreador ($usuarioCreador)
	{
		$this->usuarioCreador = $usuarioCreador;
	}

} ?>