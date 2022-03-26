<?php
require_once("tp3-helpers.php");

/*
 Paramètre : $id = identifiant du film 
             $language= la version de la langue d'affichage des information 
 Valeur de retour : $info = tableau associatif contenant les informations du film d'identifiant id
  selon le language choisie

*/

    function get_info($id, $language=null){
        $param = array("append_to_response" => "videos");
        // si $language is not set => les données seront en language par défaut
        if (!isset($language))
              $data = json_decode(tmdbget("movie/" . $id, $param));
        else {
          $param["language"] = $language;
           echo "<br/>";
          $data = json_decode(tmdbget("movie/" . $id, $param));
        }

        $info = [];
        $info["title"]=$data->title;
        $info["originale_title"]=$data->original_title;
        if(isset($data->tagline)){
           $info["tagline"]=$data->tagline;
        }
        $info["description"]=$data->overview;
        $info["link"] = "https://www.themoviedb.org/movie/" . $id. "-" . str_replace(" ", "-", $info["original_title"]);
        $info["poster_path"]="https://image.tmdb.org/t/p/w154/" . $data->poster_path; 
        $data2 = json_decode(tmdbget("movie/$id/videos",['language'=>"en-US"]));
        $info["video_key"]= "https://youtube.com/embed/" . $data2->results[0]->key;
        return $info;

    }

/*
 Paramètre : $id = identifiant du film 

 Valeur de retour : $All = tableau associatif contenant tout les versions de langues (Originale , anglaise , francaise)

*/


    function All_languages_info($id){
        $All=[];
        $All["OR"]=get_info($id );
        $All["ANG"]=get_info($id ,"eng");
        $All["FR"]=get_info($id ,"fr");
        return $All;
    }


 /*
 Affichage en HTML  */   
    function movie_to_html($All){
        echo '<table>';
        echo '<caption>'."Informations sur le film:".'</caption>';
        echo '<br>';
        echo '<tr>';
        echo '<th>'."&nbsp;".'</th>';
        echo '<th>'."VO".'</th>';
        echo '<th>'."VANG".'</th>';
        echo '<th>'."VF".'</th>';
        echo '</br>';
        foreach (array_keys($All["OR"]) as $key) {
          echo '<tr>';
          if ($key == "link") {
              echo '<th>'."link".'</th>';
              foreach ($All as $language)
                  echo "<td><a href=" . $language[$key] . ">" . $language[$key] . " </a></td>";
          } else if($key == "poster_path") {
              echo '<th>'."Poster".'</th>';
              foreach ($All as $language)
                  echo "<td><img src=" . $language[$key] . "></img></td>";
          } else if($key == "video_key") {
              echo '<th>'."Trailer".'</th>';
              foreach ($All as $language)
                  echo "<td><iframe height='315' width='420' src='" . $language[$key] . "'> </iframe></td>";
          } else {
              echo '<th>'.$key.'</th>';
              foreach ($All as $language)
                  echo "<td>" . $language[$key] . "</td>";
          }
          echo "</tr>";
      
      }
      echo "</table>";
    }

    function get_moviesofcollection(){
        $name= "The Lord of rings";
        $data1 = json_decode(tmdbget("/search/collection", ["query" => $name]));
        /*on recupere l'id de la collection , puis à travers cet id on va recuperer les informations de chaque film de cet collection
        notamment leur identifiants  */
        $id = $data1->results[0]->id;
        $data2 = json_decode(tmdbget("collection/$id"));
        $Collection=[];
        for($i=0 ; $i<=2 ; $i++){
            $film=[];
            $film["id"]=$data2-> parts[$i]->id;
            $film["title"]=$data2->parts[$i]->title;
            $film["date_sortie"]=$data2-> parts[$i]->release_date;
            $Collection[]=$film; 
        }
        /*on recupere les données de chaque films de cette colletion id , title , date de sortie  */
        return $Collection;


    }
