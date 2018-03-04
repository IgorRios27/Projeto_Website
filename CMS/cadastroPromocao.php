<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $botao = "Cadastrar";
    
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Promoções</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadastroPromocao.css">
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
                    <a href="admConteudo.php">
                        <img src="imagens/setaEsquerda.png" alt="Voltar">
                    </a>
                </div>
                <p id="desc_cad">Cadastro de Promoções</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmModaVerao" method="post" action="cadastroModaVerao.php">
                <!-- CRUD PARA CADASTRAR PROMOÇÕES DO SITE -->
                <div id="crud">
                    <!-- IMAGENS QUE SERÃO ESCOLHIDAS -->
                    <div id="left">
                        <div id="label_imagem">
                            <p class="opcoes_imagem">Imagem: <input type="file" name="fleFoto"></p>
                        </div>
                        <div id="echo_imagem">
                            
                        </div>
                        <div id="obs">
                            <p id="desc_obs">A resolução das imagens devem ser de 250 x 250</p>
                        </div>
                    </div>
                    <!-- NOME, DESCRIÇÃO, PREÇO E PREÇO COM DESCONTO DO PRODUTO -->
                    <div id="right">
                        <div class="labels">
                            <p class="opcoes_imagem">Nome do Produto:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="" maxlength="100" placeholder="Apenas 100 caractéres são aceitos">
                        <div class="labels">
                            <p class="opcoes_imagem">Descrição:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="" maxlength="100" placeholder="Apenas 100 caractéres são aceitos">
                        <div class="labels">
                            <p class="opcoes_imagem">Preço:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="" maxlength="100" placeholder="Apenas 100 caractéres são aceitos">
                        <div class="labels">
                            <p class="opcoes_imagem">Novo preço:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="" maxlength="100" placeholder="Apenas 100 caractéres são aceitos">
                    </div>
                    <!-- BOTÃO PARA SALVAR O CADASTRO -->
                    <input id="cadastrar" type="submit" name="btnSalvar" value="<?php echo($botao)?>">
                    <!-- BOTÃO PARA VISUALIZAR OS CADASTROS (IRÁ REDIRECIONAR PARA UMA NOVA PÁGINA) -->
                    <a href="consultaPromocao.php">
                        <img src="imagens/visu.png" title="Ver todos os cadastros" alt="Ver">
                    </a>
                </div>
            </form>
            <!-- RODAPÉ DO CMS -->
            <div id="rodape">
                <div id="center">
                    <p id="desc_rodape">Desenvolvido por João Victor Gonçalves</p>
                </div>
            </div>
        </div>
    </body>
</html>