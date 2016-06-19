<?php class email {

  private $id;
  private $destinatario;
  private $asunto;
  private $contenido;
  private $password;
  private $fechaCreacion;

  public function __construct (usuario $destinatario, $asunto, $contenido)
  {
    $this->destinatario = $destinatario;   
    $this->asunto = $asunto;
    $this->password = $this->generarContraseña();

    if ($contenido === 'emailContraseña')
    {
      $emailContraseña = '<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif; border:2px solid #2C3942">
                          <tr style="background:#2C3942">
                            <td height="100" align="center" valign="middle"><a href="http://www.petbook.com.ar"><img src="http://www.disenoweb24.com.ar/petbook/logo-blanco.png" width="343" height="85" /></a></td>
                          </tr>
                          <tr>      
                            <td>&nbsp;</td>
                          </tr>
                          <tr>      
                            <td align="center"><h1 style="color:#00e2c5">¡Hola {{nombre}} ! Lamentamos que hayas olvidado tu contraseña :(</h1></td>
                          </tr>
                          <tr>      
                            <td>&nbsp;</td>
                          </tr>
                          <tr>      
                            <td align="center">Ingresa al siguiente link para recuperarla: <a href="{{enlaceWeb}}">Recuperar contraseña</a></td>
                          </tr>
                          <tr>      
                            <td>&nbsp;</td>
                          </tr>
                          <tr style="background:#2C3942">
                            <td align="center" style="padding:10px;"><a href="http://www.petbook.com.ar" style="color:#00e2c5; text-decoration:none;">www.petbook.com.ar</a></td>
                          </tr>
                          </table>';

      $nuevaContraseña = $this->getPassword();
      $emailContraseña = str_replace("{{enlaceWeb}}", 'http://localhost/php/GitHub/seteoPass.php?nuevaContraseña='.$nuevaContraseña, $emailContraseña);
      $emailContraseña = str_replace("{{nombre}}",  $destinatario->getNombre(), $emailContraseña);
      $this->contenido = $emailContraseña;
    }

  }

  public function getDestinatario()
  {
    return $this->destinatario;
  }

  public function getAsunto()
  {
    return $this->asunto;
  }

  public function getContenido()
  {
    return $this->contenido;
  }

  public function getPassword()
  {
    return $this->password;
  }  

  public function generarId()
  {
    if (file_exists('usuarios/registroContraseña.json'))
    {
      $inicial = 1;
      
      return $inicial;
    }
    else
    {
      $emails = file_get_contents('usuarios/registroContraseña.json');
      $emailsArray = explode(PHP_EOL, $emails);
      $ultimoEmail = $emailsArray[ count($emailsArray) - 2 ];
      $ultimoEmailArray = json_decode($ultimoEmail, true);

      return ($ultimoEmailArray['id'] - 1);
    }
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

    $headers = "From: Petbook <'password@petbook.com.ar'>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $nuevaContraseña = $this->guardarRegistroEmail($destinatario, $asunto, $contenido);

    mail ($destinatario->getEmail(), $asunto, $contenido, $headers);
  }

  public function guardarRegistroEmail($destinatario, $asunto, $contenido)
  {
    $prueba = new repositorioUsuarioJSON();
    $id = $destinatario->getId();
    $nuevaContraseña = $this->getPassword();
    $fechaCreacion = $this->generarFecha();

    $registroEmail = $this->descompilarEmail($id, $destinatario, $asunto, $contenido, $nuevaContraseña, $fechaCreacion);
    $emailJSON = json_encode($registroEmail);
    file_put_contents('usuarios/registroContraseña.json', $emailJSON . PHP_EOL, FILE_APPEND);

    return $nuevaContraseña;
  }

  private function descompilarEmail($id, $destinatario, $asunto, $contenido, $contraseña, $fechaCreacion)
  {
    $emailArray = [];
    $emailArray['id'] = $id;
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