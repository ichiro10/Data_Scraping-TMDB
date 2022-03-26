<?php require_once("functions.php");?>
<!DOCTYPE HTML>

<html lang="fr">
 <head>
        <link rel="stylesheet" type="text/css" href="formulaire.css" />
        <title>Roles</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
 </head>
 <style>
        .centrer {
        text-align: center;
         }
    </style>

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
        <div class="formulaire">
            <p> Enter an id to get basic actor infos</p>
            <form method="get" action="traitement4.php">
                <ul>
                    <label for="Id">id</label> 
                    <input type="number" step="any" id="id" name="id" value="<?php echo $_GET['id'] ?>"/> <br /> <br />
                </ul> <br />
                <input type="submit" value="sent" />
            </form>
        </div>
        <?php if (isset($_GET['id'] ) ) {
            echo '<div class="table">';
            echo "<a href=\"https://www.themoviedb.org/person/".$_GET['id']."\">More info over on TMDB</a></td>";
            to_HTML_roles(get_roles_actor($_GET['id']));
            echo '</div>';
        }
     ?>
    </body>
