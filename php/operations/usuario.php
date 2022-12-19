<?php
include_once "../config/database.php";
include_once "../model/usuario.php";
include_once "../controller/usuario.php";

session_start();

/**
 * Cadastrar, deletar e atualizar Usuário
 */

if(isset($_POST['saveUsuario'])) {

    $database = new Database();
    $conn = $database->getConn();

    $usuarioController = new UsuarioController();
  
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    $usuario = new Usuario ($usuario, $email, $senha); /* Declara aqui o usuário */
    $usuarioController->saveUsuario($usuario, $conn); /* Cadastra aqui o usuário */

    $_SESSION['message'] = 'Usuario cadastrado com sucesso';

    header('location: ../../login.php');
    
}
    
?>