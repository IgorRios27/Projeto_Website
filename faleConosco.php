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
            
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // INSERT NO BANCO DE DADOS

    // VERIFICA SE O BOTÃO SALVAR FOI CLICADO
    if(isset($_POST["btnEnviar"])){
        
        // RESGATANDO VALORES DO form
        $nome = $_POST["txtNome"];
        $telefone = $_POST["txtTelefone"];
        $celular = $_POST["txtCelular"];
        $email = $_POST["txtEmail"];
        $homePage = $_POST["txtHomePage"];
        $linkFacebook = $_POST["txtLinkFacebook"];
        $infoProdutos = $_POST["txtInfoProdutos"];
        $rdoSexo = $_POST["rdoSexo"];
        $profissao = $_POST["txtProfissao"];
        $obs = $_POST["txtObs"];
       
        // MONTA O Script PARA ENVIAR PARA O BANCO DE DADOS
        $sql="insert into tbl_fconosco(nome,telefone,celular,email, homePage, linkFacebook, infoProdutos, sexo, profissao, obs)
        values('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$homePage."',
        '".$linkFacebook."', '".$infoProdutos."', '".$rdoSexo."', '".$profissao."', '".$obs."')";
    
        mysql_query($sql); // EXECUTA O SCRIPT NO BANCO DE DADOS
        header('location:faleConosco.php');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fale Conosco | Delícia Gelada</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleFaleConosco.css">
        <link rel="icon" type="image/jpg" href="imagens/icones/photo.png"/>
        <script type="text/javascript" src="js/validacao.js"></script>
    </head>
    <body>
        <!-- CABEÇALHO -->
        <header>
            <!-- CENTRALIZAR O CABEÇALHO -->
            <div id="center">
                <!-- LOGO DO SITE -->
                <div id="logo">
                    <a href="index.php">
                        <img src="imagens/logoMenor.png" title="Delícia Gelada" alt="Delícia Gelada">
                    </a>
                </div>
                <!-- MENU SUPERIOR PARA A NAVEGAÇÃO DAS PÁGINAS DO SITE -->
                <nav>
                    <div class="itens_menu">
                        <a href="modaDoVerao.php">
                            A moda do Verão
                        </a>
                    </div>
                    <div class="itens_menu">
                        <a href="importancia.php">
                            Importância
                        </a>
                    </div>
                    <div class="itens_menu">
                        <a href="promocoes.php">
                            Promoções
                        </a>
                    </div>
                    <div class="itens_menu">
                        <a href="ambientes.php">
                            Ambientes
                        </a>
                    </div>
                    <div class="itens_menu">
                        <a href="sucoDoMes.php">
                            Suco do Mês
                        </a>
                    </div>
                    <div class="itens_menu">
                        <a href="faleConosco.php">
                            Fale Conosco
                        </a>
                    </div>
                </nav>
            </div>
        </header>
        <div id="ajuste">

        </div>
        <!-- CONTEÚDO DO SITE -->
        <main id="area_conteudo">
            <div id="container">
                <!-- TÍTULO -->
                <div id="top">
                    <div class="linhas">

                    </div>
                    <div id="titulo">
                        <h1>FAQ</h1>
                    </div>
                    <div class="linhas">

                    </div>
                </div>
                <!-- INFORMAÇÕES DE ALTA IMPORTÂNCIA (ENDEREÇO DA NOSSA FÁBRICA E TELEFONES PRA CONTATO) -->
                <div id="info_adicionais">
                    Para mais informações, dúvidas ou sugestões entre em contato conosco através do telefone ou através do formulário ao lado. Retornaremos o mais breve possível e teremos o maior prazer em respondê-los.<br><br>

                    <b>Endereço: </b>Av. Elton Silva, 00 - Vinhedo - SP<br>
                    <b>Telefone: </b>011 1234-5678<br>
                </div>
                <!-- CRUD (ÁREA DESTINADA AO USUÁRIO PRA QUE ELE POSSA NOS MANDAR MENSAGENS DE CRÍTICAS OU SUGESTÕES DE MELHORIAS) -->
                <form name="frmFaleConosco" method="post" action="faleConosco.php">
                    <div id="crud">
                        <div class="divs">
                            <div class="labels">
                                *Nome:
                            </div>
                            <input class="inputs" onkeypress="return validarNumero(event, 'number')" type="text" name="txtNome" value="<?php echo($nome)?>" maxlength="100" size="45" pattern="[a-z A-Z ã Ã õ Õ é É í Í á Á ô Ô ç Ç]*" title="*** Digitação apenas de letras ***" required>
                        </div>
                        <div class="divs">
                            <div class="labels">
                                Telefone:
                            </div>
                            <input class="inputs" id="telefone" onkeypress="return validarNumero(event, 'caracter', 'telefone')" type="tel" name="txtTelefone" value="<?php echo($telefone)?>" maxlength="13" size="20" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}" placeholder="DDD XXXX-XXXX">
                        </div>
                        <div class="divs">
                            <div class="labels">
                                *Celular:
                            </div>
                            <input class="inputs" id="celular" onkeypress="return validarNumero(event, 'caracter', 'celular')" type="text" name="txtCelular" value="<?php echo($celular)?>" maxlength="14" size="20" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}" title="*** Apenas números são aceitos ***" placeholder="DDD XXXX-XXXX" required>
                        </div>
                        <div class="divs">
                            <div class="labels">
                                *E-mail:
                            </div>
                            <input class="inputs" type="email" name="txtEmail" value="<?php echo($email)?>" maxlength="90" size="45" required>
                        </div>
                        <div class="divs">
                            <div class="labels">
                                Home Page:
                            </div>
                            <input class="inputs" type="text" name="txtHomePage" value="<?php echo($homePage)?>" maxlength="90" size="45">
                        </div>
                        <div class="divs">
                            <div class="labels">
                                Link do Facebook:
                            </div>
                            <input class="inputs" type="text" name="txtLinkFacebook" value="<?php echo($linkFacebook)?>" maxlength="90" size="45">
                        </div>
                        <div class="divs">
                            <div class="labels">
                                Informações de Produtos:
                            </div>
                            <input class="inputs" type="text" name="txtInfoProdutos" value="<?php echo($infoProdutos)?>" maxlength="90" size="45" placeholder="Apenas 90 caractéres são aceitos">
                        </div>
                        <div class="divs">
                            <div class="labels">
                                *Sexo:
                            </div>
                            <input type="radio" name="rdoSexo" value="Masculino">Masculino
                            <input type="radio" name="rdoSexo" value="Feminino">Feminino
                        </div>
                        <div class="divs">
                            <div class="labels">
                                *Profissão:
                            </div>
                            <input class="inputs" type="text" name="txtProfissao" value="<?php echo($profissao)?>" maxlength="100" size="30" required>
                        </div>
                        <div id="div_textarea">
                            <div class="labels">
                                Sugestões/Críticas:
                            </div>
                            <textarea name="txtObs" cols="42" rows="7" maxlength="250" placeholder="Apenas 250 caractéres são aceitos"></textarea>
                            <div id="btnEnviar">
                                <input id="botao" type="submit" name="btnEnviar" value="Enviar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <!-- RODAPÉ -->
        <footer>
            <div id="centralizar">
                <div id="trabalheConosco">
                    <h1>Faça seu contato conosco</h1>
                </div>
                <div id="linha">
                    
                </div>
                <div id="texto">
                    Estamos sempre prontos para atendê-los
                </div>
                <div id="atendimento">
                    <h4>Atendimento de Qualidade</h4>
                    <p>Todos nesta empresa têm o compromisso de prestar o melhor atendimento aos nossos clientes. Caso esse objetivo não seja atendido, você tem a opção de entrar em contato conosco para sugerir melhorias.</p>
                </div>
                <div id="entrega">
                    <h4>Qualidade na Entrega</h4>
                    <p>Entregamos seu produto na data e horário marcado, com rapidez, qualidade e segurança que só a Polpa Doce tem a te oferecer.</p>
                </div>
                <!-- LINKS INTERNO DE TODAS AS PÁGINAS -->
                <div id="navegacao">
                    <ul class="estilo">
                        <li><a href="index.php" class="link">Home</a></li>
                        <li><a href="modaDoVerao.php" class="link">A moda do Verão</a></li>
                        <li><a href="importancia.php" class="link">Importância</a></li>
                        <li><a href="promocoes.php" class="link">Promoções</a></li>
                        <li><a href="ambientes.php" class="link">Ambientes</a></li>
                        <li><a href="sucoDoMes.php" class="link">Suco do Mês</a></li>
                    </ul>
                </div>
                <!-- BAIXE O NOSSO APLICATIVO -->
                <div id="pagamento">
                    <a href="#">
                        <img src="imagens/google.png" alt="Baixe o nosso Aplicativo" title="Baixe o nosso aplicativo direto no seu celular">
                    </a>
                </div>
            </div>
            <div id="img_fundo">
            
            </div>
        </footer>
        <div id="seguranca">
            <div id="direitos">
                © 2017 Delícia Gelada - Todos os direitos reservados
            </div>
        </div>
    </body>
</html>