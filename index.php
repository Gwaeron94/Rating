<?php
    try {
        $pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "");
    } catch (PDOException $e) {
        echo "ERRO: ".$e->getMessage();
        exit;
    }

    // Verifica o banco de dados e cria uma query com os filmes.
    $sql = "SELECT * FROM filmes";
    $sql = $pdo->query($sql);

    // Se existir algum filme, cria-se uma lista de filmes
    if($sql->rowCount() > 0) {
        foreach($sql->fetchAll() as $filme):
            ?>
            <fieldset>
                <strong> <?php echo $filme['titulo']; ?> </strong> <br/>
                <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=1"><img src="star.png" height="20" /></a>
                <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=2"><img src="star.png" height="20" /></a>
                <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=3"><img src="star.png" height="20" /></a>
                <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=4"><img src="star.png" height="20" /></a>
                <a href="votar.php?id=<?php echo $filme['id']; ?>&voto=5"><img src="star.png" height="20" /></a>
                ( <?php echo $filme['media']; ?> )
            </fieldset>
            <?php
        endforeach;
    } else {
        echo "Não há filmes cadastrados!";
    }
?>