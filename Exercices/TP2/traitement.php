<?php

$csv = $argv[1];

/** comptage des points d'acces */
function struct_don1($file){
 $tab = [];
 $line = file($file, FILE_SKIP_EMPTY_LINES);
 foreach ($line as  $l) {
   $tab_l = explode(",",trim($l));
   if(isset($tab_l[4])){
    $tab_l[1] = trim(trim($tab_l[1], '"'));
    $tab_l[2] = trim(trim($tab_l[2], '"'));
    $tab_l = ["name"=> $tab_l[0],"adresse"=>  $tab_l[1],"adresse_sup"=> $tab_l[2],"longitude"=>$tab_l[3],"latitude"=>$tab_l[4]];
   }
   else{
     $tab_l = ["name"=> $tab_l[0],"adresse"=>$tab_l[1],"longitude"=>$tab_l[2],"latitude"=>$tab_l[3]];
   }
   $tab[]=$tab_l;
 }
 return $tab;

}

print_r(struct_don1($csv));
echo "Structuration des données terminée (M1)\n";

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
  if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $addrs = explode(",",$data[1]);
      $addrs[0] = trim($addrs[0]);

      if(count($addrs) != 1){
        $addrs[1] = trim($addrs[1]);
        $data = ["name"=> $data[0],"adresse"=>$addrs[0],"adresse_sup"=>$addrs[1],"longitude"=>$data[2],"latitude"=>$data[3]];
      }
      else{
        $data = ["name"=> $data[0],"adresse"=>$data[1],"longitude"=>$data[2],"latitude"=>$data[3]];
      }
      $tab[]=$data;
    }
    fclose($handle);
  }
  return $tab;
}

print_r(struct_don2($csv));
echo "Structuration des données terminée (M2)\n";

echo struct_don1($csv) == struct_don2($csv) ? "Les deux structures sont identiques" : "Les deux structures sont différentes";
echo "\n";

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
    $cordpoint= ['lon'=>l["longitude"], 'lat'=>l["latitude"]];
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
