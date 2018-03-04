<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO

    // VARIÁVEIS NULAS
    $nome = null;
    $telefone = null;
    $celular = null;
    $email = null;
    $homePage = null;
    $linkFacebook = null;
    $infoProdutos = null;
    $chkFeminino = null;
    $chkMasculino = null;
    $profissao = null;
    $obs = null;
    $botao = "Enviar";

    ///// INCLUSÃO DO ARQUIVO conexaoBanco.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

// EXCLUIR CADASTRO

// VERIFICA SE EXISTE UMA VARIÁVEL CHAMADA $modo NA URL
if(isset($_GET['modo'])){
    // PEGA O CONTEÚDO DA VARIÁVEL $modo
    $modo=$_GET['modo'];
    
    // VERIFICA SE A VARIÁVEL $modo=excluir
    if($modo=='excluir'){
        // RESGATA O CÓDIGO PASSADO NA URL
        $codigo=$_GET['codigo'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_fconosco WHERE codigo=".$codigo;
        mysql_query($sql);
        
        header('location:admFaleConosco.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA
    }
}
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Adm. Fale Conosco</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmFaleConosco.css">
        <link rel="stylesheet" type="text/css" href="css/styleModal.css">
        <link rel="icon" type="image/jpg" href="imagens/config.png"/>
        <script type="text/javascript" src="js/validacao.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        
        <!-- SCRIPT MODAL -->
        <script>
            $(document).ready(function() {
              $(".ver").click(function() {
                $(".modalContainer").slideToggle(1000);
              });
            });
            
            function Modal(idIten){
                $.ajax({
                    type: "POST",
                    url: "modal.php",
                    data: {id:idIten},
                    success: function(dados){
                        $('.modal').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="modalContainer">
	       <div class="modal">
		      
	       </div>
        </div>	
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
                <p id="desc_cad">Consulta dos Usuários do Site</p>
            </div>
            <!-- FPRMULÁRIO PARA CONSULTAR OS REGISTROS DOS CADASTRADOS DOS USUÁRIOS DO SITE -->
            <form name="frmColsulta" method="post" action="admFaleConosco.php">
                <div id="consulta_dados">
                    <div class="consulta">
                        <div class="tipos">
                            <p class="desc_tipos">Nome</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Celular</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">E-mail</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Sexo</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Opção</p>
                        </div>   
                    </div>
                    <?php
                        // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                        $sql="SELECT * FROM tbl_fconosco order by codigo desc";
                        $select=mysql_query($sql);
                
                        while($rsContatos=mysql_fetch_array($select)){
                    ?>
                    <div class="consulta">
                        <div class="dados">
                            <?php echo(utf8_encode($rsContatos['nome'])) ?>
                        </div>
                        <div class="dados">
                            <?php echo($rsContatos['celular']) ?>
                        </div>
                        <div class="dados">
                            <?php echo(utf8_encode($rsContatos['email'])) ?>
                        </div>
                        <div class="dados">
                            <?php echo($rsContatos['sexo']) ?>
                        </div>
                        <div class="dados">
                            <div id="centralizar_opcoes">
                                <!-- EXCLUI OS REGISTROS DOS USUÁRIOS -->
                                <div id="excluir">
                                    <a href="admFaleConosco.php?modo=excluir&codigo=<?php echo($rsContatos['codigo'])?>">
                                        <img src="imagens/delete.png" title="Excluir dados" alt="Deletar">
                                    </a>
                                </div>
                                <!-- VISUALIZA TODOS OS DADOS -->
                                <div id="visualizar">
                                    <a class="ver" href="#" onclick="Modal(<?php echo($rsContatos["codigo"]) ?>)">
                                        <img src="imagens/visualizar.png" title="Ver todas os dados" alt="Visualizar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
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