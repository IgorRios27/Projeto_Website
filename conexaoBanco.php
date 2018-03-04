<?php
    ///// FUNÇÃO PARA CONECTAR COM O BANCO DE DADOS 
    function ConexaoBanco(){
        //$conexao = mysql_connect('192.168.0.2', 'pc1520172', 'senai127');
        $conexao = mysql_connect('localhost', 'root', 'bcd127');
        mysql_select_db('dbpc1520172');
    }
?>