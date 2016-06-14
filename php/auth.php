<?php class auth {

    private $repositorioUsuario;

	private static $instance = null;

	public static function getInstancia( repositorioUsuario $repositorioUsuario )
    {
        if ( auth::$instance === null )
        {
            session_start();
            auth::$instance = new auth();
            auth::$instance-> setRepositorioUsuario($repositorioUsuario);
            auth::$instance-> verificarSesion();
        }
        
        return auth::$instance;
    }

    private function setRepositorioUsuario( repositorioUsuario $repositorioUsuario )
    {
        $this->repositorioUsuario = $repositorioUsuario;
    }

    public function verificarSesion()
    {

        if (!isset($_SESSION['usuarioLogueado']))
        {
            if (isset($_COOKIE['usuarioLogueado']))
            {
                $idUsuario = $_COOKIE['usuarioLogueado'];
                $usuario = $this->repositorioUsuario->getUsuarioId($idUsuario);
                $this->conectarse($usuario);
            }
        }
    }

    public function conectarse( $usuario )
    {
        $_SESSION['usuarioLogueado'] = $usuario;
    }

    public function desconectarse()
    {
        session_destroy();
        $this->borrarCookie('usuarioLogueado');
    }

    private function borrarCookie($cookie)
    {
        setcookie($cookie, '', -1);
    }

    public function crearCookie(usuario $usuario)
    {
        setcookie('usuarioLogueado', $usuario->getId(), time() + 60 * 60 * 24 * 3);
    }

    public function estaConectado()
    {
        return isset($_SESSION['usuarioLogueado']);
    }

    public function getUsuarioConectado() {
        return $_SESSION['usuarioLogueado'];
    }
} ?>