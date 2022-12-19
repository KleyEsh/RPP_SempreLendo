<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styleLogin.css">
    <title>Sempre-Lendo, cadastre-se agora</title>
</head>

<body>

    <div class="container">

        <div class="img">
            <img src="assets/images/12.jpg" alt="BG">
        </div>

        <div class="login-content">

            <form class="" action="php/operations/usuario.php" method="POST">

                <div class="title-container">
                    <h1>Criar uma conta</h1>
                    <h2>Faça um novo mundo!</h2>
                    <p>Entre com sua biblioteca pessoal e se junte a nossa jornada.</p>
                </div>


                <div class="cadastro-inner-content">

                    <div class="input-div one">
                        <div class="i">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <div class="div">
                            <label for="name"></label>
                            <h5>Nome de usuário</h5>
                            <input type="text" id="name" name="name" class="input" required value=""> <br>
                        </div>
                    </div>
                    
                    <div class="input-div two">
                        <div class="i">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <div class="div">
                            <label for="email"></label>
                            <h5>Email</h5>
                            <input type="text" id="email" name="email" class="input">
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-eye" onclick="show()"></i>
                        </div>
                        <div class="div">
                            <label for="password"></label>
                            <h5>Senha</h5>
                            <input id="password" type="password" name="senha" class="input">
                        </div>
                    </div>
                    <!--
                    <div class="input-div passConfirm">
                        <div class="i">
                            <i class="fas fa-eye" onclick="show()"></i>
                        </div>
                        
                        <div class="div">
                            <label for="password_confirmation"></label>
                            <h5>Confirmar senha</h5>
                            <input id="password" type="password_confirmation" name="password_confirmation" class="input">
                        </div>
                        
                    </div>
                    -->
                    <div>

                </div>
                <button type="submit" name="saveUsuario" class="btn">Registrar</button>
                <h5>Já é um membro? <a href="login.php">Entre na sua conta</a></h5>

            </form>
        </div>
    </div>

    <script src="assets/js/scriptLogin.js"></script>

</body>

</html>