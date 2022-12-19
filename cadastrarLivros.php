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
                    <a href="cadastrarLivros.php" class="active"><span class="lab la-phoenix-squadron"></span>
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
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray text-center">Cadastrar Livros</h2>
                    <form action="php/operations/livro.php" method="POST">
                        <div class="row mb-2">
                            <div class="col">
                                <label>Nome</label>
                                <input id="input" type="text" class="form-control" placeholder="Inserir Nome"
                                    name="livro_nome">
                                <ul id="suggestions"></ul>
                            </div>
                            <div class="col">
                                <label>Gênero</label>
                                <select class="form-control" name="genero">
                                    <option selected>Escolha um</option>
                                    <option value="juvenil">Juvenil</option>
                                    <option value="fantasia">Fantasia</option>
                                    <option value="ficcao">Ficção</option>
                                    <option value="romance">Romance</option>
                                    <option value="adulto">Adulto</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Editora</label>
                                <input type="text" class="form-control" placeholder="Inserir Nome" name="editora">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Status</label>
                                <select class="form-control" name="status_livro">
                                    <option selected>Escolha um</option>
                                    <option value="lendo">Lendo</option>
                                    <option value="ler">Para ler</option>
                                    <option value="lido">Lido</option>
                                </select>
                            </div>
                            <input type="hidden" name="usuario_id" value="<?php echo $idUsuario; ?>">
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label>Comentário</label>
                                <textarea name="comentario" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" name="saveLivro" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </form>
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