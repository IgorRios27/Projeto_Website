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
        <title>CMS | Adm. Produtos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmProdutos.css">
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
                <p id="desc_cad">Cadastro de Produtos, Categorias e Subcategorias</p>
            </div>
            <!-- AQUI O ADM TERÁ DUAS OPÇÕES
                    CADASTRAR USUÁRIOS OU CADASTRAR NÍVEIS DE PERMISSÃO -->
            <div id="centralizar">
                <!-- CADASTRAR PRODUTOS -->
                <div id="cadProdutos">
                    <a href="cadastroProdutos.php">
                        <img src="imagens/cadProduto.png" title="Cadastrar Produtos" alt="Cadastrar Produtos" class="acende">
                    </a>
                </div>
                <!-- CADASTAR CATEGORIAS -->
                <div id="cadCategorias">
                    <a href="cadastroCategorias.php">
                        <img src="imagens/categoria.png" title="Cadastrar Categorias" alt="Cadastrar Categorias" class="acende">
                    </a>
                </div>
                <!-- CADASTAR SUB CATEGORIAS -->
                <div id="cadSubCategorias">
                    <a href="cadastroSubcategorias.php">
                        <img src="imagens/subCategoria.png" title="Cadastrar Subcategorias" alt="Cadastrar Subcategorias" class="acende">
                    </a>
                </div>
            </div>
            <div id="cadastro">
                <div id="produtos">
                    <p class="desc_cad">Cadastrar Produtos</p>
                </div>
                <div id="categorias">
                    <p class="desc_cad">Cadastrar Categorias</p>
                </div>
                <div id="subCategorias">
                    <p class="desc_cad">Cadastrar Subcategorias</p>
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