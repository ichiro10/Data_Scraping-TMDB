<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailletab</title>
</head>
<body>  

        <form action="tablemul.php" method="get">
        <?php
        echo "Saisir le nombre de lignes et de colonnes de la table de multiplication" ;
        ?>
        <br />
        <label for="Lignes">Lignes</label> <input type="number" id="L" name="Lignes"/>
        <br />
        <label for="Colonnes">Colonnes</label> <input type="number" id="C" name="Colonnes"/>
        <br />
        <input type="submit" />
        
</body>
</html>