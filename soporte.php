<?php

require_once 'php/auth.php';
require_once 'php/repositorio.php';
require_once 'php/repositorioJSON.php';
require_once 'php/repositorioUsuario.php';
require_once 'php/repositorioUsuarioJSON.php';
require_once 'php/validar.php';
require_once 'php/usuario.php';
require_once 'php/email.php';

$tipoRepositorio = 'JSON';
$repositorio = null;

if ($tipoRepositorio == 'JSON')
{
	$repositorio = new repositorioJSON();
}

$auth = auth::getInstancia( $repositorio->getRepositorioUsuario() );
$validar = validar::getInstancia( $repositorio->getRepositorioUsuario() );

?>