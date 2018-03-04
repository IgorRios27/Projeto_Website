<?php
     session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $subcategoria = null;
    $idCategoria = null;
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
        $idSubcategoria=$_GET['idSubcategoria'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_subcategoria WHERE idSubcategoria=".$idSubcategoria;
        mysql_query($sql);
        
        header('location:cadastroSubCategorias.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idSubcategoria=$_GET['idSubcategoria'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['sub'] = $idSubcategoria; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_subcategoria WHERE idSubcategoria=".$idSubcategoria;
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $subcategoria=$rsConsulta['subcategoria'];
            $idCategoria=$rsConsulta['idCategoria'];
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // VERIFICA SE O BOTÃO SALVAR FOI CLICADO
    if(isset($_POST["btnCadastrar"])){
        
        // RESGATANDO VALORES DO form
        $subcategoria = $_POST["txtSubcategoria"];
        $idCategoria = $_POST["sltCategorias"];
        
             if($_POST["btnCadastrar"]=="Cadastrar"){
            
            // MONTA O Script PARA ENVIAR PARA O DB
            $sql="insert into tbl_subcategoria(subcategoria, idCategoria) values('".$subcategoria."', '".$idCategoria."')";
            
        }else if($_POST["btnCadastrar"]=="Editar"){
            
            $sql = "UPDATE tbl_subcategoria SET subcategoria='".$subcategoria."', idCategoria='".$idCategoria."' WHERE idSubcategoria=".$_SESSION['sub'];
        }
        
        mysql_query($sql); // EXECUTA O SCRIPT NO BANCO DE DADOS
        header('location:cadastroSubcategorias.php');
        
        echo($sql);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de SubCategorias</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadSubCategoria.css">
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
                <p id="desc_cad">Cadastro e Consulta de Subcategorias</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmCadSubCategorias" method="post" action="cadastroSubcategorias.php">
                <!-- CRUD PARA CADASTRAR OS USUÁRIOS DO CMS -->
                <div id="crud">
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Subcategoria:</p>
                        </div>
                        <input class="inputs" type="text" name="txtSubcategoria" value="<?php echo($subcategoria)?>" maxlength="100" size="30" placeholder="Apenas 100 caracteres" required>
                    </div>
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Categoria:</p>
                        </div>
                        <!-- COMBO BOX DE CATEGORIAS
                                AS CATEGORIAS QUE ESTIVEREM CADASTRADAS APARECERÃO NO COMBO AUTOMATICAMENTE -->
                        <select name="sltCategorias" id="categorias">
                          <?php
                          
                                $sql = "SELECT * FROM tbl_categoria;";
                                $select=mysql_query($sql);
                               
                                while($rsConsulta = mysql_fetch_array($select)){
                                   ?>
                                
                                <option value="<?php echo($rsConsulta['idCategoria']); ?>">
                                <?php echo(utf8_encode($rsConsulta['categoria'])); ?>
                                </option>
                            
                            <?php
                               }
                            ?>
                        
                        </select>
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
                            <p class="desc_tipos">Subcategorias</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Categoria</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Opções</p>
                        </div>
                    </div>
                    <?php
                        // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                        $sql="select * from tbl_subcategoria order by idSubcategoria desc";
                        $select=mysql_query($sql);

                        while($rsConsulta=mysql_fetch_array($select)){
                    ?>
                    <div class="consulta">
                        <div class="dados">
                            <?php echo(utf8_encode($rsConsulta['subcategoria'])) ?>
                        </div>
                        <div class="dados">
                            <?php echo($rsConsulta['idCategoria']) ?>
                        </div>
                        <div class="dados">
                            <div id="centralizar_opcoes">
                                <!-- EDITAR USUÁRIO -->
                                <div id="edit">
                                    <a href="cadastroSubcategorias.php?modo=consulta_editar&idSubcategoria=<?php echo($rsConsulta['idSubcategoria'])?>">
                                        <img src="imagens/edit.png" title="Editar Subcategoria" alt="Editar">
                                    </a>
                                </div>
                                <!-- EXCLUIR USUÁRIO -->
                                <div id="delete">
                                    <a href="cadastroSubcategorias.php?modo=excluir&idSubcategoria=<?php echo($rsConsulta['idSubcategoria'])?>">
                                        <img src="imagens/delete.png" title="Deletar Subcategoria" alt="Deletar">
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