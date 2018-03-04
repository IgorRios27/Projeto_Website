<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $nomeNivel = null;
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
        $idNivel=$_GET['idNivel'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_nivel WHERE idNivel=".$idNivel;
        mysql_query($sql);
        
        header('location:cadastroNiveis.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idNivel=$_GET['idNivel'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['nivel'] = $idNivel; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_nivel WHERE idNivel=".$idNivel;
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $nomeNivel=$rsConsulta['nomeNivel'];
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // VERIFICA SE O BOTÃO SALVAR FOI CLICADO
    if(isset($_POST["btnCadastrar"])){
        
        // RESGATANDO VALORES DO form
        $nomeNivel = $_POST["txtNivel"];
        
             if($_POST["btnCadastrar"]=="Cadastrar"){
            
            // MONTA O Script PARA ENVIAR PARA O DB
            $sql="insert into tbl_nivel(nomeNivel) values('".$nomeNivel."')";
            
        }else if($_POST["btnCadastrar"]=="Editar"){
            
            $sql = "UPDATE tbl_nivel SET nomeNivel='".$nomeNivel."' WHERE idNivel=".$_SESSION['nivel'];
        }
        
        mysql_query($sql); // EXECUTA O SCRIPT NO BANCO DE DADOS
        header('location:cadastroNiveis.php');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Usuários</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadNiveis.css">
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
                    <a href="admUsuarios.php">
                        <img src="imagens/setaEsquerda.png" alt="Voltar">
                    </a>
                </div>
                <p id="desc_cad">Cadastro de Níveis de Permissão</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmCadNiveis" method="post" action="cadastroNiveis.php">
                <!-- CRUD PARA CADASTRAR NÍVEIS DE PERMISSÃO -->
                <div id="crud">
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Nível:</p>
                        </div>
                        <input class="inputs" id="input" type="text" name="txtNivel" value="<?php echo($nomeNivel)?>" maxlength="90" placeholder="Apenas 90 caracteres">
                    </div>
                    <div id="botao">
                    <input id="cadastrar" type="submit" name="btnCadastrar" value="<?php echo($botao)?>">
                </div>
                </div>
                <!-- TABELA PARA CONSULTAR, EDITAR E EXCLUIR OS NÍVEIS CADASTRADOS -->
                <div id="consulta_dados">
                    <div class="consulta">
                        <div class="tipos">
                            <p class="desc_tipos">Nível</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Opções</p>
                        </div>
                    </div>
                    <?php
                        // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                        $sql="select * from tbl_nivel order by idNivel desc";
                        $select=mysql_query($sql);

                        while($rsConsulta=mysql_fetch_array($select)){
                    ?>
                    <div class="consulta">
                        <div class="dados">
                            <?php echo(utf8_encode($rsConsulta['nomeNivel'])) ?>
                        </div>
                        <div class="dados">
                            <div id="centralizar_opcoes">
                                <!-- EDITA OS NÍVEIS -->
                                <div id="edit">
                                    <a href="cadastroNiveis.php?modo=consulta_editar&idNivel=<?php echo($rsConsulta['idNivel'])?>">
                                        <img src="imagens/edit.png" title="Editar Nível" alt="Editar">
                                    </a>
                                </div>
                                <!-- EXCLUI OS NÍVEIS -->
                                <div id="delete">
                                    <a href="cadastroNiveis.php?modo=excluir&idNivel=<?php echo($rsConsulta['idNivel'])?>">
                                        <img src="imagens/delete.png" title="Deletar Nível" alt="Deletar">
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