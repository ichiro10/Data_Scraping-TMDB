% PW-DOM  Compte rendu de TP

# Compte-rendu de TP

Sujet choisi : TMDB

## Participants 

*Ali GHAMMAZ


NB :
 On peut facilement basculer entre les differents parties demandés en TP en ouvrant la page d'acceuil TMDB homepage.php et choisir la fonctionnalité voulue : 
 
   -MOVIES : Affichage des informations d'un film par ID.
   
   -COLLECTION : Affichage des différents films de la collection The Lord of Ring .
   
   -ACTORS OF A COLLECTION : Affichage de tout les acteurs participant à la collection the lord of rings . 
   
   -ROLES OF ACTORS : Affichage de tout les roles joués par un acteur par son ID . 
   
   
1-format de réponse : JSON 
 film concerné : FIGHT CLUB 
 
 Version française:  
 On ajoute à la fin du l'URL : &language=fr
 
  http://api.themoviedb.org/3/movie/550?api_key=ebb02613ce5a2ae58fde00f4db95a9c1&language=fr
   
   
   
   
2- Pour afficher le résultat en terminal , on utilise la fonction tmdbget donné dans le fichier helper avec parametre de fonction : movie/550 





3-4( fichiers formulaire.php et traitement.php)
A l'aide d'un formulaire "formulaire.html" on demande l'ID d'un film , 
cet ID est par la suite récupérer à travers  $id=GET['id'] . 
En se basant sur l'URL :
  http://api.themoviedb.org/3/movie/550 api_key=ebb02613ce5a2ae58fde00f4db95a9c1 
  
  On se sert de 3 fonctions implémentés dans functions.php 
  la 1ere : get_info($id, $language=null)
  permet de créer un tableau associative selon le language entré en paramètre . ce tableau contient les differents champs identifiant un film . 
  
  la 2ème :All_languages_info($id)
  permet de créer un tableau contenant les informations d'un films en 3 versions : originale , anglaise et francaise .
  
  la 3ème: movie_to_html($All) 
  Permet d'afficher le tableau recuperer par la fonction precedente en une table html . 
  
  
  
  
  
5-Image : ( fichier traitement.php)
   Pour savoir les tailles des posters autorisées : 
    https://api.themoviedb.org/3/configuration?api_key=ebb02613ce5a2ae58fde00f4db95a9c1
    
  => poster_sizes": [
      "w92",
      "w154",
      "w185",
      "w342",
      "w500",
      "w780",
      "original"
    ],
    
    
    On choisit donc une taille réduite de : w154 
    pour afficher le poster du film on récupere $poster_path contenue dans les données du film deja récuperés 
    puis on ajoute une derniere colonne dans notre table hmtl en mettant : <img src= <?php echo"https://image.tmdb.org/t/p/w154/".$poster_path?> >
    
    
    
    
    
    
  6-voir le fichier traitement2.php et function.php
  On récupère l'ID de la collection "The Lord Of Rings" par : 
  
  $data1 = json_decode(tmdbget("/search/collection", ["query" => $name]));
$id = $data1->results[0]->id;

Ensuite on retrouve l'ID de chaque film de la collection à travers l'instruction : 
$data2 = json_decode(tmdbget("collection/$id"));

On implémente donc dans une table html les informations de chaque film trouvé dans la collection . 

On se sert de 2 fonctions l'une get_moviesofcollection() permet de retrouver l'id de chaque film de la colletion stocker ses informations (id , titre , date de sortie ) dans un tableau . 

ensuite , on utilise la fonction moviesocollection_tohtml($Collection)
pour afficher le tableau $collection fournit par la fonction précédente en une table html.






7-(fichier traitement3.php)

 Dans la fichier functions.php on implémente la fonction get_actors()
 qui permet de créer un tableau de tout les acteurs de la collection "The Lord of rings" avec leur nom , role et nombre de film joué dans cette collection .  
  les ID des trois film de la collection sont : 120 , 121, 122 
  les informations des acteurs de chaque film sont contenues dans l'URL 
  : https://api.themoviedb.org/3/movie/<<ID>>/credits?api_key=ebb02613ce5a2ae58fde00f4db95a9c1
  
  En cas d'un acteur qui a jouer dans plusieurs film on incrémente la valeur du champs concernant nombre de film par l'instruction : 
     if (array_key_exists($actor['name'], $actor_list) !=false ) {
                    $actor_list[$actor['name']]['nb_occu']++;
                }
  la function to_html permet ensuite d'afficher les données retournées par la fonction précédente en page html .               
                
                
                
                
                
 8-On peut afficher que les acteurs dont le nom du personnage joué contient "hobbit". Par exemple "Kissing Hobbit" joué par Zo Hartley pourra être affiché alors qu'on peut afficher "Frodo" joué par Elijah Wood.
 
 
 
 
 
 9-(fichier traitement4.php) 
 Dans la liste des acteurs, pour transformer chaque acteur en lien-rebond donnant la liste des films auxquels il a participé , on utilise l'instruction : 
 <a href="traitement4.php?id='.$actor['id'].'">'
 Comme à la question 7 nous disposons de 2 fonctions une pour l'affichage en mode html et l'autre pour afficher tout les roles joués par l'acteur en donnant son ID . 
 
 On utilise cette fois-ci l'URL :
 
  https://api.themoviedb.org/3/person/{person_id}/movie_credits?api_key=<<api_key>>&language=en-US
  
  la fonction retourne un tableau contenant la films joués par cet acteur , le son role dans ce film et l'aperçu de ce film . 
  
  on place dans le fichier traitement4.php un formulaire permettant d'avoir l'ID d'un acteur et donc faire appel aux 2 fonctions précédentes pour l'affichage des résultats . 
  
  
  
  
  
 10- Pour rajouter la bande d'annonce dans l'information d'un film , 
 on ajoute une dernier ligne nommé Trailer puis on utilise l'instruction : 
 
 <iframe src=<?php echo"https://www.youtube.com/embed/".$video_key?>
 
 le paramètre $video_key est récupéré lors du chargement des données $data du film en question ,  en utilisant: 
 
 $video_key= $data->results[0]->key;
 
    
    
  
  
 
 
  


 

  
  

   

