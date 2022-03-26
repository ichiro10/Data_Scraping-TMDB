<?php
require_once("tp3-helpers.php");



    function get_info($id, $language=null){
        $param = array("append_to_response" => "videos");
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
    function All_languages_info($id){
        $All=[];
        $All["OR"]=get_info($id );
        $All["ANG"]=get_info($id ,"eng");
        $All["FR"]=get_info($id ,"fr");
        return $All;
    }
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

    function get_actors() {
        $credits = [ "movie/120/credits" , "movie/121/credits", "movie/122/credits"];
        $actor_list= [];
        for($i=0;$i<3;$i++) {
            $output = tmdbget($credits[$i], null);
            $array_tmp=json_decode($output,true);
            foreach($array_tmp['cast'] as $actor) { 
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
                echo '<td><a href="traitement4.php?id='.$actor['id'].'">' . $actor['actor'] . "</a></td>";
                echo '<td>'.$actor['character'].'</td>';
                echo '<td>'.$actor['nb_occu'].'</td>';
                echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }


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
