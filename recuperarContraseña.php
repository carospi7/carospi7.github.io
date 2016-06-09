<?php require_once 'soporte.php'; ?>

<html>
	
	<head>
	
		<!-- codificación texto -->
	    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>	 

	    <title>PETBOOK | Una red social para tu mascota</title>
	    
	  	<!-- enlaces CSS y favicon-->
	    <?php include_once 'html/elementos/enlaces_generales.php'; ?>

	    <!-- enlaces JS -->
	  	<!--script type='text/javascript' src='js/JavaScript_sitios/confirmarContraseña.js'></script-->
	  	<?php  include_once 'html/elementos/navegacion_sticky.php'; ?>   
	    
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