<?php
session_start();
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
    <link href="css/home.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      logaApp();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
		window.location = "http://<?=$_SERVER['SERVER_NAME']?>/dev/420/site/site/home.php";
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '225836800874912',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

    //Faz o login no PHP através do facebook + email
    function logaApp() {
        FB.api('/me', function(response) {
            var emailFb = response.email;
            var idFb = response.id;
            var nome = response.name;
            if (emailFb && idFb) {
                $.post("./loginfb.php",{ emailFb: emailFb, idFb: idFb, nome:nome }, function( data ) {
                });
            }
        });
    }  
</script>

       
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
        
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="../img/bannerteste1.jpg" alt="Deu fome?">
        </div>
        <div class="item">          
            <img src="../img/bannerteste2.jpg" alt="Deu fome?">
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
