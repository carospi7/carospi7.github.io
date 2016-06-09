<?php

	require_once 'soporte.php';
	
	$nombre = '';
	$apellido = '';
	$password = '';
	$passwordConfirm = '';
	$email = '';
	$fechaNacimiento = '';
		
	if ($_POST)
	{
		if ($_POST['submit'] === 'registrarse')
		{	
			// DATOS POST
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$password = $_POST['password'];
			$passwordConfirm = $_POST['passwordConfirm'];
			$email = $_POST['email'];
			$fechaNacimiento = $_POST['fechaNacimiento'];

			// VALIDACIÓN REGISTRO
			$erroresRegistro = $validar->validarRegistroUsuario($nombre, $apellido, $password, $passwordConfirm, $email, $fechaNacimiento);

			// CREAR USUARIO
			if (empty($erroresRegistro))
			{	
				$usuario = new Usuario($nombre, $apellido, $password, $email, $fechaNacimiento);
				$usuario->setPassword($password);
				$usuario->generarId();

				// GUARDAR USUARIO EN ARCHIVO JSON
				$repositorio->getRepositorioUsuario()->guardarUsuario($usuario);
			}
		}
		else if ($_POST['submit'] === 'conectarse')
		{
			// DATOS POST
			$email = $_POST['email'];
			$password = $_POST['password'];

			// VALIDACIÓN INICIO SESION
			$erroresConexion = $validar->validarConectarse($email, $password);

			if (empty($erroresConexion))
			{
				// CONECTARSE
				$usuario = $repositorio->getRepositorioUsuario()->buscarUsuarioPorEmail($email);
				$auth->conectarse($usuario );
				
				// RECORDAR USUARIO
				if (isset($_POST['recordame']))
				{
					$auth->crearCookie($usuario);
				}
			}
		}

} ?>

