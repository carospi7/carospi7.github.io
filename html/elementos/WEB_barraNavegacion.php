<?php

	// DATOS DEFAULT
	$estadoSesion = 'CONCETARSE';
	$idBoton = 'botonConectar';
	$redireccionSitio = '#';

	// VERIFICAR CONEXÓN
	if ($auth->estaConectado())
	{
		$usuarioConectado = $auth->getUsuarioConectado();
		$usuarioNombre = $usuarioConectado->getNombre();
		$usuarioApellido  = $usuarioConectado->getApellido();
	
		// DATOS USUARIO CONECTADO
		$estadoSesion = 'DESCONECTARSE';
		$idBoton = 'botonDesconectar';
		$redireccionSitio = 'html/cerrarSesion.php';
	}

	// BARRA DE NAVEGACIÓN
	echo "<header>
	<div class='contenidoCentrado'>
	<div id='logoPrincipal'>
	<img src='imagenes/img_sitio/logo.png' class='imagenLogo' width='272' height='68'>
	<div class='logoBlanco'>
	<img src='imagenes/img_sitio/logo-blanco.png' width='121' height='30'>
	</div>
	</div>
	<nav id='menuPrincipal'>
	<ul>
	<li><a href='#' class='seleccionado'>INICIO</a></li>
	<li><a href='#'>PERDIDOS</a></li>
	<li><a href='#'>ADOPCIONES</a></li>
	<li><a href='#'>BLOG</a></li>
	<li><a href='".$redireccionSitio."'><button id='".$idBoton."'>".$estadoSesion."</button></a></li>";
	
	if ($estadoSesion === 'DESCONECTARSE')
	{
		echo "<li><a href='perfilUsuario.php'>Config</a></li>
		<li>".$_SESSION['usuarioLogueado']->getNombre()." ".$_SESSION['usuarioLogueado']->getApellido()."</li>";
	}

	echo "</ul>	
	</nav>
	</div>
	</header>
	<div id='blackLayer'></div>";

?>