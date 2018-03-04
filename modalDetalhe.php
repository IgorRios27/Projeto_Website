<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO

    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $id = $_POST['id'];

    ///// FAZ UMA CONSULTA NA tbl_produto E RETORNA A DESCRIÇÃO DO PRODUTO PELO id
    $sql="SELECT * FROM tbl_produto WHERE idProduto = $id";
    $select = mysql_query($sql);

    if($rsConsulta = mysql_fetch_array($select)){
        $imagem = $rsConsulta['imagem'];
        $descricao = $rsConsulta['descricao'];
        $clickProduto = $rsConsulta['clickProduto'];
    }

    $sql2= "UPDATE tbl_produto SET clickProduto='".$clickProduto."' + 1 WHERE idProduto='".$id."';";
    mysql_query($sql2);
    
?>
<html>
	<head> 
		<title>CMS | Detalhes</title>
        <link rel="stylesheet" type="text/css" href="css/styleModalDetalhe.css">
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
                <img src="imagens/icones/closeModal.png" alt="Close Modal">
            </a>
        </div>
        <div id="center_content">
            <!-- DESCRIÇÃO DOS PRODUTOS -->
            <div id="ver_mais_informacoes">
                <div class="divs">
                    <div class="consulta_imagem">
                        <img src="CMS/<?php echo($rsConsulta['imagem'])?>" alt="Produtos" width="100%" height="100%">
                    </div>
                    <div class="labels_prod">
                        <p class="desc_labels">Descrição do Produto:</p>
                    </div>
                    <div class="consulta_labels">
                        <p class="desc_consulta"><?php echo(utf8_encode($descricao)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>