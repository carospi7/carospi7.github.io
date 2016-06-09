<?php abstract class repositorioUsuario {

	abstract public function existeEmail( $email );
	abstract public function guardarUsuario( Usuario $miUsuario );

} ?>