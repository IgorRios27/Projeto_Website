<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    // VARIÁVEIS NULAS
    $nome = null;
    $usuario = null;
    $senha = null;
    $idNivel = null;
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
        $idUsuario=$_GET['idUsuario'];
        // DELETA NO BANCO DE DADOS O REGISTRO CADASTRADO
        $sql="DELETE FROM tbl_usuario WHERE idUsuario=".$idUsuario;
        mysql_query($sql);
        
        header('location:cadastroUsuarios.php'); // REDIRECIONA PARA A PÁGINA INICIAL O GET DA PÁGINA
        
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // EDITAR CADASTRO
    }else if($modo=='consulta_editar'){
        $botao = "Editar";
        // RESGATA O CÓDIGO PASSADO NA URL
        $idUsuario=$_GET['idUsuario'];
        
        // VARIÁVEL DE SESSÃO
        $_SESSION['user'] = $idUsuario; // GUARDA O CÓDIGO DO REGISTRO QUE SERÁ ATUALIZADO NO UPDATE
            
        $sql="SELECT * FROM tbl_usuario WHERE idUsuario=".$idUsuario;
        
        // GUARDA NA VARIÁVEL $select O RETORNO DOS REGISTROS CADASTRADOS NO BANCO DE DADOS
        $select = mysql_query($sql);
        
        if($rsConsulta=mysql_fetch_array($select)){
            // RASGATA TODOS OS DADOS DO BANCO DE DADOS E GUARDA NAS VARIÁVEIS LOCAIS
            $nome=$rsConsulta['nome'];
            $usuario=$rsConsulta['usuario'];
            $senha=$rsConsulta['senha'];
            $idNivel=$rsConsulta['idNivel'];
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // VERIFICA SE O BOTÃO SALVAR FOI CLICADO
    if(isset($_POST["btnCadastrar"])){
        
        // RESGATANDO VALORES DO form
        $nome = $_POST["txtNome"];
        $usuario = $_POST["txtUsuario"];
        $senha = $_POST["txtSenha"];
        $idNivel = $_POST["sltNivel"];
        
             if($_POST["btnCadastrar"]=="Cadastrar"){
            
            // MONTA O Script PARA ENVIAR PARA O DB
            $sql="insert into tbl_usuario(nome, usuario, senha, idNivel) values('".$nome."', '".$usuario."', '".$senha."', '".$idNivel."')";
            
        }else if($_POST["btnCadastrar"]=="Editar"){
            
            $sql = "UPDATE tbl_usuario SET nome='".$nome."', usuario='".$usuario."', senha='".$senha."', idNivel='".$idNivel."'  WHERE idUsuario=".$_SESSION['user'];
        }
    
        mysql_query($sql); // EXECUTA O SCRIPT NO BANCO DE DADOS
        header('location:cadastroUsuarios.php');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html>
    <head>
        <title>CMS | Cadastro de Usuários</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadUsuarios.css">
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
                <p id="desc_cad">Cadastro e Consulta de Usuários</p>
            </div>
            <!-- FORMULÁRIO -->
            <form name="frmCadUsuarios" method="post" action="cadastroUsuarios.php">
                <!-- CRUD PARA CADASTRAR OS USUÁRIOS DO CMS -->
                <div id="crud">
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Nome:</p>
                        </div>
                        <input class="inputs" onkeypress="return validarNumero(event, 'number')" type="text" name="txtNome" value="<?php echo($nome)?>" maxlength="20" size="30" pattern="[a-z A-Z ã Ã õ Õ é É í Í á Á ô Ô ç Ç]*" title="*** Digitação apenas de letras ***" placeholder="Apenas 20 caracteres" required>
                    </div>
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Usuário:</p>
                        </div>
                        <input class="inputs" onkeypress="return validarNumero(event, 'number')" type="text" name="txtUsuario" value="<?php echo($usuario)?>" maxlength="20" size="30" pattern="[a-z]*" title="*** Apenas letras minúsculas e sem nenhum tipo de caracter especial ***" placeholder="Apenas 20 caracteres" required>
                    </div>
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Senha:</p>
                        </div>
                        <input class="inputs" type="text" name="txtSenha" value="<?php echo($senha)?>" maxlength="8" size="30" placeholder="Apenas 8 dígitos" required>
                    </div>
                    <div class="divs">
                        <div class="labels">
                            <p class="desc_labels">*Nível:</p>
                        </div>
                        <!-- COMBO BOX DE NÍVEIS
                                OS NÍVEIS QUE ESTIVEREM CADASTRADOS APARECERÃO NO COMBO AUTOMATICAMENTE -->
                        <select name="sltNivel" id="niveis">
                          <?php
                          
                                $sql = "SELECT * FROM tbl_nivel;";
                                $select=mysql_query($sql);
                               
                                while($rsConsulta = mysql_fetch_array($select)){
                                   ?>
                                
                                <option value="<?php echo($rsConsulta['idNivel']); ?>">
                                <?php echo(utf8_encode($rsConsulta['nomeNivel'])); ?>
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
                            <p class="desc_tipos">Nome</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Usuário</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Nível</p>
                        </div>
                        <div class="tipos">
                            <p class="desc_tipos">Opções</p>
                        </div>
                    </div>
                    <?php
                        // COLOCA EM ORDEM OS REGISTROS CADASTRADOS DO ÚLTIMO PARA O PRIMEIRO
                        $sql="select * from tbl_usuario order by idUsuario desc";
                        $select=mysql_query($sql);

                        while($rsConsulta=mysql_fetch_array($select)){
                    ?>
                    <div class="consulta">
                        <div class="dados">
                            <?php echo(utf8_encode($rsConsulta['nome'])) ?>
                        </div>
                        <div class="dados">
                            <?php echo(utf8_encode($rsConsulta['usuario'])) ?>
                        </div>
                        <div class="dados">
                            <?php echo($rsConsulta['idNivel']) ?>
                        </div>
                        <div class="dados">
                            <div id="centralizar_opcoes">
                                <!-- EDITAR USUÁRIO -->
                                <div id="edit">
                                    <a href="cadastroUsuarios.php?modo=consulta_editar&idUsuario=<?php echo($rsConsulta['idUsuario'])?>">
                                        <img src="imagens/edit.png" title="Editar Usuário" alt="Editar">
                                    </a>
                                </div>
                                <!-- EXCLUIR USUÁRIO -->
                                <div id="delete">
                                    <a href="cadastroUsuarios.php?modo=excluir&idUsuario=<?php echo($rsConsulta['idUsuario'])?>">
                                        <img src="imagens/delete.png" title="Deletar Usuário" alt="Deletar">
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