<html>
	
	<head>
	
	    <title>PETBOOK | Una red social para tu mascota</title>
	    
	    <!-- favicon -->
	    <?php include_once 'html/WEB_favicon.php'; ?>

	    <!-- enlaces CSS -->
	    <?php include_once 'html/CSS_reset.php'; ?>
	  	<?php include_once 'html/CSS_barraNavegacion.php'; ?>
	  	<?php include_once 'html/CSS_footer.php'; ?>
	    <link rel='stylesheet' type='text/css' href='css/CSS_sitios/index.css'>
	    <link rel='stylesheet' type='text/css' href='css/CSS_sitios/indexResponsive.css'>

	    <!-- enlaces JS -->
	  	<script type='text/javascript' src='js/JavaScript_sitios/index.js'></script>
	  	<?php  include_once 'html/JavaScript_barraNavegacion.php'; ?>

	    <!-- codificación texto -->
	    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>	    
	    
	    <!-- pantalla mobile no escalable -->
	    <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
	
  	</head>
	<body>

		<!-- barra de navegación PHP -->
		<?php include_once 'html/WEB_barraNavegacion.php'; ?>

		<section id='seccionBanners'>
		
			<div class='contenidoCentrado'>
		
				<h1>¿Querés encontrar a tu mascota?</h1>
				<form>
		
					<input type='text' name='ubicacion' placeholder='Ej: Belgrano, Buenos Aires'>
					<select name='tipoMascota'>
		
						<option value=''>Mascota</option>
						<option value='perro'>Perro</option>
						<option value='gato'>Gato</option>
		
					</select>
					<select name='encontradosPerdidos'>
		
						<option value=''>Tipo de busqueda</option>
						<option value='perdidos'>Perdidos</option>
						<option value='encontrados'>Encontrados</option>
		
					</select>
					<button>BUSCAR</button>

				</form>
			
			</div>

		</section>

		<section id='seccionesSitio'>
			
			<div class='contenidoCentrado'>
			
				<article name='animalesEnAdopcion'>
				
					<img src='imagenes/img_sitio/mascotas-perdidas.png' class='seccionesImagen' width='276' height='293'>	
					<h2>MASCOTAS PERDIDAS</h2>
					<p>Utilizá nuestro localizador para encontrar tu mascota perdida.</p>

				</article>

				<article name='animalesEnAdopcion'>
				
					<img src='imagenes/img_sitio/adopciones.png' class='seccionesImagen' width='276' height='293'>	
					<h2>MASCOTAS EN ADOPCIÓN</h2>
					<p>Estas mascotas buscan un lugar en tu familia. Compromiso.</p>

				</article>

				<article name='animalesEnAdopcion'>
				
					<img src='imagenes/img_sitio/novedades.png' class='seccionesImagen' width='276' height='293'>	
					<h2>NUESTROS CONSEJOS</h2>
					<p>Leé nuestros consejos y novedades para el cuidado de tu mascota.</p>

				</article>
			
			</div>

		</section>
		
		<section id='seccionNovedades' class='contenidoCentrado'>
			
			<div class='lineaCorta'></div>
			<h2><span>CONSEJOS</span> PARA EL <span>CUIDADO</span> DE TUS ANIMALES</h2>
			<div class='lineaCorta'></div>
			
			<div class='contenedorNoticias'>
				
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				<article class='posteoNoticia'>
			
					<img src='imagenes/img_sitio/imagen-noticia.jpg' width='314' height='314'>
					<div class='overlayNoticia'></div>
					<h3>Las mascotas mejoran la salud de sus dueños: 9 claves</h3>
			
				</article>
				
			</div>

		</section>
		
		<!-- barra navegación conexión -->
		<section id='navegacionContarse'>

			<button id='botonSeccionConectarse'>Conectarase</button>
			<button id='botonSeccionRegistrarse'>Registrarse</button>
		
		</section>



		<!-- Conectarse -->
		<section id='conectarse'>
			
			<h1>Conectarse</h1>

			<form action='index.php' method='POST' enctype='multipart/form-data'>
			
				<?php if (!empty($erroresConexion)) { ?>
			
					<div style='width:300px;background-color:red'>
			
						<ul>
			
							<?php foreach ($erroresConexion as $error) { ?>
			
								<li>
			
									<?php echo $error ?>
			
								</li>
			
							<?php } ?>
			
						</ul>
			
					</div>
			
				<?php } ?>
				<div>
				
					<label for='email'>Email:</label>
					<input id='email' type='text' name='email' placeholder='correo electronico' />
				
				</div>
				<br>
				<div>
				
					<label for='password'>Contraseña:</label>
					<input id='password' type='password' name='password' placeholder='contraseña' />
				
				</div>
				<div>
					<input type='checkbox' name='recordame' /> Recordame
				
				</div>
				<div>
				
					<input id='submit' type='submit' name='submit' value='conectarse' />
				
				</div>
			
			</form>

		</section>

		<!-- Registrarse -->
		<section id='registrarse'>

			<h1>Registrar usuario</h1>
			<form action='index.php' method='POST' enctype='multipart/form-data'>
				
				<?php if (!empty($erroresRegistro)) { ?>
				
					<div style='width:300px;background-color:red'>
						
						<ul>
						
							<?php foreach ($erroresRegistro as $error) { ?>
						
								<li>
		
									<?php echo $error ?>
		
								</li>
						
							<?php } ?>
						
						</ul>
					
					</div>
					
				<?php } ?>
				<div>

					<label for='nombre'>Nombre:</label>
					<input id='nombre' type='text' name='nombre' value='<?php echo $nombre ?>' placeholder='nombre' />

				</div>
				<br>
				<div>

					<label for='apellido'>Apellido:</label>
					<input id='apellido' type='text' name='apellido' value='<?php echo $apellido ?>' placeholder='apellido' />

				</div>
				<br>
				<div>

					<label for='password'>Contraseña:</label>
					<input id='password' type='password' name='password' value='<?php echo $password ?>' placeholder='contraseña' />

				</div>
				<br>
				<div>

					<label for='passwordConfirm'>Confirmar Contraseña:</label>
					<input id='passwordConfirm' type='password' name='passwordConfirm' value='<?php echo $passwordConfirm ?>' placeholder='confirmar contraseña' />

				</div>
				<br>
				<div>

					<label for='email'>Email:</label>
					<input id='email' type='text' name='email' value='<?php echo $email ?>' placeholder='correo electronico' />

				</div>
				<br>
				<div>
					
					<label for='fechaNacimiento'>Fecha de nacimiento:</label>
					<input id='fechaNacimiento' type='text' name='fechaNacimiento' value='<?php echo $fechaNacimiento ?>' placeholder='fecha de nacimiento' />

				</div>
				<br>
				<div>

					<label for='imagen'>Avatar:</label>
					<input id='imagen' name='imagen' type='file'/>

				</div>
				<br>
				<div>

					<input id='submit' type='submit' name='submit' value='registrarse' />

				</div>

			</form>

		</section>

		<!-- Pie de pagina (footer) -->
		<?php include_once 'html/WEB_footer.php'; ?>

	</body>

</html>