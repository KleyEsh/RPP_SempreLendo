<?php

/**
 * Declarar a instancia Usuário
 */

class Usuario {

    public $usuario;
    public $email;
    public $senha;

    public function __construct($usuario, $email, $senha) {
        $this->usuario = $usuario;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getUsuario()
    { 
        return $this->usuario; 
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getEmail()
    { 
        return $this->email; 
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getSenha()
    { 
        return $this->senha; 
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}

?>
