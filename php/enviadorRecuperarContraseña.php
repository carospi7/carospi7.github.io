<?php class enviadorRecuperarContraseña extends enviador {

  private $destinatario;
  private $asunto;
  private $contenido;

  public function __construct ($destinatario, $asunto, $contenido)
  {
    $this->destinatario = $destinatario;
    $this->asunto = $asunto;
    $this->contenido = $contenido;
  }

  public function setDestinatario($destinatario)
  {
    $this->destinatario = $destinatario;
  }

  public function setAsunto($asunto)
  {
    $this->asunto = $asunto;
  }

  public function setContenido()
  {
    $this->contenido = $contenido;
  }

  public function getDestinatario()
  {
    $this->destinatario;
  }

  public function getAsunto()
  {
    $this->asunto;
  }

  public function getContenido()
  {
    $this->contenido;
  }

}

// DESTINATARIOS
$destinatario1 = 'frammlopez@gmail.com';
$destinatario2 = '';
$destinatario3 = '';
$destinatario4 = '';
$destinatario5 = '';

$destinatarios = $destinatario1;
//$destinatarios = $destinatario1.'; '.$destinatario2.'; '.$destinatario3.'; '.$destinatario4.'; '.$destinatario5.'; '.;

// ASUNTO
$asunto = 'Esto es un correo de prueba';

// MENSAJE
$mensaje = '
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
  <p>¡Estos son los cumpleaños para Agosto!</p>
  <table>
    <tr>
      <th>Quien</th><th>Día</th><th>Mes</th><th>Año</th>
    </tr>
    <tr>
      <td>Joe</td><td>3</td><td>Agosto</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17</td><td>Agosto</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
mail($para, $título, $mensaje, $cabeceras);
?>