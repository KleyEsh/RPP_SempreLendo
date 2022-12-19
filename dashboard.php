<?php
// Inicia sessões
session_start();

// Verifica se existe os dados da sessão de login
if (!isset($_SESSION["adm"])) {
    // Usuário não logado! Redireciona para a página de login
    header("Location: login.php");
    exit;
}

include_once "php/config/database.php";
include_once "php/model/livro.php";
include_once "php/controller/livro.php";
include_once "php/model/usuario.php";
include_once "php/controller/usuario.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php

    $database = new Database();
    $conn = $database->getConn();

    $livroController = new LivroController();

    $usuarioController = new UsuarioController();
    $emailUsuario = $_SESSION["admEmail"];

    $idUsuario = $usuarioController->getIdUsuario($emailUsuario, $conn);
    $cont = 0;
    foreach ($idUsuario as $valor) {
        if ($cont == 3) {
            $idUsuario = $valor;
        }
        $cont++;
    }

    $livros = $livroController->getLastLivros($idUsuario, $conn);
    $quantLivrosLidos = $livroController->getQuantLido($idUsuario, $conn);
    $quantLivrosParaLer = $livroController->getQuantParaLer($idUsuario,$conn);
    $quantLivrosLendo = $livroController->getQuantLendo($idUsuario,$conn);
    $quantLivrosComentados = $livroController->getQuantComentados($idUsuario, $conn);
    ?>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/oculos.webp" width="50px" alt="Logo" style="margin-bottom: 20px;">
            </a>
        </div>
        <!--Secciones-del-tablero-->
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="active"><span class="las la-home"></span>
                        <span>Início</span></a>
                </li>
                <li>
                    <a href="cadastrarLivros.php"><span class="lab la-phoenix-squadron"></span>
                        <span>Livros</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label> Início
            </h2>

            <div class="user-wrapper">
                <div>
                    <a href="php/authenticate/logout.php">
                        <h4>Lougout</h4>
                    </a>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo $quantLivrosLendo; ?></h1>
                        <span style="margin-top: 15px;">Livros Atuais</span>
                    </div>
                    <div>
                        <span class="las la-search"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $quantLivrosComentados; ?></h1>
                        <span style="margin-top: 15px;">Livros Comentados</span>
                    </div>
                    <div>
                        <span class="las la-comment-dots"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $quantLivrosParaLer; ?></h1>
                        <span style="margin-top: 15px;">Livros Sinalizados</span>
                    </div>
                    <div>
                        <span class="las la-bell"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $quantLivrosLidos; ?></h1>
                        <span style="margin-top: 15px;">Livros Lidos</span>
                    </div>
                    <div>
                        <span class="las la-laugh-beam"></span>
                    </div>
                </div>
            </div>
            <!--Tabla-->
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Livros</h3>
                            <button onclick="window.location.href = 'todosLivros.php'">Mostrar todos <span class="las la-arrow-right"></span></button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Nome</td>
                                            <td>Gênero</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (is_array($livros) || is_object($livros)) {
                                            foreach ($livros as $livro) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $livro->getLivroNome(); ?>
                                            </td>
                                            <td>
                                                <?php echo $livro->getGenero(); ?>
                                            </td>
                                            <td><span class="status green"></span>
                                                <?php echo $livro->getStatus(); ?>
                                            </td>
                                        </tr>
                                        <?php }
                                        } else // If $myList was not an array, then this block is executed. 
                                        {
                                            echo "Unfortunately, an error occured.";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="customers">
                    <div class="card">
                        <div class="card-header">
                            <h3>Indicações</h3>
                            <button onclick="window.location.href = 'books-master-main/'">Mostrar todos <span class="las la-arrow-right">
                                </span></button>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>