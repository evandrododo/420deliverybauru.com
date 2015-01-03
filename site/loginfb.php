<?php
session_start();

    if($_REQUEST["email"]) {
        require_once "../entitymanager.php";

        $idFb = $_REQUEST['idFb'];
        $email = $_REQUEST['emailFb'];
        $nome = $_REQUEST['nome'];
        
        $Usuario  = $entityManager->getRepository('Usuario')->findOneBy(array('email' => $email));
        //Caso exista o usuário ele pega os dados, caso contrário vai cadastrar um novo
        if($Usuario) {            
            //Pega dados do usuário para salvar na sessão
            $idUsuario = $Usuario->getId();
            $nomeCompleto = $Usuario->getNomeCompleto();
            $nomes = explode(" ",$nomeCompleto);
            $nomeUsuario = $nomes[0];
            $pontosUsuario = $Usuario->getPontos();
            if(!$pontosUsuario) $pontosUsuario = "0";
            
            $facebookId = $Usuario->getFacebookId();

            if($facebookId == $idFb) {
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['nomeUsuario'] = $nomeUsuario;
                $_SESSION['pontosUsuario'] = $pontosUsuario;
                header("Location: ./home.php");
            } else {
                $erro = 401;
            }
        }else{
            //Cadastra um novo usuário
            
            $Usuario = new Usuario();
            $Usuario->setNomeCompleto($nomeCompleto);
            $Usuario->setFacebookId($idFb);
            $Usuario->setEmail($email);
            $Usuario->setNome($nome);

            $entityManager->persist($Usuario); //persistencia (caso dê merda ele mantém os dados salvos)
            $entityManager->flush(); //salva no bd
        }
        
        if($erro == 401) {
             header("Location: ./index.php");
        }
    } elseif ($_REQUEST["logoff"]) {
        unset($_SESSION['idUsuario']);
        header("Location: ./index.php");

    }
?>