<?php

/**
 * Declarar a instancia Usuário
 */

class Livro {

    public $livro_nome;
    public $genero;
    public $editora;
    public $status_livro;
    public $comentario;
    public $usuario_id;

    public function __construct($livro_nome, $genero, $editora,$status_livro, $comentario, $usuario_id) {
        $this->livro_nome = $livro_nome;
        $this->genero = $genero;
        $this->editora = $editora;
        $this->status_livro = $status_livro;
        $this->comentario = $comentario;
        $this->usuario_id = $usuario_id;
    }

    public function getLivroNome()
    { 
        return $this->livro_nome; 
    }

    public function setLivroNome($livro_nome)
    {
        $this->livro_nome = $livro_nome;
    }

    public function getGenero()
    { 
        return $this->genero; 
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }


    public function getEditora()
    { 
        return $this->editora; 
    }

    public function setEditora($editora)
    {
        $this->editora = $editora;
    }

    public function getStatus()
    { 
        return $this->status_livro; 
    }

    public function setStatus($status_livro)
    {
        $this->status_livro = $status_livro;
    }

    public function getComentario()
    { 
        return $this->comentario; 
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }


    public function getUsuarioId()
    { 
        return $this->usuario_id; 
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
}

?>