/*affichage en html de l'ensemble des films de la collection */
    function moviesocollection_tohtml($Collection){
        echo '<table>';
        echo '<caption>'."Informations sur le film:".'</caption>';
        echo '<br>';
        echo '<tr>';
        echo '<th>'."&nbsp;".'</th>';
        echo '<th>'."ID".'</th>';
        echo '<th>'."Titre".'</th>';
        echo '<th>'."Date de sortie".'</th>';
        echo '</br>';
        for($i=0 ; $i<=2 ; $i++){
            $a=$i+1;
            echo '<tr>';
            echo '<th>'."film".$a.'</th>';
            echo '<td>'.$Collection[$i]["id"].'</td>';
            echo '<td>'.$Collection[$i]["title"].'</td>';
            echo '<td>'.$Collection[$i]["date_sortie"].'</td>';
            echo "</tr>";
        }
        echo "</table>";

    }

    function get_actors() {
        /**on recupere pour chaque film de la collection des information sur ses acteurs  */
        $credits = [ "movie/120/credits" , "movie/121/credits", "movie/122/credits"];
        $actor_list= [];
        for($i=0;$i<3;$i++) {
            $output = tmdbget($credits[$i], null);
            $array_tmp=json_decode($output,true);
            foreach($array_tmp['cast'] as $actor) { 
                //au cas ou l'acteur existe deja en actant dans un autre film de la collection on fait que incrementer son nombre de film 
                if (array_key_exists($actor['name'], $actor_list) !=false ) {
                    $actor_list[$actor['name']]['nb_occu']++;
                }
                else {
                    $actor_list[$actor['name']] = 
                    [ 'actor' => $actor['name'] , 
                      'character' => $actor['character'] , 
                      'nb_occu' => 1 ,
                      'id' => $actor['id'] ]  ;
                }
            }
        }
        return $actor_list;
    }
// affichage des information des acteurs de la collection en html 
    function to_html_actors($actor_list) {
        echo '<table>';
        echo '<thead><tr>';
        echo '<th>'."Actor".'</th>';
        echo '<th>'."Character(s)".'</th>';
        echo '<th>'."Nb of appearances ".'</th>';
        echo '</tr></thead>';
        echo '<tbody>';
        foreach($actor_list as $actor) {
                echo '<tr>';
                //chaque nom d'acteur est un lien  redondant vers la page de l'ensemble des roles de cet acteur 
                echo '<td><a href="traitement4.php?id='.$actor['id'].'">' . $actor['actor'] . "</a></td>";
                echo '<td>'.$actor['character'].'</td>';
                echo '<td>'.$actor['nb_occu'].'</td>';
                echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

/*affichage de l'ensemble de roles joué par un acteur à travers son ID  
la valeur de retour est un tableau associatif contenant le nom du film , son role et une description */
    function get_roles_actor($id) {
        $person = "person/".$id."/movie_credits";
        $movie_list= [];
        $output = tmdbget($person, null);
        $array_tmp=json_decode($output,true);
        foreach($array_tmp['cast'] as $movie) { 
            array_push($movie_list, [ 'movie' => $movie['title'], 'role' => $movie['character'], 'overview' => $movie['overview']]);
        }
        foreach($array_tmp['crew'] as $movie) { 
            array_push($movie_list, [ 'movie' => $movie['title'], 'role' => $movie['job'], 'overview' => $movie['overview']]);
        }
        return $movie_list;
    }
//affichage des roles d'un acteur en html 
    function to_html_roles($actor_movie_list) {
        echo '<table>';
        echo '<thead><tr>';
        echo '<th>'."Movie".'</th>';
        echo '<th>'."Role".'</th>';
        echo '<th>'."Overview".'</th>';
        echo '</tr></thead>';
        echo '<tbody>';
        foreach($actor_movie_list as $movie) {
                echo '<tr>';
                echo '<td>'.$movie['movie'] . '</td>';
                echo '<td>'.$movie['role'].'</td>';
                echo '<td>'.$movie['overview'].'</td>';
                echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
?>
