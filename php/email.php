<?php class email {

  private $id;
  private $destinatario;
  private $asunto;
  private $contenido;
  private $fechaCreacion;

  public function __construct ($destinatario, $asunto, $contenido)
  {
    $this->destinatario = $destinatario;  
    $this->asunto = $asunto;
    $this->contenido = $contenido;
  }

  private function getDestinatario()
  {
    return $this->destinatario;
  }

  private function getAsunto()
  {
    return $this->asunto;
  }

  public function setContenido($nuevoContenido)
  {
    $this->contenido = $nuevoContenido;
  }

  private function getContenido()
  {
    return $this->contenido;
  }

  public function generarId()
  {
    if (!file_exists('usuarios/registroContraseña.json'))
    {
      return 1;
    }

    $emails = file_get_contents('usuarios/registroContraseña.json');
    $emailsArray = explode(PHP_EOL, $emais);
    $ultimoEmail = $emailsArray[ count($emailsArray) - 2 ];
    $ultimoEmailArray = json_decode($ultimoEmail, true);

    return ($ultimoEmailArray['id'] + 1);
  }

  public function generarContraseña()
  {
    $cadena = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $longitudCadena=strlen($cadena)-1;
    $contraseña = '';

    for ($i=0 ; $i < 15 ; $i++)
    {
        $caracter = rand (0,$longitudCadena);
        $contraseña = $contraseña.substr($cadena,$caracter,1);
    }
    
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
    
    return $contraseña;
  }

  public function generarFecha()
  {
    $fecha = date_create();
    $fechaFormato = date_format($fecha, 'Y/m/d - H:i:s');

    return $fechaFormato;
  }

  public function enviarEmail()
  {
    $destinatario = $this->getDestinatario();
    $asunto = $this->getAsunto();
    $contenido = $this->getContenido();
    mail ($destinatario, $asunto, $contenido);
  }

  public function guardarRegistroEmail($destinatario, $asunto, $contenido)
  {
    $id = $this->generarId();
    $contraseña = $this->generarContraseña();
    $fechaCreacion = $this->generarFecha();

    $registroEmail = $this->descompilarEmail($id, $destinatario, $asunto, $contenido, $contraseña, $fechaCreacion);
    $emailJSON = json_encode($registroEmail);
    file_put_contents('usuarios/registroContraseña.json', $emailJSON . PHP_EOL, FILE_APPEND);
  }

  private function descompilarEmail($id, $destinatario, $asunto, $contenido, $contraseña, $fechaCreacion)
  {
    $emailArray = [];
    $emailArray['destinatario'] = $destinatario;
    $emailArray['asunto'] = $asunto;
    $emailArray['contenido'] = $contenido;
    $emailArray['contraseña'] = $contraseña;
    $emailArray['fechaCreacion'] = $fechaCreacion;

    return $emailArray;
  }

  public function existeEmail($destinatario)
  {
    $usuariosJson = $this->traerUsuariosJson();   
    $objetosEnUsuarios = $this->convertirObjetosEnUsuarios($usuariosJson);
    
    foreach ($objetosEnUsuarios as $key => $usuario)
    {
      $usuarioCreado = $this->compilarUsuario($usuario);

      if ($destinatario == $usuarioCreado->getEmail())
      {
        return true;
      }
    }

    return false;
  }

  private function traerUsuariosJson()
  {
    $archivoUsuarioJson = file_get_contents("usuarios/usuarios.json");
    $usuariosJson = explode(PHP_EOL, $archivoUsuarioJson);
    array_pop($usuariosJson);

    return $usuariosJson;
  }

  private function convertirObjetosEnUsuarios(Array $usuariosJson)
  { 
    $objetosEnUsuarios = [];

    foreach ($usuariosJson as $value)
    { 
      $objetosEnUsuarios[] = json_decode($value, 1);
    }

    return $objetosEnUsuarios;
  }

  private function compilarUsuario($usuario)
  { 
    $nombre = $usuario['nombre'];
    $apellido = $usuario['apellido'];
    $password = $usuario['password'];
    $email = $usuario['email'];
    $fechaNacimiento = $usuario['fechaNacimiento'];
    $usuarioCreado = new usuario ($nombre, $apellido, $password, $email, $fechaNacimiento);
    $usuarioCreado->setId($usuario["id"]);

    return $usuarioCreado;
  }

} ?>