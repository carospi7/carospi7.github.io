<?php class validar
{
    private $repositorioUsuario;
    private static $instancia = null;

    public static function getInstancia(repositorioUsuario $repositorioUsuario)
    {
        if (validar::$instancia === null)
        {
            validar::$instancia = new validar();
            validar::$instancia->setRepositorioUsuario($repositorioUsuario);
        }

        return validar::$instancia;
    }

    private function setRepositorioUsuario(repositorioUsuario $repositorioUsuario)
    {
        $this->repositorioUsuario = $repositorioUsuario;
    }

    // Validación registro
    public function validacionUsuario($nombre, $apellido, $password, $passwordConfirm, $email, $fechaNacimiento)
    {
        $errores = [];
        $errores['erroresNombre']           = $this->validarNombre($nombre);
        $errores['erroresAPellido']         = $this->validarApellido($apellido);
        $errores['erroresPassword']         = $this->validarPassword($password);
        $errores['erroresPasswordConfirm']  = $this->validarPasswordConfirm($password, $passwordConfirm);
        $errores['erroresEmail']            = $this->validarEmail($email);
        $errores['erroresFechaNacimiento']  = $this->validarFechaNacimiento($fechaNacimiento);

        foreach ($errores as $clave => $valor)
        {
            if ($valor === NULL)
            {
                unset($errores[$clave]);
            }
        }

        return $errores;
    }

     // Validación conectarse
    public function validarConectarse($email, $password)
    {
        $errores = [];

        if ($this->repositorioUsuario->existeEmail($email) === true)
        {
            if ($this->repositorioUsuario->usuarioValido($email, $password))
            {
                $errores = [];
            }
            else
            {
                $errores[] = 'El usuario ingresado no es valido';
            }

        }
        else
        {
            $errores[] = 'Debes ingresar el email';
        }

        return $errores;
    }

    // Validaciones
    public function validarNombre($nombre)
    {
        $expresionNombre = '[a-zA-Z]';
        
        if ($nombre == '')
        {   
            return 'Debe ingresar el nombre.';
        }
        else
        {
            if (strlen($nombre) > 1 && eregi($expresionNombre, $nombre))
            {
                return null;
            }
            else
            {
                return 'Debe ingresar un nombre valido.';       
            }
        }  
    }

    public function validarApellido($apellido)
    {
        $expresionApellido = '[a-zA-Z]';
        
        if ($apellido == '')
        {   
            return 'Debe ingresar el apellido.';
        }
        else
        {
            if (strlen($apellido) > 1 && eregi($expresionApellido, $apellido))
            {
                return null;
            }
            else
            {
                return 'Debe ingresar un apellido valido.';
            }
        }  
    }

    public function validarPassword($password)
    {
        $expresionContraseña = '.{4,}';

        if ($password == '')
        {
            return 'Debe ingresar el password';
        }
        else
        {   
            if (strlen($password) > 3)
            {
                if (eregi($expresionContraseña, $password))
                {
                    return null;
                }
                else
                {
                    return 'Verificar que el password no contenga caracteres especiales.';
                }
            }
            else
            {
                return 'El password debe contener al menos 4 caracteres.';
            }
        }
    }        

    public function validarPasswordConfirm($password, $passwordConfirm)    
    {   
        if ($passwordConfirm == '')
        {
            return 'Debe confirmar el password';
        }
        else
        {
            if ($password === $passwordConfirm)
            {
                return null;
            }
            else
            {
                return 'La confirmacion del password no coincide.';
            }
        }            
    }   

    public function validarEmail($email)
    {
        if ($email == '')
        {
            return 'Debe ingresar un email';
        }
        else
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                return null;
            }
            else
            {
                return 'Debe ingresar un email valido';
            }
        }
    }    

    public function validarFechaNacimiento($fechaNacimiento)
    {
        //$expresionFechaNacimiento = '(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}';
        $expresionFechaNacimiento = '.{10}';
        
        if ($fechaNacimiento == '')
        {
            return 'Debe ingresar su fecha de nacimiento';
        }
        else
        {
            if (eregi($expresionFechaNacimiento, $fechaNacimiento))
            {
                return null;
            }
            else
            {
                return 'Debe ingresar su fecha de nacimiento respetando el formato dd/mm/aaaa';
            }
        }
    }

} ?>