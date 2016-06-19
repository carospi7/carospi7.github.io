<?php

	require_once 'php/auth.php';
	require_once 'php/email.php';
	require_once 'php/posteo.php';
	require_once 'php/repositorio.php';
	require_once 'php/repositorioSQL.php';
	require_once 'php/repositorioUsuario.php';
	require_once 'php/repositorioUsuarioSQL.php';
	require_once 'php/usuario.php';
	require_once 'php/validar.php';
	
	$tipoRepositorio = 'SQL';
	$repositorio = null;

	if ($tipoRepositorio == 'JSON')
	{
		$repositorio = new repositorioJSON();
	}
	else
	{
		$repositorio = new repositorioSQL();
	}

	$auth = auth::getInstancia($repositorio->getRepositorioUsuario());
	$validar = validar::getInstancia($repositorio->getRepositorioUsuario());

?>