<?php
require_once("tp3-helpers.php");
$name= "The Lord of rings";
$data1 = json_decode(tmdbget("/search/collection", ["query" => $name]));
$id = $data1->results[0]->id;
$data2 = json_decode(tmdbget("collection/$id"));


$id1 = $data2-> parts[0]->id; 
$titre1 = $data2-> parts[0]->title;
$date_sortie1= $data2-> parts[0]->release_date; 
$id2 = $data2-> parts[1]->id; 
$titre2 = $data2-> parts[1]->title;
$date_sortie2= $data2-> parts[1]->release_date; 
$id3 = $data2-> parts[2]->id; 
$titre3 = $data2-> parts[2]->title;
$date_sortie3= $data2-> parts[2]->release_date; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films D'une Collection</title>
    <style>
        table
        {
           border-collapse: collapse;
        }
        td, th 
        {
           border: 1px solid black;
        }   
        img 
        {
            display :block;
            margin: 0px auto; 
        }
        .centrer {
        text-align: center;
        }
    </style>   
</head>
<body>
<h1 style="text-align:center">
    <b>Welcome to The Movie Database</b>
    </h1>
    <p  class="centrer">
      <img src="https://miro.medium.com/max/800/1*Y9-6_bh5a00rJWWoQ28NMQ.jpeg" />
    </p>

    <nav style="text-align:center">
      <a href="formulaire.html">MOVIES</a>
      &nbsp &nbsp &nbsp &nbsp
      <a href="traitement2.php">COLLECTION</a>
      &nbsp &nbsp &nbsp &nbsp
      <a href="traitement3.php">ACTORS OF A COLLECTION</a>
      &nbsp &nbsp &nbsp &nbsp
      <a href="traitement4.php">ROLE OF ACTORS</a>
  </nav>
  <br>
  <br>
<table>
    <caption>
        <?php echo "The Lord of the Rings Collection" ?>
    </caption>  
    <tr>
        <th>&nbsp;</th>
        <th> id </th>
        <th> Titre </th>
        <th> Date de sortie </th>
    </tr>
    <tr>
        <td>Film1</td>
        <td><?php echo "$id1" ?></td>
        <td><?php echo "$titre1" ?></td>
        <td><?php echo "$date_sortie1" ?></td>
    </tr>    
    <tr>
        <td>Film2</td>
        <td><?php echo "$id2" ?></td>
        <td><?php echo "$titre2" ?></td>
        <td><?php echo "$date_sortie2" ?></td>
    </tr>    
    <tr>
        <td>Film3</td>
        <td><?php echo "$id3" ?></td>
        <td><?php echo "$titre3" ?></td>
        <td><?php echo "$date_sortie3" ?></td>
    </tr>    
</body>
</html>








