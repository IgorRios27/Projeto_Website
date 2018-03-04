<?php
    session_start(); // ATIVA NO php O USO DAS VARIÁVEIS DE SESSÃO

    ///// INCLUSÃO DO ARQUIVO conexaoDB.php NA PÁGINA ATUAL
    require_once('conexaoBanco.php');

    ///// CHAMA A FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS QUE FOI CRIADO NA PÁGINA conexaoBD.php
    ConexaoBanco();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    

?>
<html>
    <head>
        <title>CMS | Controle Estatístico</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/jpg" href="imagens/config.png"/>
        <link rel="stylesheet" type="text/css" href="css/styleGrafico.css">
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
                    <a href="cadastroProdutos.php">
                        <img src="imagens/setaEsquerda.png" alt="Voltar">
                    </a>
                </div>
                <p id="desc_cad">Gráfico Estatístico - Top 5 dos produtos mais vistos</p>
            </div>
            <!-- GRÁFICO ESTATÍSTICO -->
            <div id="div_grafico">
                <table>
                    <?php
                        $sqlSUM = "select sum(clickProduto) as total from tbl_produto;";
                        $selectSUM = mysql_query($sqlSUM);
                        
                        $total_click = "";
                    
                        if($rsTotal=mysql_fetch_array($selectSUM)){
                            $total_click = $rsTotal['total'];
                        }
                    
                        $sql="select * from tbl_produto order by clickProduto desc limit 5";
                        $select = mysql_query($sql);
                        
                        while($rs=mysql_fetch_array($select)){
                                
                            $clicks = $rs['clickProduto'];
                            $width = $clicks*100/$total_click;
                        ?>
                        <tr>
                            <td style="width:41%;">
                                <?php echo(utf8_encode($rs['nomeProduto']))?>
                            </td>
                            <td style="width:70%;"> 
                                <div style="width:<?php echo($width.'%')?>; height:30px; background-color:#ffa31a;">
                                    
                                </div>
                            </td>
                            <td style="width:15%;">
                                <?php echo round($width).'%'?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                </table>
            </div>
            <!-- RODAPÉ DO CMS -->
            <div id="rodape">
                <div id="center">
                    <p id="desc_rodape">Desenvolvido por João Victor Gonçalves</p>
                </div>
            </div>
        </div>
    </body>
</html>