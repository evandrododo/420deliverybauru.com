<?php
$acao = $_REQUEST['acao'];  
if ($acao == "insert") {
    require_once "../entitymanager.php";

    $nomeCompleto = $_REQUEST['nomeCompleto'];  
    $email = $_REQUEST['email']; 
    $senha = $_REQUEST['senha']; 
    $senha = crypt($senha);
    /*
    Todo:
    - Testar se email ja está cadastrado
    */
    $Usuario = new Usuario();
    $Usuario->setNomeCompleto($nomeCompleto);
    $Usuario->setEmail($email);
    $Usuario->setSenha($senha);


    $entityManager->persist($Usuario); //persistencia (caso dê merda ele mantém os dados salvos)
    $entityManager->flush(); //salva no bd


} elseif ($acao == "") { //veio sem acao, inserir um novo vídeo
    $acao = "insert";
    $subtitulo = "Insira os dados do Vídeo";

}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        
        <!-- Bootstrap -->
        <link href="../plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="icon" href="../img/favicon-16.png" sizes="16x16">
        <link rel="icon" href="../img/favicon-32.png" sizes="32x32">
        
        
        <title>Cadastro - 420delivery Bauru</title>

    </head>
    <body>
        <div class="container ">
            <div class="jumbotron row">

                <!--Adiciona os css e js do form bonito-->
                <link rel="stylesheet" type="text/css" href="../plugins/minimalform/css/normalize.css" />
                <link rel="stylesheet" type="text/css" href="../plugins/minimalform/css/cadastro.css" />
                <link rel="stylesheet" type="text/css" href="../plugins/minimalform/css/component.css" />
                <script src="../plugins/minimalform/js/modernizr.custom.js"></script>

                <h1>Cadastro</h1>
                                
                <section>
                    <form action="./cadastro.php" method="post" id="formCadastro" class="simform" autocomplete="off">
                        <div class="simform-inner">
                            <ol class="questions">
                                <li>
                                    <span><label for="nomeCompleto">Qual o seu nome?</label></span>
                                    <input id="nomeCompleto" name="nomeCompleto" type="text"/>
                                </li>
                                <li>
                                    <span><label for="email">E seu e-mail?</label></span>
                                    <input id="email" name="email" type="email"/>
                                </li>
                                <li>
                                    <span><label for="senha">Digite uma senha que você vá lembrar.</label></span>
                                    <input id="senha" name="senha" type="password"/>
                                </li>
                            </ol><!-- /questions -->
                            <button class="submit" type="submit">Cadastrar</button>
                            <div class="controls">
                                <button class="next"></button>
                                <div class="progress"></div>
                                <span class="number">
                                    <span class="number-current"></span>
                                    <span class="number-total"></span>
                                </span>
                                <span class="error-message"></span>
                            </div><!-- / controls -->
                        </div><!-- /simform-inner -->
                        <span class="final-message"></span>
                        <input type="hidden" name="acao" value="insert">
                    </form><!-- /simform -->			
                </section>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="../plugins/minimalform/js/classie.js"></script>
		<script src="../plugins/minimalform/js/stepsForm.js"></script>
		<script>
			var theForm = document.getElementById('formCadastro');

			new stepsForm( theForm, {
				onSubmit : function( form ) {
					// hide form
					classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );

					
					// let's just simulate something...
					var messageEl = theForm.querySelector( '.final-message' );
					messageEl.innerHTML = 'Obrigado! :)';
					classie.addClass( messageEl, 'show' );
                    
					$("#formCadastro").delay(500).submit();
					/*or
					AJAX request (maybe show loading indicator while we don't have an answer..)
					*/

				}
			} );
		</script>
    </body>
</html>