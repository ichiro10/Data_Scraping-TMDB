<?php
require_once("tp3-helpers.php");

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
