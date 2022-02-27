<?php

/** comptage des points d'acces */
function struct_don1($file){
 $tab = [];
 $line = file($file, FILE_SKIP_EMPTY_LINES);
 foreach ($line as  $l) {
   $tab_l = explode(",",trim($l));
   if(isset($tab_l[4])){
     $tab_l = ["name"=> $tab_l[0],"adresse"=>$tab_l[1],"adresse_sup"=>$tab_l[2],"longitude"=>$tab_l[3],"latitude"=>$tab_l[4]];
   }
   else{
     $tab_l = ["name"=> $tab_l[0],"adresse"=>$tab_l[1],"longitude"=>$tab_l[2],"latitude"=>$tab_l[3]];
   }
   $tab[]=$tab_l;
 }
 return $tab;

}
function smart_curl($url, $verb, $post_argument = -1){
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  if($verb != -1){
    if($post_argument == -1){
      echo "Erreur, pas d'argument post";
      return -1;
    }
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $post_argument);
  }

  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}

function comptage_php($file){
  $tab = struct_don1($file);
  echo "Ce fichier contient " . count($tab) . " points d'accès \n";
}

function struct_don2($file){
  $tab = [];
  if (($handle = fopen("file", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if(isset($data[4])){
        $data = ["name"=> $tab_l[0],"adresse"=>$tab_l[1],"adresse_sup"=>$tab_l[2],"longitude"=>$tab_l[3],"latitude"=>$tab_l[4]];
      }
      else{
        $data = ["name"=> $tab_l[0],"adresse"=>$tab_l[1],"longitude"=>$tab_l[2],"latitude"=>$tab_l[3]];
      }
      $tab[]=$data;
}
 fclose($handle);
}
}
function proximite($file, $mypoint){
  $tab = struct_don1($file);
  $res=[];
  foreach ($tab as $l) {
     echo "Point d'accès". l[0] ."de distance".distance($mypoint, $l);
     $cordpoint= ['lon'=>l["longitude"], 'lat'=>l["latitude"]];
     if(distance($mypoint, $cordpoint)<200){
      $res[]=[ "name"=>$l["name"] ,
                "distance "=> $distance($mypoint, $cordpoint),
              ];
   }
  }
  array_multisort($res);
  echo "les points d'acces à une distance inférieur à 200:";
  print_r($res);
  echo "le point d'acces le plus proche est :".res[0]["name"]."de distance".res[0]["distance"];
}
function proximiteTopN($file, $mypoint , $N ){
  $tab = struct_don1($file);
  $res=[];
  foreach ($tab as $l) {
    $cordpoint= ['lon'=>l["longitude"], 'lat'=>l["latitude"]]
    $d= distance($mypoint, $cordpoint);
    $res[]=[ "name"=>$l["name"] ,
              "distance "=> $distance($mypoint, $cordpoint),
            ];
    }
    array_multisort($res);
    $res=array_slice($res,0,5,true);
    echo "les".$N."points les plus proches:";
    print_r($res);
}
    function geocodage($point,$file){
      $url = "https://api-adresse.data.gouv.fr/reverse/?lon=" . $point['lon'] . "&lat=" . $point['lat'];
      $verb = -1;
      $rep = smart_curl($url, $verb);
      $rep = json_decode($rep);
       if(!isset($rep->features[0]->properties->label)){
          return -1;
       }
      $adress = $rep->features[0]->properties->label;
      $index = search_adress_csv($point,$csv, $array);
      if($index != []){
         add_adress_csv($adress, $index, $csv, $array);
       }
      return $adress;
    }
