<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    ///// INCLUSÃO DO ARQUIVO conexaoBanco.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Adm. Usuários</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmUsuarios.css">
        <link rel="icon" type="image/jpg" href="imagens/config.png"/>
        <script type="text/javascript" src="js/validacao.js"></script>
    </head>
    <body>
        <!-- DIV PRINCIPAL -->
        <div id="principal">
            <!-- CABEÇALHO DO CMS -->
            <div id="cabecalho">
                <div id="titulo">
                    <p id="titulo_cms"><b>CMS</b> - Sistema de Gerenciamento do Site</p>
                </div>
                <div id=logo>
                    <img src="imagens/logo.png" alt="Logo">
                </div>
            </div>
            <div id="config">
                <!-- BOTÃO VOLTAR -->
                <div id="seta">
                    <a href="home.php">
                        <img src="imagens/setaEsquerda.png" alt="Voltar">
                    </a>
                </div>
                <p id="desc_cad">Cadastro de Usuários e Níveis de permissão</p>
            </div>
            <!-- AQUI O ADM TERÁ DUAS OPÇÕES
                    CADASTRAR USUÁRIOS OU CADASTRAR NÍVEIS DE PERMISSÃO -->
            <div id="centralizar">
                <!-- CADASTRAR USUÁRIOS -->
                <div id="cadUsuarios">
                    <a href="cadastroUsuarios.php">
                        <img src="imagens/user.png" title="Cadastrar Usuários" alt="Cadastrar Usuários" class="acende">
                    </a>
                </div>
                <!-- CADASTAR NÍVEIS DE PERMISSÃO -->
                <div id="cadNiveis">
                    <a href="cadastroNiveis.php">
                        <img src="imagens/nivel.png" title="Cadastrar Níveis" alt="Cadastrar Níveis" class="acende">
                    </a>
                </div>
            </div>
            <div id="cadastro">
                <div id="usuarios">
                    <p class="desc_cad">Cadastrar Usuários</p>
                </div>
                <div id="niveis">
                    <p class="desc_cad">Cadastrar Níveis</p>
                </div>
            </div>
            <!-- RODAPÉ DO CMS -->
            <div id="rodape">
                <div id="center">
                    <p id="desc_rodape">Desenvolvido por João Victor Gonçalves</p>
                </div>
            </div>
        </div>
    </body>
</html>