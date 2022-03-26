<?php
require_once("tp3-helpers.php");
require_once("functions.php");
$id = $_GET['index'];
$data1 = json_decode(tmdbget("movie/$id"));
$data2 = json_decode(tmdbget("movie/$id/videos",['language'=>"en-US"]));

$video_key= $data2->results[0]->key;
$poster_path=$data1->poster_path; 


$All=All_languages_info($id);
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

  <table>
    <caption>
        <?php echo "Informations sur le film d'identifiant:"."$id" ?>
    </caption>  
    <br>
    <tr>
        <th>&nbsp;</th>
        <th>VO</th>
        <th>VANG</th>
        <th>VF</th>
    </tr>
    </br>      
    <tr>
       <th><?php echo"Titre" ?></th>
       <td><?php echo $All["OR"]['title'] ?></td>
       <td><?php echo $All["ANG"]['title'] ?></td>
       <td><?php echo $All["FR"]['title'] ?></td>
    </tr>
    <tr>
       <th><?php echo"Titre original" ?></th>
       <td><?php echo $All["OR"]['originale_title'] ?></td>
       <td><?php echo $All["ANG"]['originale_title'] ?></td>
       <td><?php echo $All["FR"]['originale_title'] ?></td>
    </tr>
    <tr>
       <th><?php echo"Tag" ?></th>
       <td><?php echo $All["OR"]['tagline']?></td> 
       <td><?php echo $All["ANG"]['tagline'] ?></td> 
       <td><?php echo $All["FR"]['tagline'] ?></td>  
    </tr>
    <tr>
       <th><?php echo"Description" ?></th>
       <td><?php echo $All["OR"]['description'] ?></td>
       <td><?php echo $All["ANG"]['description'] ?></td>
       <td><?php echo $All["FR"]['description'] ?></td>
    </tr>
    <tr>
       <th><?php echo"Lien TMDB" ?></th>
       <td><?php echo $All["OR"]['link'] ?></td>
       <td><?php echo $All["ANG"]['link'] ?></td>
       <td><?php echo $All["FR"]['link'] ?></td>
    </tr>
    <tr>
        <th><?php echo"Poster" ?></th>
        <td colspan="3" ><img src= <?php echo"https://image.tmdb.org/t/p/w342/".$poster_path?> ></td>

    </tr>  
    <tr>
        <th><?php echo"Trailer" ?></th>
        <td colspan="3"   ><iframe src=<?php echo"https://www.youtube.com/embed/".$video_key?>
             height="600" width="1000" allowfullscreen=""></iframe>
                    </td>

    </tr>  
</table>
    
</body>     
</html>











