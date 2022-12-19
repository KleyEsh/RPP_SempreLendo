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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script>
        function enviar_formularioDeletar() {
            document.formulario1.submit();
        } 
    </script>
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

    $livros = $livroController->getLivros($idUsuario, $conn);

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
                    <a href="dashboard.php"><span class="las la-home"></span>
                        <span>Início</span></a>
                </li>
                <li>
                    <a href="" class="active"><span class="lab la-phoenix-squadron"></span>
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
            <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">
                <!-- Row -->
                <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray text-center">Todos os Livros</h2>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Editora</th>
                                <th>Status</th>
                                <th>Ações</th>
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
                                <td>
                                    <?php echo $livro->getEditora(); ?>
                                </td>
                                <td>
                                    <?php echo $livro->getStatus(); ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" name='action-documento'
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form action='php/operations/livro.php' method='post' name='formulario1'>
                                                <a class="dropdown-item" href="atualizarLivros.php?nomeLivro=<?php echo $livro->getLivroNome(); ?>&idUsuario=<?php echo $idUsuario; ?>">
                                                    Atualizar
                                                </a>
                                            </form>
                                            <form action='php/operations/livro.php' method='post' name='formulario1'>
                                                <a class="dropdown-item" href='javascript:enviar_formularioDeletar()'>
                                                    <input type="hidden" name="idUsuario"
                                                        value="<?php echo $idUsuario; ?>">
                                                    <button style="border:none; background-color: transparent;"
                                                        name='deleteLivro'
                                                        value='<?php echo $livro->getLivroNome(); ?>'>Deletar</button>
                                                </a>
                                            </form>
                                            <a class="dropdown-item"
                                                href="todosComentarios.php?nomeLivro=<?php echo $livro->getLivroNome(); ?>">Ver
                                                Comentários</a>
                                        </div>
                                </td>
                            </tr>
                            <?php }
                            } else // If $myList was not an array, then this block is executed. 
                            {
                                echo "Unfortunately, an error occured.";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Gênero</th>
                                <th>Editora</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</body>

</html>