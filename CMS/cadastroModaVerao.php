<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $imagem = null;
    $titulo = null;
    $ingrediente = null;
    $modoPreparo = null;
    $beneficio = null;
    $botao = "Cadastrar";
    
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
        $idModaVerao=$_GET['idModaVerao'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_moda_verao WHERE idModaVerao=".$idModaVerao;
        mysql_query($sql);
        
        header('location:cadastroModaVerao.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA
        
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idModaVerao=$_GET['idModaVerao'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['moda'] = $idModaVerao; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_moda_verao WHERE idModaVerao=".$idModaVerao;
        
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $imagem=$rsConsulta['imagem'];
            $titulo=$rsConsulta['titulo'];
            $ingrediente=$rsConsulta['ingrediente'];
            $modoPreparo=$rsConsulta['modoPreparo'];
            $beneficio=$rsConsulta['beneficio'];
        }
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_POST["btnCadastrar"])){
        
        $titulo = $_POST['txtTitulo'];
        $ingrediente = $_POST['txtIngrediente'];
        $modoPreparo = $_POST['txtModoPreparo'];
        $beneficio = $_POST['txtBeneficio'];
        
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
            
                    $sql = "INSERT INTO tbl_moda_verao(imagem, titulo, ingrediente, modoPreparo, beneficio)
                    VALUES('".$upload_file."', '".$titulo."', '".$ingrediente."', '".$modoPreparo."', '".$beneficio."')";
                    
                }else if($_POST["btnCadastrar"]=="Editar"){
            
                    $sql = "UPDATE tbl_moda_verao SET imagem='".$upload_file."', titulo='".$titulo."', ingrediente='".$ingrediente."', modoPreparo='".$modoPreparo."', beneficio='".$beneficio."'  WHERE idModaVerao=".$_SESSION['moda'];
                }
                    mysql_query($sql);
                    header('Location:cadastroModaVerao.php');
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
        <title>CMS | Cadastro de Receitas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadModaVerao.css">
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
                <p id="desc_cad">Cadastro de Receitas</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmModaVerao" method="post" action="cadastroModaVerao.php" enctype="multipart/form-data">
                <!-- CRUD PARA CADASTRAR RECEITAS E ENVIAR PARA O SITE -->
                <div id="crud">
                    <!-- IMAGENS QUE SERÃO ESCOLHIDAS -->
                    <div id="left">
                        <div id="label_imagem">
                            <p class="opcoes_imagem">Imagem: <input type="file" name="fleFoto"></p>
                        </div>
                        <div id="echo_imagem">
                            <img src="<?php echo($rsConsulta['imagem'])?>" alt="Receitas" width="100%" height="100%">
                        </div>
                    </div>
                    <!-- TÍTULO, INGREDIENTE, MODO DE PREPARO E BENEFÍCIO DA RECEITA -->
                    <div id="right">
                        <div class="labels">
                            <p class="opcoes_imagem">Título da Receita:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="<?php echo($titulo)?>" maxlength="80" placeholder="Apenas 80 caractéres são aceitos" required>
                        <div class="labels">
                            <p class="opcoes_imagem">Ingredientes:</p>
                        </div>
                        <textarea name="txtIngrediente" cols="41" rows="5" maxlength="200" required placeholder="Apenas 200 caractéres são aceitos" <?php echo($ingrediente)?>></textarea>
                        <div class="labels">
                            <p class="opcoes_imagem">Modo de Preparo:</p>
                        </div>
                        <textarea name="txtModoPreparo" cols="41" rows="5" maxlength="200" required placeholder="Apenas 200 caractéres são aceitos" <?php echo($modoPreparo)?>></textarea>
                        <div class="labels">
                            <p class="opcoes_imagem">Benefícios:</p>
                        </div>
                        <textarea name="txtBeneficio" cols="41" rows="5" maxlength="200" required placeholder="Apenas 200 caractéres são aceitos" <?php echo($beneficio)?>></textarea>
                    </div>
                    <!-- BOTÃO PARA SALVAR O CADASTRO -->
                    <input id="cadastrar" type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                </div>
                <div id="consulta">
                    <div id="linha_titulo">
                        <div class="lab">
                            <p class="desc_til">Imagens</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Títulos</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Ingredientes</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Modos de Preparo</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Benefícios</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Opções</p>
                        </div>
                    </div>
                    <table border="1" width="990" height="400">
                        <?php
                            // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                            $sql="select * from tbl_moda_verao order by idModaVerao desc";
                            $select=mysql_query($sql);

                            while($rsConsulta=mysql_fetch_array($select)){
                        ?>    
                        <tr>
                            <td class="largura">
                                 <img src="<?php echo($rsConsulta['imagem'])?>" alt="Receitas" width="100%" height="100%">
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo($rsConsulta['titulo'])?></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo($rsConsulta['ingrediente'])?></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo($rsConsulta['modoPreparo'])?></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"><?php echo($rsConsulta['beneficio'])?></p>
                            </td>
                            <td class="largura">
                                <a href="cadastroModaVerao.php?modo=consulta_editar&idModaVerao=<?php echo($rsConsulta['idModaVerao'])?>" class="botoes">
                                    <img src="imagens/edit.png" alt="Editar cadastro" title="Editar cadastro">
                                </a>
                                <a href="cadastroModaVerao.php?modo=excluir&idModaVerao=<?php echo($rsConsulta['idModaVerao'])?>" class="botoes">
                                    <img src="imagens/delete.png" alt="Excluir cadastro" title="Excluir cadastro">
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