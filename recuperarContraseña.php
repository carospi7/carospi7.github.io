<?php require_once 'soporte.php'; ?>

<html>
	
	<head>
	
	    <title>PETBOOK | Una red social para tu mascota</title>
	    
	    <!-- favicon -->
	    <?php include_once 'html/WEB_favicon.php'; ?>

	    <!-- enlaces CSS -->
	    <?php include_once 'html/CSS_reset.php'; ?>
	  	<?php include_once 'html/CSS_barraNavegacion.php'; ?>
	  	<?php include_once 'html/CSS_footer.php'; ?>
	    <!--link rel='stylesheet' type='text/css' href='css/CSS_sitios/confirmarContraseña.css'-->
	    <!--link rel='stylesheet' type='text/css' href='css/CSS_sitios/confirmarContraseñaResponsive.css'-->

	    <!-- enlaces JS -->
	  	<!--script type='text/javascript' src='js/JavaScript_sitios/confirmarContraseña.js'></script-->
	  	<?php  include_once 'html/JavaScript_barraNavegacion.php'; ?>

	    <!-- codificación texto -->
	    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>	    
	    
	    <!-- pantalla mobile no escalable -->
	    <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
	
  	</head>
	<body>

		<!-- barra de navegación PHP -->
		<?php include_once 'html/WEB_barraNavegacion.php'; ?>

		<h1>¿Olvidaste tu contraseña?</h1>
		<p>Ingresa tu correo electronico y te enviaremos una nueva contraseña.</p>
		<form action='index.php' method='POST' enctype='multipart/form-data'>
			
			<div>
			
				<label for='email'>Email:</label>
				<input id='email' type='text' name='email' placeholder='correo electronico' />
			
			</div>
			<div>
			
				<input id='submit' type='submit' name='submit' value='enviar correo' />
			
			</div>
		
		</form>

		<!-- Pie de pagina (footer) -->
		<?php include_once 'html/WEB_footer.php'; ?>

	</body>

</html>