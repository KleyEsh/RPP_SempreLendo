<?php
include_once "../config/database.php";
include_once "../model/usuario.php";
include_once "../controller/usuario.php";

session_start();

if (isset($_SESSION["adm"])) {
    header("location: ../../dashboard.php");
}

if(isset($_POST["login-button"])) {

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";


    if(!empty($email) && !empty($senha)) {
        $database = new Database();
        $conn = $database->getConn();
        
        if($conn != null) {

            $usuario = new Usuario(null, $email, $senha);

            $usuarioController = new UsuarioController();

            $usuario = $usuarioController->getUsuario($usuario, $conn);

            if($usuario) {
                $_SESSION["adm"] = true;
                $_SESSION["admName"] = $usuario;
                $_SESSION["admEmail"] = $email;
                header("location: ../../dashboard.php");
            } else {
                $_SESSION["login_msg"] = "Usuário/Senha incorretos.";
                header("location: ../../index.php");
            }
        }
    } else {
        $_SESSION["login_msg"] = "Dados não preenchidos. Preencha os dados e tente novamente.";
        header("location: ../../login.php");
    }
    
}

?>