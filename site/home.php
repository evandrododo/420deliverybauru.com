<?php
session_start();
if(isset($_SESSION['idUsuario'])) {
    require_once "../entitymanager.php";
    $Usuario = $entityManager->find('Usuario', $_SESSION['idUsuario']);
    if(!$Usuario){
        header('Location: ./index.php');
        exit();
    }
} else {
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="../img/favicon-16.png" sizes="16x16">
    <link rel="icon" href="../img/favicon-32.png" sizes="32x32">

    <title>420 delivery</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
        <!--
          Below we include the Login Button social plugin. This button uses
          the JavaScript SDK to present a graphical Login button that triggers
          the FB.login() function when clicked.
        -->
        <nav class="navbar navbar-default">
          <div class="container-fluid">

              <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="../img/logo_sem_bordas.png" height="100%" alt="420delivery"/></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Faça seu pedido</a></li>
              </ul>
              
              <ul class="nav navbar-nav navbar-right">
                   <?php
                    //Testa login
                    //Mostra nome e botão de logoff se estiver logado
                    //Mostra form de login e botao do fb se estiver deslogado
                    if(isset($_SESSION['idUsuario'])) {
                        $nome = $_SESSION['nomeUsuario'];
                        $pontos = $_SESSION['pontosUsuario'];
                        ?>
                        <li><span>Olá <?=$nome?>, você tem <?=$pontos?> pontos</span></li>
                        <li><a href="./loginroots.php?logoff=true">Logoff</a></li>
                        
                    <?php
                    }else{
                    ?>
                        <li><a title="Cadastre-se" href="./cadastro.php">Cadastro</a></li>
                        <li>
                        <form action="./loginroots.php" method="post">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha">
                            <input type="submit" value="Login">
                        </form>
                        </li>
                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                        </fb:login-button>

                        <div id="status">
                        </div>
                    <?php
                    }
                    ?>
                
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
    <div class="container">
        <section>
            <?php
            //Testa login
            //Mostra nome e botão de logoff se estiver logado
            //Mostra form de login e botao do fb se estiver deslogado
            $nome = $_SESSION['nomeUsuario'];
            $pontos = $_SESSION['pontosUsuario'];
            ?>
            
            <h2>Alô <?=$nome?></h2>
            
            <span class="container-pontos"><i class="glyphicon glyphicon-star" aria-hidden="true"></i><b class="numero"><?=$pontos?></b> pontos</span>
        </section>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>