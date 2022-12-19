<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styleLogin.css">
    <title>Sempre-Lendo, entrar ou inscreva-se</title>
</head>

<body>

    <div class="container">

        <div class="img">
            <img src="assets/images/bed.jpg" alt="BG">
        </div>

        <div class="login-content">
            <form class="" method="post" action="php/authenticate/logar.php">
                <div class="title-container">
                    <h1>Entrar</h1>
                    <h2>Faça novas leituras!</h2>
                    <p>Entre com sua biblioteca pessoal e se junte a nossa jornada.</p>
                </div>

                <div class="login-inner-content">
                    <div class="input-div one">
                        <div class="i">
                            <i class="far fa-user-circle"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="text" name="email" class="input">
                        </div>
                    </div>

                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-eye" onclick="show()"></i>
                        </div>
                        <div class="div">
                            <h5>Senha</h5>
                            <input id="pswrd" type="password" name="senha" class="input">
                        </div>
                    </div>
                    <a href="#">Esqueceu a senha?</a>
                </div>

                <button type="submit" name="login-button" class="btn">Login</button>
                <h5>Não é um membro? <a href="cadastro.html">Crie sua conta</a></h5>
            </form>
        </div>
    </div>





    <script src="assets/js/scriptLogin.js"></script>

</body>

</html>