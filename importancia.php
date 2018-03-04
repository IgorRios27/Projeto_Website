<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO
    
    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $titulo = null;
    $texto = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Importância | Delícia Gelada</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleImportancia.css">
        <link rel="icon" type="image/jpg" href="imagens/icones/photo.png"/>
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
        <!-- BANNER DE SUCOS -->
        <div id="banner">
            <img src="imagens/bannerImportancia.jpg" alt="Important">
        </div>
        <!-- CONTEÚDO DO SITE -->
        <main id="area_conteudo">
            <!-- TÍTULO QUE SERÁ ABORDADO -->
            <div id="titulo_importancia">
                <h1 id="important">A Importância dos Sucos Naturais para a Saúde</h1>
            </div>
            <!-- TEXTO QUE INFORMA A IMPORTÂNCIA DOS SUCOS NATURAIS PARA A SAÚDE -->
            <div id="conteudo">
                <div id="texto">
                    <p id="txt">Beber líquidos no verão é essencial para repor a perda que temos durante o dia ao realizar as atividades. No calor, transpiramos muito e nada mais saudável e refrescante do que beber uma bebida gelada. Sem comparações, a água é a bebida mais indicada, mas existem outros tipos de bebidas que hidratam e repõem nutrientes como a água de côco, chás e os sucos de frutas naturais.<br>

                    O suco natural de frutas deve ser a principal opção ao invés de refrigerantes e bebidas artificiais, pois é uma fonte de vitaminas e minerais ao contrário dessas outras opções. Se o suco de fruta não for coado e ingerido logo após seu preparo, ótimo, mas se não for possível congele-o. Um pouco dos nutrientes são perdidos neste processo mas ainda assim é uma opção melhor do que outras bebidas industrializadas.<br>

                    Além disso, muitos vegetais crus exercem o papel de desintoxicação do nosso corpo, pois auxiliam  na eliminação destas toxinas, além de fornecerem vitalidade, energia, água , enzimas, vitaminas, sais minerais e fibras naturais. O benefício de ingerir frutas, legumes, sementes, raízes e hortaliças em forma de suco está na praticidade, e é um aliado para quem não gosta deste tipo de alimento.<br><br>

                    <b>Ao introduzir sucos naturais em sua dieta diária, você perceberá melhoras em sua saúde. Entre os benefícios, o suco de fruta:<br></b></p>

                    <ul id="list">
                        <li>Melhora o desempenho físico e cardiovascular.</li>
                        <li>Diminui a pressão arterial.</li>
                        <li>Proporciona um sono com mais qualidade, mais energia e menos estresse.</li>
                        <li>Controla a temperatura corporal.</li>
                        <li>Transporta as fibras que estimulam o trabalho do intestino.</li>
                        <li>Auxilia no funcionamento dos rins e favorece a digestão.</li>
                        <li>Favorece uma pele mais bonita e viçosa, pois os líquidos ajudam a varrer as toxinas que se acumulam no organismo.</li>
                        <li>Melhora o sistema imunológico.</li>
                    </ul>
                </div>
                <div id="img_um">
                    <img src="imagens/frutas.jpg" title="Frutas" alt="Frutas" width="100%" height="100%">
                </div>
            </div>
            <!-- LINK INTERNO PARA QUE O USUÁRIO POSSA CONFERIR AS RECEITAS DISPONÍVEIS NO NOSSO SITE QUE ESTÁ LOCALIZADA NA PÁGINA ANTERIOR (MODA DO VERÃO) -->
            <div id="veja_tambem">
                <a href="modaDoVerao.php" id="clique">Clique aqui</a> e confira algumas de nossas receitas de Sucos Funcionais
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
                <div id="text">
                    Estamos sempre prontos para atendê-los
                </div>
                <div id="atendimento">
                    <h4 class="titles">Atendimento de Qualidade</h4>
                    <p class="classe">Todos nesta empresa têm o compromisso de prestar o melhor atendimento aos nossos clientes. Caso esse objetivo não seja atendido, você tem a opção de entrar em contato conosco para sugerir melhorias.</p>
                </div>
                <div id="entrega">
                    <h4 class="titles">Qualidade na Entrega</h4>
                    <p class="classe">Entregamos seu produto na data e horário marcado, com rapidez, qualidade e segurança que só a Polpa Doce tem a te oferecer.</p>
                </div>
                <!-- LINKS INTERNO DE TODAS AS PÁGINAS -->
                <div id="navegacao">
                    <ul class="estilo">
                        <li><a href="index.php" class="link">Home</a></li>
                        <li><a href="importancia.php" class="link">A moda do Verão</a></li>
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