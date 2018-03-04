<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO

    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ///// FAZ UMA CONSULTA NA tbl_fconosco E RETORNA TODOS OS REGISTROS CADASTRADOS
    $sql="SELECT * FROM tbl_fconosco";
    $select = mysql_query($sql);


    if($rsConsulta = mysql_fetch_array($select)){
        
        $nome = $rsConsulta['nome'];
        $telefone = $rsConsulta['telefone'];
        $celular = $rsConsulta['celular'];
        $email = $rsConsulta['email'];
        $homePage = $rsConsulta['homePage'];
        $linkFacebook = $rsConsulta['linkFacebook'];
        $infoProdutos = $rsConsulta['infoProdutos'];
        $sexo = $rsConsulta['sexo'];
        $profissao = $rsConsulta['profissao'];
        $obs = $rsConsulta['obs'];
    }

?>
<html>
	<head> 
		<title>CMS | Mais informações</title>
        <link rel="stylesheet" type="text/css" href="css/styleModal.css">
	</head>
    <!-- SCRIPT MODAL -->
	<script>
        $(document).ready(function() {
          $(".fechar").click(function() {
            $(".modalContainer").slideToggle(1000);
          });
        });
	</script>
    <body>
        <!-- FECHAR MODAL -->
        <div id="close">
            <a id="close_modal" href="#" class="fechar">
                <img src="imagens/closeModal.png" alt="Close Modal">
            </a>
        </div>
        <!-- TABELA COM TODAS AS INFORMAÇÕES -->
        <div id="ver_mais_informacoes">
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Nome:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo(utf8_encode($nome))?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Telefone:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo($telefone)?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Celular:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo($celular)?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">E-mail:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo(utf8_encode($email))?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Home Page:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo(utf8_encode($homePage))?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Link do Facebook:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo(utf8_encode($linkFacebook))?></p>
                </div>
            </div>
            <div class="divs_grandes">
                <div class="labels_grandes">
                    <p class="desc_labels">Informações de Produtos:</p>
                </div>
                <div class="consulta_labels_grande">
                    <p class="desc_consulta"><?php echo(utf8_encode($infoProdutos))?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Sexo:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo($sexo)?></p>
                </div>
            </div>
            <div class="divs">
                <div class="labels">
                    <p class="desc_labels">Profissão:</p>
                </div>
                <div class="consulta_labels">
                    <p class="desc_consulta"><?php echo(utf8_encode($profissao))?></p>
                </div>
            </div>
            <div class="divs_grandes">
                <div class="labels_grandes">
                    <p class="desc_labels">Sugestões/Críticas:</p>
                </div>
                <div class="consulta_labels_grande">
                    <p class="desc_consulta"><?php echo(utf8_encode($obs))?></p>
                </div>
            </div>
        </div>
    </body>
</html>