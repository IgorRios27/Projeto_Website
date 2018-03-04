<?php
     session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
     // VARIÁVEIS NULAS
    $imagem = null;
    $nomeProduto = null;
    $descricao = null;
    $preco = null;
    $idSubcategoria = null;
    $botao = "Cadastrar";
    
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

// EXCLUIR CADASTRO

// VERIFICA SE EXISTE UMA VARIÁVEL CHAMADA $modo NA URL
if(isset($_GET['modo'])){
    // PEGA O CONTEÚDO DA VARIÁVEL $modo
    $modo=$_GET['modo'];
    
    // VERIFICA SE A VARIÁVEL $modo=excluir
    if($modo=='excluir'){
        // RESGATA O CÓDIGO PASSADO NA URL
        $idProduto=$_GET['idProduto'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_produto WHERE idProduto=".$idProduto;
        mysql_query($sql);
        
        header('location:cadastroProdutos.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idProduto=$_GET['idProduto'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['produto'] = $idProduto; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_produto WHERE idProduto=".$idProduto;
        
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $imagem=$rsConsulta['imagem'];
            $nomeProduto=$rsConsulta['nomeProduto'];
            $descricao=$rsConsulta['descricao'];
            $preco=$rsConsulta['preco'];
            $idSubcategoria=$rsConsulta['idSubcategoria'];
        }
    }
}
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_POST["btnCadastrar"])){
        
        $nomeProduto = $_POST['txtNome'];
        $descricao = $_POST['txtDescricao'];
        $preco = $_POST['txtPreco'];
        $idSubcategoria = $_POST["sltSubcategoria"];
        
        $upload_dir="arquivos/";//CAMIMHO DA PASTA ONDE AS IMAGENS SERÃO ARMAZENADAS.
        //ARMAZENANDO O NOME DO ARQUIVO E A EXTENSÃO QUE FOI SELECIONADA.   
        
        $nome_arq=basename($_FILES['fleFoto']['name']);//BASENAME:RETIRA O NOME DO ARQUIVO, NAME:VEM COM O NOME DO ARQUIVO.
        
        //VERIFICA TIPO DE EXTENSÃO PERMITIDA PARA O PLOAD DO ARQUIVO, USAMOS O COMANDO strstr PARA LOCALIZAR SEQUÊNCIA DE CARACTERES.
		if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
            //CRIPTOGRAFIA DO ARQUIVO
            $extensao = substr($nome_arq, strpos($nome_arq,"."),5);
            $prefixo = substr($nome_arq,0, strpos($nome_arq,"."));
            $nome_arq = md5($prefixo).$extensao;
            
            //GUARDAMOS O CAMINHO E O NOME DA IMAGEM QUE SERÁ INSERIDA NO BD.   
            $upload_file =  $upload_dir . $nome_arq;
        
            if(move_uploaded_file($_FILES['fleFoto']['tmp_name'], $upload_file)){
                
                if($_POST['btnCadastrar'] == 'Cadastrar'){
            
                    $sql = "INSERT INTO tbl_produto(imagem, nomeProduto, descricao, preco, idSubcategoria)
                    VALUES('".$upload_file."', '".$nomeProduto."', '".$descricao."', '".$preco."', '".$idSubcategoria."')";
                    
                }else if($_POST["btnCadastrar"]=="Editar"){
            
                    $sql = "UPDATE tbl_produto SET imagem='".$upload_file."', nomeProduto='".$nomeProduto."', descricao='".$descricao."', preco='".$preco."', idSubcategoria='".$idSubcategoria."'  WHERE idProduto=".$_SESSION['produto'];
                }
                    mysql_query($sql);
            }
                return $upload_file;
            }else{
                echo "<script type='text/javascript'>window.alert('O arquivo não pode ser movido para o servidor')</script>";
            }
        }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Produtos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadProdutos.css">
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
                <p id="desc_cad">Cadastro e Consulta de Produtos</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmProdutos" method="post" action="cadastroProdutos.php" enctype="multipart/form-data">
                <!-- CRUD PARA CADASTRAR PROMOÇÕES DO SITE -->
                <div id="crud">
                    <!-- IMAGENS QUE SERÃO ESCOLHIDAS -->
                    <div id="left">
                        <div id="label_imagem">
                            <p class="opcoes_imagem">Imagem: <input type="file" name="fleFoto"></p>
                        </div>
                        <div id="echo_imagem">
                            <img src="<?php echo($rsConsulta['imagem'])?>" alt="Produtos" width="100%" height="100%">
                        </div>
                    </div>
                    <!-- NOME, DESCRIÇÃO, PREÇO E PREÇO COM DESCONTO DO PRODUTO -->
                    <div id="right">
                        <div class="labels">
                            <p class="opcoes_imagem">Nome do Produto:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtNome" value="<?php echo($nomeProduto)?>" maxlength="50" placeholder="Apenas 50 caractéres são aceitos" required>
                        <div class="labels">
                            <p class="opcoes_imagem">Descrição:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtDescricao" value="<?php echo($descricao)?>" maxlength="50" placeholder="Apenas 50 caractéres são aceitos" required>
                        <div class="labels">
                            <p class="opcoes_imagem">Preço:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtPreco" value="<?php echo($preco)?>" maxlength="5" placeholder="Apenas 5 caractéres são aceitos" required>
                        <div class="labels">
                            <p class="opcoes_imagem">Subcategoria:</p>
                        </div>
                        <select name="sltSubcategoria" id="niveis">
                            <?php
                          
                                $sql = "SELECT * FROM tbl_subcategoria;";
                                $select=mysql_query($sql);
                               
                                while($rsConsulta = mysql_fetch_array($select)){
                                   ?>
                                
                                <option value="<?php echo($rsConsulta['idSubcategoria']); ?>">
                                <?php echo(utf8_encode($rsConsulta['subcategoria'])); ?>
                                </option>
                            
                            <?php
                               }
                            ?>
                        </select>
                    </div>
                    <!-- BOTÃO PARA SALVAR O CADASTRO -->
                    <input id="cadastrar" type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                    <div id="img_ver_grafico">
                        <a href="grafico.php">
                            <img src="imagens/visu.png" alt="Ver" title="Controle estatístico">
                        </a>
                    </div>
                </div>
                <!-- CONSULTAR PRODUTOS -->
                <div id="consulta">
                    <div id="linha_titulo">
                        <div class="lab">
                            <p class="desc_til">Imagem</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Nome</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Descrição</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Preço</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Opções</p>
                        </div>
                    </div>
                    <table border="1" width="820" height="400" color="#ffa31a">
                        <?php
                            // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                            $sql="select * from tbl_produto order by idProduto desc";
                            $select=mysql_query($sql);

                            while($rsConsulta=mysql_fetch_array($select)){
                        ?>    
                        <tr>
                            <td class="largura">
                                <img src="<?php echo($rsConsulta['imagem'])?>" alt="Produtos" width="100%" height="100%">
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo(utf8_encode($rsConsulta['nomeProduto']))?></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo(utf8_encode($rsConsulta['descricao']))?></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo($rsConsulta['preco'])?></p>
                            </td>
                            <td class="largura">
                                <a href="cadastroProdutos.php?modo=consulta_editar&idProduto=<?php echo($rsConsulta['idProduto'])?>" class="botoes">
                                    <img src="imagens/edit.png" alt="Editar produto" title="Editar produto">
                                </a>
                                <a href="cadastroProdutos.php?modo=excluir&idProduto=<?php echo($rsConsulta['idProduto'])?>" class="botoes">
                                    <img src="imagens/delete.png" alt="Excluir produto" title="Excluir produto">
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
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