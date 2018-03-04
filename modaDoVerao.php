<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $titulo = null;
    $ingrediente = null;
    $modoPreparo = null;
    $beneficio = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>A moda do Verão | Delícia Gelada</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleModaDoVerao.css">
        <link rel="icon" type="image/jpg" href="imagens/icones/photo.png"/>
        <script type="text/javascript" src="js/"></script>
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
        <div id="verao">
            <div>
                <!--<div>
                    Moda Do Verão
                </div>-->
            </div>
        </div>
        <!-- CONTEÚDO DO SITE -->
        <main id="area_conteudo">
            <!-- UMA BREVE INTRODUÇÃO SOBRE O VERÃO E UMA IMAGEM AO LADO -->
            <div id="introducao">
                <div id="txt">
                    Durante o verão,  todo mundo gosta de tomar um suco refrescante e geladinho, não é mesmo? E se você soubesse fazer algumas receitas de sucos funcionais para te deixar mais bonita(o) e cheia(o) de saúde? <br>Confira a seguir, algumas receitas de sucos funcionais para o verão, e que você possa fazer em casa.
                </div>
                
                <div id="capa">
                    <img src="imagens/verao.png" title="Verão" alt="Verão">
                </div>
            </div>
            <div id="line">
                
            </div>
            <!-- DIV PRA CENTRALIZAR O CONTEÚDO -->
            <div id="central">
                
                <!-- ESTRUTURA DE REPETIÇÃO PARA CADASTRAR RECEITAS -->
                <?php
                
                    ///// PEGA TODOS OS REGISTROS CADASTRADOS NO BANCO DE DADOS
                    $sql = "SELECT * FROM tbl_moda_verao;";
                    $select=mysql_query($sql);
                               
                    while($rsConsulta = mysql_fetch_array($select)){
                        
                ?>
                <div id="suco_um">
                    <div id="img_couve">
                        <img src="CMS/<?php echo($rsConsulta['imagem'])?>" alt="Receitas" width="100%" height="100%">
                    </div>
                    <div class="desc">
                        <!-- RECEITA DETOX COUVE COM LIMÃO -->
                        <div class="titulo_receita">
                            <p class="titulos"><?php echo(utf8_encode($rsConsulta['titulo'])) ?></p><br>
                        </div>
                        
                        <div class="ingrediente_receita">
                            <h3>Ingredientes<br></h3>

                            <?php echo(utf8_encode($rsConsulta['ingrediente'])) ?>
                        </div>
                        
                        <div class="modo_preparo_receita">
                            <h3>Modo de Preparo<br></h3>

                            <p class="preparo"><?php echo(utf8_encode($rsConsulta['modoPreparo'])) ?></p><br>
                        </div>
                                  
                        <div class="beneficio_receita">
                            <h3>Benefícios<br></h3>

                            <p class="preparo"><?php echo(utf8_encode($rsConsulta['beneficio'])) ?></p>
                        </div>
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
                    <h4 id="qualidade">
                        Qualidade na Entrega
                    </h4>
                    <p>Entregamos seu produto na data e horário marcado, com rapidez, qualidade e segurança que só a Polpa Doce tem a te oferecer.</p>
                </div>
                <!-- LINKS INTERNO DE TODAS AS PÁGINAS -->
                <div id="navegacao">
                    <ul class="estilo">
                        <li><a href="index.php" class="link">Home</a></li>
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