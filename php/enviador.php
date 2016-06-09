<?php class enviador {

  private $destinatario;
  private $asunto;
  private $contenido;

  public function __construct ($destinatario, $asunto, $contenido)
  {
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

?>