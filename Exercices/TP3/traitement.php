<?php
require_once("tp3-helpers.php");
require_once("functions.php");
$id = $_GET['index'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table
        {
           border-collapse: collapse;
        }
        td, th 
        {
           border: 1px solid black;
        }   
        .centrer {
        text-align: center;
    }
    </style>   
    <title>MOVIE</title>
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
      <a href="Q7-9.php">ACTORS OF A COLLECTION</a>
      &nbsp &nbsp &nbsp &nbsp
      <a href="actor.php">ROLE OF ACTORS</a>
   </nav>
   <?php 
            echo '<div class="table">';
            $All=All_languages_info($id);
            movie_to_html($All);
            echo '</div>';
     ?>
  
    
</body>     
</html>











