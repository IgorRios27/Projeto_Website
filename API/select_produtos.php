<?php
    $conexao = mysqli_connect("localhost", "root", "bcd127", "dbpc1520172");
    $sql = "SELECT * FROM tbl_produto;";

    $resultado = mysqli_query($conexao, $sql);

    $listarProdutos = array();

    if(mysqli_num_rows($resultado) > 0){
        
        while($produto = mysqli_fetch_assoc($resultado)){
            $listarProdutos [] = $produto;
        }
        echo json_encode($listarProdutos);
    }
?>