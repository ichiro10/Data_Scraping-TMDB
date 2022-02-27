

<h1>Message bien reçu !</h1>

        
<div class="card">
    
    <div class="card-body">
        <p class="card-text"><b>Somme</b> : <?php echo $_GET['Somme']; ?></p>
        <p class="card-text"><b>Taux</b> : <?php echo $_GET['Taux']; ?></p>
        <p class="card-text"><b>Durée</b> : <?php echo $_GET['Durée']; ?></p>;
        <p class="card-text"><b>Cumul</b> : <?php 
        include 'libcalcul.php';
        $somme = $_GET['Somme'];
        $taux =  $_GET['Taux'];
        $durée = $_GET['Durée'];
        echo cumul($somme ,$taux ,$durée);
        ?></p>;
    </div>
</div>