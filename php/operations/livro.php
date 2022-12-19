<?php
include_once "../config/database.php";
include_once "../model/livro.php";
include_once "../controller/livro.php";

session_start();

/**
 * Cadastrar, deletar e atualizar Usuário
 */

if(isset($_POST['saveLivro'])) {

    $database = new Database();
    $conn = $database->getConn();

    $livroController = new livroController();
  
    $livro_nome = isset($_POST['livro_nome']) ? $_POST['livro_nome'] : '';
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    $editora = isset($_POST['editora']) ? $_POST['editora'] : '';
    $status_livro = isset($_POST['status_livro']) ? $_POST['status_livro'] : '';
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';
    $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';


    $livro = new Livro ($livro_nome, $genero, $editora,$status_livro, $comentario, $usuario_id); /* Declara aqui o livro */
    $livroController->saveLivro($livro, $conn); /* Cadastra aqui o livro */

    $_SESSION['message'] = 'Livro cadastrado com sucesso';

    header('location: ../../cadastrarLivros.php');
    
} elseif(isset($_POST['deleteLivro'])) {

    $database = new Database();
    $conn = $database->getConn();

    $nome = isset($_POST['deleteLivro']) ? $_POST['deleteLivro'] : '';
    $usuario_id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '';


    if(empty($nome)) {
        $message = "Desculpe, aconteceu um erro com o seu envio.";
        $_SESSION['message'] = $message;
        header('location: ../../todosLivros.php');
        exit;
    }

    $livroController = new livroController();
    $livro = new Livro ($nome, null, null, null, null, $usuario_id);
    $livroController->deleteLivro($livro, $conn);

    header('location: ../../todosLivros.php');
} elseif(isset($_POST['updateLivro'])) {

    $database = new Database();
    $conn = $database->getConn();

    $livro_nome = isset($_POST['livro_nome']) ? $_POST['livro_nome'] : '';
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    $editora = isset($_POST['editora']) ? $_POST['editora'] : '';
    $status_livro = isset($_POST['status_livro']) ? $_POST['status_livro'] : '';
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';
    $usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : '';

    $livroController = new livroController();
    $livro = new Livro ($livro_nome, $genero, $editora,$status_livro, $comentario, $usuario_id); /* Declara aqui o livro */
    $livroController->updateLivro($livro, $conn, $usuario_id, $livro_nome); /* Atualiza aqui o livro */

    $_SESSION['message'] = 'Livro cadastrado com sucesso';


    header('location: ../../todosLivros.php');
}
    
?>