<?php
session_start();

    if($_REQUEST["email"]) {
        require_once "../entitymanager.php";

        $email = $_REQUEST['email'];
        $senha = $_REQUEST['senha'];
        
        $Usuario  = $entityManager->getRepository('Usuario')->findOneBy(array('email' => $email));
        if($Usuario) {            
            //Pega dados do usuário para salvar na sessão
            $idUsuario = $Usuario->getId();
            $nomeCompleto = $Usuario->getNomeCompleto();
            $nomes = explode(" ",$nomeCompleto);
            $nomeUsuario = $nomes[0];
            $pontosUsuario = $Usuario->getPontos();
            if(!$pontosUsuario) $pontosUsuario = "0";
            $senhaUsuario = $Usuario->getSenha();
            $salt = substr($senhaUsuario, 0, 12);
            if(crypt($senha,$salt) == $senhaUsuario) {
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['nomeUsuario'] = $nomeUsuario;
                $_SESSION['pontosUsuario'] = $pontosUsuario;
                header("Location: ./home.php");
            } else {
                $erro = 401;
            }
        }else{
            $erro = 401;
        }
        
        if($erro == 401) {
             header("Location: ./index.php");
        }
    } elseif ($_REQUEST["logoff"]) {
        unset($_SESSION['idUsuario']);
        header("Location: ./index.php");

    }
?>