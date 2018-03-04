<?php
     session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $categoria = null;
    $botao = "Cadastrar";
    
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
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
        $idCategoria=$_GET['idCategoria'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_categoria WHERE idCategoria=".$idCategoria;
        mysql_query($sql);
        
        header('location:cadastroCategorias.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idCategoria=$_GET['idCategoria'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['categoria'] = $idCategoria; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_categoria WHERE idCategoria=".$idCategoria;
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $categoria=$rsConsulta['categoria'];
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // VERIFICA SE O BOTÃO SALVAR FOI CLICADO
    if(isset($_POST["btnCadastrar"])){
        
        // RESGATANDO VALORES DO form
        $categoria = $_POST["txtCategoria"];
        
             if($_POST["btnCadastrar"]=="Cadastrar"){
            
            // MONTA O Script PARA ENVIAR PARA O DB
            $sql="insert into tbl_categoria(categoria) values('".$categoria."')";
            
        }else if($_POST["btnCadastrar"]=="Editar"){
            
            $sql = "UPDATE tbl_categoria SET categoria='".$categoria."' WHERE idCategoria=".$_SESSION['categoria'];
        }
        
        mysql_query($sql); // EXECUTA O SCRIPT NO BANCO DE DADOS
        header('location:cadastroCategorias.php');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Categorias</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadCategorias.css">
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
                    <a href="admProdutos.php">
                        <img src="imagens/setaEsquerda.png" alt="Voltar">
                    </a>
                </div>
                <p id="desc_cad">Cadastro e Consulta de Categorias</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmCadCategorias" method="post" action="cadastroCategorias.php">
                <!-- CRUD PARA CADASTRAR OS USUÁRIOS DO CMS -->
                <div id="crud">
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Categoria:</p>
                        </div>
                        <input class="inputs" onkeypress="return validarNumero(event, 'number')" type="text" name="txtCategoria" value="<?php echo($categoria)?>" maxlength="100" size="30" pattern="[a-z A-Z ã Ã õ Õ é É í Í á Á ô Ô ç Ç]*" title="*** Digitação apenas de letras ***" placeholder="Apenas 100 caracteres" required>
                    </div>
                    <!-- BOTÃO PARA CADASTRAR -->
                    <div id="botao">
                        <input id="cadastrar" type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                    </div>
                </div>
                <!-- TABELA PARA CONSULTAR OS USUÁRIOS CADASTRADOS -->
                <div id="consulta_dados">
                    <div class="consulta">
                        <div class="tipos">
                            <p class="desc_tipos">Categoria</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Opções</p>
                        </div>
                    </div>
                    <?php
                        // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                        $sql="select * from tbl_categoria order by idCategoria desc";
                        $select=mysql_query($sql);

                        while($rsConsulta=mysql_fetch_array($select)){
                    ?>
                    <div class="consulta">
                        <div class="dados">
                           <?php echo(utf8_encode($rsConsulta['categoria'])) ?>
                        </div>
                        <div class="dados">
                            <div id="centralizar_opcoes">
                                <!-- EDITAR USUÁRIO -->
                                <div id="edit">
                                    <a href="cadastroCategorias.php?modo=consulta_editar&idCategoria=<?php echo($rsConsulta['idCategoria'])?>">
                                        <img src="imagens/edit.png" title="Editar Categoria" alt="Editar">
                                    </a>
                                </div>
                                <!-- EXCLUIR USUÁRIO -->
                                <div id="delete">
                                    <a href="cadastroCategorias.php?modo=excluir&idCategoria=<?php echo($rsConsulta['idCategoria'])?>">
                                        <img src="imagens/delete.png" title="Deletar Categoria" alt="Deletar">
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