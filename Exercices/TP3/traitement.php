<?php
require_once("tp3-helpers.php");
$id = $_GET['index'];
$data1 = json_decode(tmdbget("movie/$id"));
$titre1=$data1->title;
$titre_original1=$data1->original_title;
if(isset($data1->tagline)){
    $tagline1=$data1->tagline;
};
$description1=$data1->overview;
$lien_page_pub1=$data1->homepage;
$langue_original=$data1->original_language;
$poster_path=$data1->poster_path; 
$data2 = json_decode(tmdbget("movie/$id",['language'=>"$langue_original"]));
$titre2=$data2->title;
$titre_original2=$data2->original_title;
if(isset($data2->tagline)){
    $tagline2=$data2->tagline;
};
$description2=$data2->overview;
$lien_page_pub2=$data2->homepage;
$data3 = json_decode(tmdbget("movie/$id",['language'=>"fr"]));
$titre3=$data3->title;
$titre_original3=$data3->original_title;
if(isset($data3->tagline)){
    $tagline3=$data3->tagline;
};
$description3=$data3->overview;
$lien_page_pub3=$data3->homepage;

$data4 = json_decode(tmdbget("movie/$id/videos",['language'=>"en-US"]));

$video_key= $data4->results[0]->key;

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
       <td><?php echo $titre2 ?></td>
       <td><?php echo $titre1 ?></td>
       <td><?php echo $titre3 ?></td>
    </tr>
    <tr>
       <th><?php echo"Titre original" ?></th>
       <td><?php echo $titre_original2 ?></td>
       <td><?php echo $titre_original1 ?></td>
       <td><?php echo $titre_original3 ?></td>
    </tr>
    <tr>
       <th><?php echo"Tag" ?></th>
       <td><?php echo $tagline2 ?></td> 
       <td><?php echo $tagline1 ?></td> 
       <td><?php echo $tagline3 ?></td>  
    </tr>
    <tr>
       <th><?php echo"Description" ?></th>
       <td><?php echo $description2 ?></td>
       <td><?php echo $description1 ?></td>
       <td><?php echo $description3 ?></td>
    </tr>
    <tr>
       <th><?php echo"Lien TMDB" ?></th>
       <td><?php echo $lien_page_pub2 ?></td>
       <td><?php echo $lien_page_pub1 ?></td>
       <td><?php echo $lien_page_pub3 ?></td>
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











