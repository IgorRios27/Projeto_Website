<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $imagem = null;
    $titulo = null;
    $texto = null;
    $botao = "Cadastrar";
    
    ///// INCLUSÃO DO ARQUIVO conexaoBanco.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(isset($_GET['modo'])){
        
        $modo = $_GET['modo'];
        
        if($modo=='excluir'){
            
            $idImportancia = $_GET['idImportancia'];
            
            $sql = "delete from tbl_importancia where idImportancia=".$idImportancia;
            mysql_query($sql);
            
            header('Location:cadastroImportancia.php');
            
        }else if($modo=='ativar'){
            
            $idImportancia = $_GET['idImportancia'];
            
            $sql = "update tbl_importancia set ativar='1' where idImportancia='".$idImportancia."'";
            mysql_query($sql);
            
            header('Location:cadastroImportancia.php');
        }
    }
    
    if(isset($_POST["btnCadastrar"])){
        
        $titulo = $_POST['txtTitulo'];
        $texto = $_POST['txtTexto'];
        
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
            
                    $sql = "INSERT INTO tbl_importancia(titulo, texto, imagem)
                    VALUES('".$titulo."', '".$texto."', '".$upload_file."')";
                }
                    mysql_query($sql);
                    header('Location:cadastroImportancia.php');
            }
                return $upload_file;
            }else{
                echo "<script type='text/javascript'>window.alert('O arquivo não pode ser movido para o servidor')</script>";
            }
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Receitas</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadImportancia.css">
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
                <p id="desc_cad">Cadastro de conteúdo da página Importância do Suco Natural</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmImportancia" method="post" action="cadastroImportancia.php" enctype="multipart/form-data">
                <!-- CRUD PARA CADASTRAR CONTEÚDO -->
                <div id="crud">
                    <!-- IMAGENS QUE SERÃO ESCOLHIDAS -->
                    <div id="left">
                        <div id="label_imagem">
                            <p class="opcoes_imagem">Imagem: <input type="file" name="fleFoto"></p>
                        </div>
                        <div id="echo_imagem">
                            
                        </div>
                        <div id="obs">
                            <p id="desc_obs">A resolução das imagens devem ser de 350 x 350</p>
                        </div>
                    </div>
                    <!-- TÍTULO, INGREDIENTE, MODO DE PREPARO E BENEFÍCIO DA RECEITA -->
                    <div id="right">
                        <div class="labels">
                            <p class="opcoes_imagem">Título do texto:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtTitulo" value="<?php echo($titulo)?>" maxlength="80" placeholder="Apenas 80 caractéres são aceitos" required>
                        
                        <div class="labels">
                            <p class="opcoes_imagem">Texto:</p>
                        </div>
                        <textarea name="txtTexto" cols="41" rows="20" maxlength="200" required placeholder="Apenas 250 caractéres são aceitos" <?php echo($texto)?>></textarea>
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
                            <p class="desc_til">Textos</p>
                        </div>
                        <div class="lab">
                            <p class="desc_til">Opções</p>
                        </div>
                    </div>
                    <table border="1" width="695" height="400">
                        <?php
                            // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                            $sql="select * from tbl_importancia where ativar=1 order by idImportancia desc";
                            $select=mysql_query($sql);

                            if($rsConsulta=mysql_fetch_array($select)){
                        ?>    
                        <tr>
                            <td class="largura">
                                
                            </td>
                            <td class="largura">
                                <p class="desc_echo"></p>
                            </td>
                            <td class="largura">
                                <p class="desc_echo"></p>
                            </td>
                            <td class="largura">
                                <a href="cadastroImportancia.php?modo=ativar&idImportancia=<?php echo($rsConsulta['idImportancia'])?>" class="botoes">
                                    <img src="imagens/on.png" alt="Ativar cadastro" title="Ativar cadastro">
                                </a>
                                <a href="#" class="botoes">
                                    <img src="imagens/edit.png" alt="Editar cadastro" title="Editar cadastro">
                                </a>
                                <a href="cadastroImportancia.php?modo=excluir&idImportancia=<?php echo($rsConsulta['idImportancia'])?>" class="botoes">
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