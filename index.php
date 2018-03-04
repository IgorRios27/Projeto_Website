<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO

    ///// VARIÁVEIS NULAS
    $pesquisar = null;
    $usuario = null;
    $senha = null;
    $ifProduto = 0;
    $botao = "OK";
        
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['btnPesquisar'])){
    $pesquisar = $_POST['txtPesquisar'];
    $ifProduto = 1;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['click'])){
    
    $c = $_GET['click'];
    
    if($c = "ctd"){
        $ifProduto = 2;  
        $_SESSION['sub'] = $_GET['idSub'];
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

// AUTENTICAÇÃO

if(isset($_POST["btnOk"])){
   
    $usuario=$_POST['txtUsuario'];
    $senha=$_POST['txtSenha'];
    
    $sql = "SELECT * FROM tbl_usuario WHERE usuario='".$usuario."' AND senha='".$senha."';";
    $select = mysql_query($sql);
  
    if($rs = mysql_fetch_array($select)){
        
        ///// CRIA UMA VARIÁVEL DE SESSÃO GUARDANDO O NOME DO USUÁRIO PRA QUE NO CMS APAREÇA O NOME DE QUEM LOGOU NO SITE
        $_SESSION['usuario'] = $rs['nome'];
        $_SESSION['nivel'] = $rs['idNivel'];
        
        ///// REDIRECIONA PARA A PÁGINA PRINCIPAL DO CMS
        header('Location:CMS/home.php');
    }else{
        echo "<script type='text/javascript'>window.alert('Usuario ou Senha estão incorretos!')</script>";
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home | Delícia Gelada</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleHome.css">
        <link rel="stylesheet" type="text/css" href="css/styleModalDetalhe.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="icon" type="image/jpg" href="imagens/icones/photo.png"/>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/slider.js"></script>
        
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
                    url: "modalDetalhe.php",
                    data: {id:idIten},
                    success: function(dados){
                        $('.modal').html(dados);
                    }        
                });
            }
        </script>
    </head>
    <body>
        <!-- MODAL DETALHES DOS PRODUTOS -->
        <div class="modalContainer">
	       <div class="modal">
		      
	       </div>
        </div>	
        <!-- CABEÇALHO -->
        <header>
            <!-- CENTRALIZAR O CABEÇALHO -->
            <div id="center">
                <!-- ÁREA DE LOGIN -->
                <form name="frmLogin" method="post" action="index.php">
                    <div id="area_login" class="animated bounceInRight">
                        <div class="labels">
                            <div id="usuario">
                                Usuário:
                            </div>
                            <div id="senha">
                                Senha:
                            </div>
                        </div>
                        <!-- CAIXAS DE TEXTOS E BOTÃO -->
                        <div class="text">
                            <div id="text_usuario">
                                <input class="inputs" type="text" name="txtUsuario" value="<?php echo($usuario)?>" size="12" placeholder="Nome de usuário" maxlength="20">
                            </div>
                            <div id="text_senha">
                                <input class="inputs" type="password" name="txtSenha" value="<?php echo($senha)?>" size="12" placeholder="Apenas 8 dígitos" maxlength="8">
                            </div>
                            <div id="botao">
                                <input id="ok" type="submit" name="btnOk" value="<?php echo($botao)?>">
                            </div>
                        </div>
                    </div>
                </form>
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
        <!-- IMAGEM 100% QUE ESTÁ POSICIONADA ATRÁS DO SLIDER -->
        <div id="fundo">
            <!-- SLIDER -->
            <div id="galeria">
                <div id="buttons">
                    <a href="#" class="prev">&laquo;</a>
                    <a href="#" class="next">&raquo;</a>
                </div>
                <!-- IMAGENS DO SLIDER -->
                <ul>
                    <li><img src="imagens/slider/slide1.jpg" alt="Slider 1"></li>
                    <li><img src="imagens/slider/slide2.jpg" alt="Slider 2"></li>
                    <li><img src="imagens/slider/slide3.jpg" alt="Slider 3"></li>
                    <li><img src="imagens/slider/slide4.jpg" alt="Slider 4"></li>
                </ul>
            </div>
        </div>
        <!-- CONTEÚDO DO SITE -->
        <main id="area_conteudo">
            <!-- REDES SOCIAIS -->
            <div id="redes_sociais">
                <div class="social">
                    <img src="imagens/icones/facebook.png" title="Facebook" alt="Facebook">
                </div>
                <div class="social">
                    <img src="imagens/icones/instagram.png" title="Instagram" alt="Instagram">
                </div>
                <div class="social">
                    <img src="imagens/icones/twitter.png" title="Twitter" alt="Twitter">
                </div>
            </div>
            <!-- BUSCAR PRODUTOS -->
            <div id="linha_produtos">
                <form name="frmPesquisar" method="post" action="index.php">
                    <div id="centralizar_titulo">
                        <input class="input_pesquisar" type="text" name="txtPesquisar" value="<?php echo($pesquisar) ?>" placeholder="Buscar produtos" maxlength="20">
                        <div id="bot">
                            <input id="botao_pesquisar" type="submit" name="btnPesquisar" value="Pesquisar">
                        </div>
                    </div>
                </form>
            </div>
            <!-- MENU LATERAL DO SITE -->
            <div id="menu_lateral">
                <ul class="mainmenu">
                    <?php
                        $sql1 = "select * from tbl_categoria order by idCategoria desc";
                        $select1 = mysql_query($sql1);
                                       
                        while($rsConsulta1=mysql_fetch_array($select1)){
                    ?>
                    <li><a href="#"><p class="desc_menu"><?php echo(utf8_encode($rsConsulta1['categoria'])) ?></p></a>
                        <ul class="submenu">
                            <?php
                                $sql = "select * from tbl_subcategoria where idCategoria=".$rsConsulta1['idCategoria'];
                                $select = mysql_query($sql);

                                while($rsConsulta=mysql_fetch_array($select)){
                            ?>
                            <li><a href="index.php?click=ctd&idSub=<?php echo($rsConsulta['idSubcategoria']); ?>"><p class="desc_li"><?php echo(utf8_encode($rsConsulta['subcategoria'])) ?></p></a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <!-- PRODUTOS DO SITE -->
            <div id="nossos_produtos" class="animated bounceInUp">
              <!-- LISTAR PRODUTOS CADASTRADOS -->
                <?php
                    if($ifProduto == 0){
                        $sql = "SELECT * FROM tbl_produto order by rand() limit 6";
                    }else if($ifProduto == 1){
                        $sql="select * from tbl_produto where nomeProduto like '%$pesquisar%' or descricao like '%$pesquisar%'";
                    }else if($ifProduto == 2){
                        $sql = "SELECT * FROM tbl_produto WHERE idSubcategoria = ".$_SESSION['sub'];
                    }
            
                    $select=mysql_query($sql);        
                    while($rsConsulta = mysql_fetch_array($select)){
                ?>
                <div class="linha1">
                    <div class="pictures">
                        <img src="CMS/<?php echo($rsConsulta['imagem'])?>" alt="Produtos" width="100%" height="100%">
                    </div>
                    <div class="descricao">
                        <?php echo(utf8_encode($rsConsulta['nomeProduto'])) ?><br>
                        100% Natural<br>
                        R$ <?php echo($rsConsulta['preco']) ?>
                    </div>
                    <div class="botao">
                        <a class="ver" href="#" onclick="Modal(<?php echo($rsConsulta["idProduto"]) ?>)">
                            Detalhes
                        </a>
                    </div>
                </div>
                <?php
                    }
                ?>
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
                        <li><a href="modaDoVerao.php" class="link">A moda do Verão</a></li>
                        <li><a href="importancia.php" class="link">Importância</a></li>
                        <li><a href="promocoes.php" class="link">Promoções</a></li>
                        <li><a href="ambientes.php" class="link">Ambientes</a></li>
                        <li><a href="sucoDoMes.php" class="link">Suco do Mês</a></li>
                        <li><a href="faleConosco.php" class="link">Fale Conosco</a></li>
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