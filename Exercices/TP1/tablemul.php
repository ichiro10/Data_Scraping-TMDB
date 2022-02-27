<!DOCTYPE html>
<html>
<head>
    <style>
    <?php include 'tablemul.css'; ?>
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablemul</title>
</head>
<body>
    <div class="card">
       <div class="card-body">
          <p class="card-text"><b>Lignes</b> : <?php echo $_GET['Lignes']; ?></p>
          <p class="card-text"><b>Colonnes</b> : <?php echo $_GET['Colonnes']; ?></p>;

        </div>
    </div>    
    <?php
    if (!isset($_GET['Lignes'])){
        $L=10;
       }
       else{
           $L= $_GET['Lignes'];
       }
    if (!isset($_GET['Colonnes'])){
        $C=10;
       }
       else{
           $C= $_GET['Colonnes'];
       }
    ?>
    <table>
        <?php
        echo "<tr>";
        
           {
             echo "<th colspan=$C>Table de multiplication </th>";
           }   
        for($i=1;$i<=$L;$i++){
        echo "<tr>";
          {
          for($j=1;$j<=$C;$j++){    
            echo "<td> $j * $i = ".$j*$i."</td>";
          }
          echo "</tr>";
          }
        }  

        ?>
    </table>
    
</body>
</html>