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
include_once "php/model/usuario.php";
include_once "php/controller/usuario.php";
include_once "php/model/livro.php";
include_once "php/controller/livro.php";
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

    $nomeLivro = $_GET['nomeLivro'];

    $livroController = new LivroController();
    $livros = $livroController->getLivrosByName($nomeLivro, $conn);



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
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray text-center">Comentários</h2>

                    <div class="row">
                        <?php
                        if (is_array($livros) || is_object($livros)) {
                            foreach ($livros as $livro) {
                        ?>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png">
                                    </h4>
                                    <div class="template-demo">
                                        <p>
                                            <?php echo $livro->getComentario(); ?>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="cust-name">
                                                <?php
                                $contId = 0;
                                if ($contId == 0) {
                                    $idUsuarioNoLivro = $livro->getUsuarioId();
                                }
                                $contId++;
                                $contName = 0;
                                $nomeUsuario = $usuarioController->getNameUsuario($idUsuarioNoLivro, $conn);
                                foreach ($nomeUsuario as $valorName) {
                                    if ($contName == 0) {
                                        $nomeUsuario = $valorName;
                                    }
                                    $contName++;
                                }
                                echo $nomeUsuario, " - ", $livro->getLivroNome();
                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo "Unfortunately, an error occured.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        (function () {
            "use strict";

            let inputField = document.getElementById('input');
            let ulField = document.getElementById('suggestions');
            inputField.addEventListener('input', changeAutoComplete);
            ulField.addEventListener('click', selectItem);

            async function changeAutoComplete({ target }) {
                let data = target.value;
                ulField.innerHTML = ``;
                if (data.length) {
                    let autoCompleteValues = await autoComplete(data);
                    autoCompleteValues.forEach(value => { addItem(value); });
                }
            }

            async function fetchAsync() {
                const response = await fetch(
                    `https://www.googleapis.com/books/v1/volumes?q=` + inputField.value
                );
                const data = await response.json();
                return data.items;
            }

            async function autoComplete(inputValue) {

                const mydata = await fetchAsync();

                let option1 = mydata[0].volumeInfo.title;
                console.log(option1);

                let destination = [mydata[0].volumeInfo.title, mydata[1].volumeInfo.title, mydata[2].volumeInfo.title, mydata[3].volumeInfo.title, mydata[4].volumeInfo.title];
                console.log(destination);
                return destination.filter(
                    (value) => value.toLowerCase().includes(inputValue.toLowerCase())
                );
            }

            function addItem(value) {
                ulField.innerHTML = ulField.innerHTML + `<li>${value}</li>`;
            }

            function selectItem({ target }) {
                if (target.tagName === 'LI') {
                    inputField.value = target.textContent;
                    ulField.innerHTML = ``;
                }
            }
        })();
    </script>

</body>

</html>