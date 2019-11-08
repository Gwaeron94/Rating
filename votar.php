<?php
    try {
        $pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "");
    } catch (PDOException $e) {
        echo "ERRO: ".$e->getMessage();
        exit;
    }

    // Verifica se foi enviado o id e o voto do filme.
    if(!empty($_GET['id']) && !empty($_GET['voto'])) {

        // intval garante que foram enviados números inteiros.
        $id = intval($_GET['id']);
        $voto = intval($_GET['voto']);

        // Verifica se o voto foi entre 1 e 5.
        if($voto >= 1 && $voto <= 5) {

            // Insere a nova nota ao banco de dados.
            $sql = "INSERT INTO votos SET id_filme = :id_filme, nota = :nota";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_filme", $id);
            $sql->bindValue(":nota", $voto);
            $sql->execute();

            // Atualiza o valor da média de notas do filme.
            $sql = "UPDATE filmes SET media = (select (SUM(nota)/COUNT(*)) from votos where votos.id_filme = filmes.id) WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            header("Location: index.php");
            exit;
        }
    }
?>